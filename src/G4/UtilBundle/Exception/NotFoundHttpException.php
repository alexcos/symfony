<?php
namespace G4\UtilBundle\Exception;

/**
 * NotFoundHttpException G4 exception.
 *
 * @author Serban Bajdechi <serban@lolaent.com>
 */
class NotFoundHttpException extends G4Exception
{
    /**
     * Constructor.
     *
     * @param string    $message  The internal exception message
     * @param string    $manifestId      Hash key
     * @param \Exception $previous The previous exception
     */
    public function __construct($message, $manifestId, \Exception $previous = null)
    {
        parent::__construct($message, $manifestId, 404, $previous);
    }
}
