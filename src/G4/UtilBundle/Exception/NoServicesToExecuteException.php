<?php
/**
 * PHP version 5
 *
 * @category Allegiant
 * @package  G4.UtilBundle.Exception
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Exception;

/**
 * Exception for the cases when there is no service in the execution pool,
 *      so we can't execute any.
 */
class NoServicesToExecuteException extends \Exception
{

    /**
     * Returns exception message with additional context information.
     *
     * @return string
     */
    public function __toString()
    {
        return('There is no service in the ServicesCall \'s execution pool.');
    }

}