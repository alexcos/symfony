<?php
/**
 * Created by JetBrains PhpStorm.
 * User: serbanbajdechi
 * Date: 8/22/13
 * Time: 3:01 PM
 * To change this template use File | Settings | File Templates.
 */

namespace G4\UtilBundle;


use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\Exception\UnexpectedTypeException;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\PropertyAccess\PropertyAccessor;

class G4PropertyAccess {

    /**
     * @var PropertyAccessor $accessor
     */
    static private $accesor;

    /**
     * Returns the value of the array or object. returns null if property does not exist.
     *
     * @param $objectOrArray
     * @param $propertyPath
     *
     * @return mixed|null
     */
    public static function getValue($objectOrArray, $propertyPath)
    {
        try {
            return self::getAccesor()->getValue($objectOrArray, $propertyPath);
        } catch (NoSuchPropertyException $e) {
            return null;
        } catch (UnexpectedTypeException $e) {
            return null;
        }


    }

    /**
     * Sets value
     *
     * @param $objectOrArray
     * @param $propertyPath
     * @param $value
     */
    public static function setValue($objectOrArray, $propertyPath, $value)
    {
        self::getAccesor()->setValue($objectOrArray, $propertyPath, $value);
    }

    /**
     * @param PropertyAccessor $accesor
     */
    private static function setAccesor(PropertyAccessor $accesor)
    {
        self::$accesor = $accesor;
    }

    /**
     * @return PropertyAccessor
     */
    private static function getAccesor()
    {
        if (!self::$accesor) {
            self::$accesor = PropertyAccess::createPropertyAccessor();
        }

        return self::$accesor;
    }


}