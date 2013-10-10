<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 */
namespace G4\UtilBundle\Services;

use Monolog\Formatter\LineFormatter;

/**
 * G4LineFormatter 
 */
class G4LineFormatter extends LineFormatter
{
    /*
    public function format(array $record)
    {
        $line = parent::format($record);
        $line = trim($line) . " " . $record['channel'] . "\n";
        // $line = trim($line) . implode(', ', array_keys($record)) . "\n";

        return false;
        return $line;
    }
     */
}
