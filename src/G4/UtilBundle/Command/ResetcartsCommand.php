<?php
namespace G4\UtilBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Doctrine\ODM\CouchDB\Tools\Console\Command\UpdateDesignDocCommand AS DoctrineUpdateDesignDocCommand;
use Doctrine\Bundle\CouchDBBundle\Command\DoctrineCommandHelper;
/**
 * Created by JetBrains PhpStorm.
 * User: dev
 * Date: 5/25/12
 * Time: 10:44 AM
 * To change this template use File | Settings | File Templates.
 */
class ResetcartsCommand extends ContainerAwareCommand
{
    /**
     * configure function
     */
    protected function configure()
    {
        $this
            ->setName('g4:resetcarts')
            ->setDescription('Reset carts database in couch db')
            ->addOption('dm', null, InputOption::VALUE_OPTIONAL, 'The document manager to use for this command');
    }


    /**
     * execute
     *
     * @param InputInterface  $input  An InputInterface instance
     * @param OutputInterface $output An OutputInterface instance
     *
     * @access protected
     * @return int|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        DoctrineCommandHelper::setApplicationDocumentManager($this->getApplication(), $input->getOption('dm'));

        $dm = $this->getHelper('couchdb')->getDocumentManager();
        $couchDbClient = $dm->getCouchDBClient();
        $config = $dm->getConfiguration();

        //check if database exsist and remove
        $dbs = $couchDbClient->getAllDatabases();
        $newDb = $couchDbClient->getDatabase();


        if (in_array($newDb, $dbs)) {
            $couchDbClient->deleteDatabase($newDb);
        }

        //create the database
        $couchDbClient->createDatabase($newDb);

        //now we put the design documents
        $designDocNames = $config->getDesignDocumentNames();

        foreach ($designDocNames as $docName) {
            $designDocData = $config->getDesignDocument($docName);

            $localDesignDoc = new $designDocData['className']($designDocData['options']);
            $localDocBody = $localDesignDoc->getData();

            $remoteDocBody = $couchDbClient->findDocument('_design/' . $docName)->body;
            if (is_null($remoteDocBody)
                || (isset($remoteDocBody['error']) && $remoteDocBody['error'] == 'not_found')
                || ($remoteDocBody['views'] != $localDocBody['views'])) {
                $response = $couchDbClient->createDesignDocument($docName, $localDesignDoc);

                if ($response->status < 300) {
                    $output->writeln("Succesfully added: " . $docName);
                } else {
                    $output->writeln("Error updating {$docName}: {$response->body['reason']}");
                }
            }
        }


    }
}
