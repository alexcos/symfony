<?php
/**
 * PHP Version 5
 *
 * @category Allegiant
 * @package  G4.SearchBundle.Tests.Controller
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle\Services;

use G4\UtilBundle\Exception\JsonDecodeException;

class Json
{

    /**
     * Minifies the given Json string
     *
     * @param string $uncompressed the json-formatted string to be minified
     *
     * @return string json-formatted string without whitespace
     *
     * @throws JsonDecodeException
     * @static
     */
    public static function minify($uncompressed) {
        $decoded = json_decode($uncompressed);
        if (is_null($decoded)) {
            throw new JsonDecodeException(
                sprintf('Unable to decode string length %d starting with: %s', strlen($uncompressed), substr($uncompressed, 0, 100))
            );
        }

        return json_encode($decoded);
    }

    /**
     * format JSON into readable form
     * @todo add unit test
     *
     * @param $json
     * @param string $json json string to be prettified
     *
     * @return string
     * @static
     */
    public static function prettify($json)
    {
        $result    = '';
        $pos       = 0;
        $strLen    = strlen($json);
        $indentStr = '  ';
        $newLine   = "\n";

        for ($i = 0; $i <= $strLen; $i++) {
            // Grab the next character in the string
            $char = substr($json, $i, 1);
            // If this character is the end of an element,.
            // output a new line and indent the next line
            if ($char == '}' || $char == ']') {
                $result .= $newLine;
                $pos --;
                for ($j=0; $j<$pos; $j++) {
                    $result .= $indentStr;
                }
            }
            // Add the character to the result string
            $result .= $char;
            // If the last character was the beginning of an element,.
            // output a new line and indent the next line
            if ($char == ',' || $char == '{' || $char == '[') {
                $result .= $newLine;
                if ($char == '{' || $char == '[') {
                    $pos ++;
                }
                for ($j = 0; $j < $pos; $j++) {
                    $result .= $indentStr;
                }
            }
        }
        return stripslashes($result);
    }

}