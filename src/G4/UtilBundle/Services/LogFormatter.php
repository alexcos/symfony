<?php

/**
 * Logging formatter
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Services
 *
 * @author   Toby Batch <tobias@neontribe.co.uk>
 * @author   Rares Moldoveanu <rares@cloudtroopers.ro>
 * @author   Victor Vacaretu <victor@cloudtroopers.ro>
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Services;

use Monolog\Formatter\FormatterInterface;
use Monolog\Logger;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerAware;

/**
 * LogFormatter to be used for syslog entries
 */
class LogFormatter extends ContainerAware
{
    private $version = 'dev';
    private $debug = false;
    private $memcaches = array();

    public function init()
    {
        $root = $this->container->get('kernel')->getRootDir();
        $file = sprintf('%s/../web/CODE-VERSION.TXT', $root);
        if (file_exists($file)) {
            $this->version = trim(file_get_contents($file));
        }

        $pp = $this->container->getParameter('g4_logging_level');
        $this->debug = ($pp === 'debug');

        $urls = array();
        $mcservers = $this->container->getParameter('g4_memcache_server_address_log');
        $mcport = $this->container->getParameter('g4_memcache_server_port_log');
        foreach ($mcservers as $mcserver) {
            $urls[] = array(
                'ip' => trim($mcserver, '[]'),
                'port' => $mcport,
            );
        }
        $this->memcaches = $urls;
    }

    /**
     * isDebug 
     * 
     * @access public
     * @return boolean
     */
    public function isDebug()
    {
        return $this->debug;
    }

    /**
     * Sets the transaction identifier
     * 
     * @param string $transactionId
     * 
     * @access public
     * @return void
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * processRecord 
     * 
     * @param array $record 
     * 
     * @inheritdoc
     * @access public
     * @return array
     */
    public function processRecord(array $record)
    {
        // message, context, level, level_name, channel, datetime, extra
        if (isset($record['context']['type'])) {
            $type = $record['context']['type'];
            unset($record['context']['type']);
        } else {
            $type = 'system';
        }

        if (isset($record['context']['mask'])) {
            $mask = $record['context']['mask'];
            unset($record['context']['mask']);
        } else {
            $mask = 'default';
        }

        // check to see if the 'json' value in context is actually json
        if (isset($record['context']['json']) && is_string($record['context']['json'])) {
            //we want to log in timeline even a bad json
            $tempJson = $record['context']['json'];
            $record['context']['json'] = json_decode($record['context']['json'], true);
            if (empty($record['context']['json'])) {
                //we had a bad json
                $record['context']['json'] = array($tempJson);
            }
        }

        $record['context']['transactionid'] = $this->container->get('g4_container')->getTransactionId();
        $payload = array(
            'message' => $record['message'],
            'context' => $record['context'],
        );

        $g4dumpjson = $this->container->getParameter('g4_dump_json');
        if ($g4dumpjson != true) {
            $key = uniqid('logger');
            // we are not a controller so we won't use the G4Controller->writeToMemcache
            $memcache = $this->container->get('g4_persister_memcache_log');
            $memcache->set($key, json_encode($record['context']));

            $urls = array();
            foreach ($this->memcaches as $memcacheServer) {
                $tempArr = $memcacheServer;
                $tempArr['key'] = $key;
                $urls[] = $tempArr;
            }

            $payload['context'] = array('urls' => $urls);
        }
        // $payload['context']['trace'] = debug_backtrace();

        if (isset($record['context']['pairKey'])) {
            $payload['context']['pairKey'] = $record['context']['pairKey'];
        }

        if (isset($record['context']['url'])) {
            $payload['context']['url'] = $record['context']['url'];
        }

        if (isset($record['context']['manifest'])) {
            $payload['context']['manifest'] = $record['context']['manifest'];
        }

        if (isset($record['context']['booking'])) {
            $payload['context']['booking'] = $record['context']['booking'];
        }

        if ($type == 'ReswebStat') {
            if (isset($record['context']['executionTime'])) {
                $payload['context']['executionTime'] = $record['context']['executionTime'];
            }

        }

        $record['codeversion']      = $this->version;
        $record['manifestid']       = $this->container->get('g4_container')->getManifestId();
        $record['transactionid']    = $this->container->get('g4_container')->getTransactionId();
        $record['remoteip']         = $this->container->get('g4_container')->getClientIp();
        $record['type']             = $type;
        $record['mask']             = $mask;
        $record['g4_nache']         = $this->container->get('g4_container')->getG4Nache();
        $record['drupalsessionid']  = $this->container->get('g4_container')->getDrupalSessionId();
        $record['drupal_username']  = $this->container->get('g4_container')->getDrupalUsername();
        $record['drupal_roles']     = $this->container->get('g4_container')->getDrupalRoles();

        try {
            $record['g4_silo'] = $this->container->getParameter('g4_silo');
        } catch (\Symfony\Component\DependencyInjection\Exception\InvalidArgumentException $e) {
            $record['g4_silo'] = 'NoG4Silo';
        }

        $record['payload_indented'] = $this->json_encode($payload);
        $record['payload'] = json_encode($payload);

        return $record;
    }

    /**
     * Encodes supplied data to JSON
     *
     * This method is overridden by DebugLogFormatter to pretty print the JSON
     *
     * @param mixed $payload
     *
     * @access public
     * @return string
     */
    public function json_encode($payload)
    {
        return json_encode($payload);
    }
}
