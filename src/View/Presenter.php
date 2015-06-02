<?php
namespace Cake\View;

use Cake\ORM\Entity;
use Cake\Utility\Inflector;

class Presenter {

    /**
     * Holds the entity that is being wrapped.
     *
     * @var \Cake\ORM\Entity;
     */
    protected $_entity;

    /**
     * Holds the name of the class for the instance object
     *
     * @var string
     */
    protected $_className;

    /**
     * Holds a cached list of methods that exist in the instanced class
     *
     * @var array
     */
    protected static $_accessors = [];

    /**
     * Map of aliases to entity properties
     *
     * @var array
     */
    public $propertyMap = [];

    public function __construct(Entity $entity)
    {
        $this->_entity = $entity;
    }

    public function __get($property)
    {
        return $this->get($property);
    }

    /**
     * Returns the value of a property by name
     *
     * @param string $property the name of the property to retrieve
     * @return mixed
     */
    public function get($property)
    {
        $value = $this->_entity->$property;
        if (isset($this->propertyMap[$property])) {
            $alias = $this->propertyMap[$property];
            $value = $this->$alias;
        }

        $method = '_get' . Inflector::camelize($property);

        if ($this->_methodExists($method)) {
            return $this->{$method}($value);
        }
        return $value;
    }

    /**
     * Determines whether a method exists in this class
     *
     * @param string $method the method to check for existence
     * @return bool true if method exists
     */
    protected function _methodExists($method)
    {
        if (empty(static::$_accessors[$this->_className])) {
            static::$_accessors[$this->_className] = array_flip(get_class_methods($this));
        }
        return isset(static::$_accessors[$this->_className][$method]);
    }

    /**
     * Returns a string representation of this object in a human readable format.
     *
     * @return string
     */
    public function __toString()
    {
        return json_encode($this, JSON_PRETTY_PRINT);
    }

}
