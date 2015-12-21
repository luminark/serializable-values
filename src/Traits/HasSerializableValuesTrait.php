<?php

namespace Luminark\SerializableValues\Traits;

trait HasSerializableValuesTrait
{
    protected function getSerializableAttributes()
    {
        return [];
    }

    public function getValuesAttribute($values)
    {
        return $this->unserialize($values);
    }

    public function setValuesAttribute(array $values)
    {
        $values = array_merge($this->values, $values);
        $values = array_only($values, $this->getSerializableAttributes());
        $this->attributes['values'] = $this->serialize($values);
    }

    public function getOriginal($key = null, $default = null)
    {
        $originalValues = $this->unserialize(parent::getOriginal('values'));
        if (array_key_exists($key, $originalValues)) {
            return array_get($originalValues, $key, $default);
        }

        return array_get($this->original, $key, $default);
    }
    
    public function fillableFromArray(array $attributes)
    {
        return array_merge(
            parent::fillableFromArray($attributes), 
            array_intersect_key($attributes, array_flip($this->getSerializableAttributes()))
        );
    }
    
    public function isFillable($key)
    {
        return in_array($key, $this->getSerializableAttributes())
            ? true
            : parent::isFillable($key);
    }

    public function getAttribute($key)
    {
        return in_array($key, $this->getSerializableAttributes())
            ? $this->getValue($key)
            : parent::getAttribute($key);
    }
    
    public function setAttribute($key, $value)
    {
        in_array($key, $this->getSerializableAttributes())
            ? $this->setValue($key, $value)
            : parent::setAttribute($key, $value);
    }

    public function getValue($key)
    {
        return array_get($this->getAttribute('values'), $key);
    }

    public function setValue($key, $value)
    {
        $values = $this->values;
        $values[$key] = $value;
        $this->setValuesAttribute($values);
    }

    protected function serialize($array)
    {
        return base64_encode(serialize($array ?: []));
    }

    protected function unserialize($string)
    {
        return $string ? unserialize(base64_decode($string)) : [];
    }
}
