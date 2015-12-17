#Luminark Serializable Values Package

[![Build Status](https://img.shields.io/travis/luminark/serializable-values.svg?style=flat-square)](https://travis-ci.org/luminark/serializable-values)
[![Code Coverage](https://img.shields.io/codecov/c/github/luminark/serializable-values.svg?style=flat-square)](https://codecov.io/github/luminark/serializable-values)
[![SensioLabsInsight](https://img.shields.io/sensiolabs/i/dab7f14d-cd7b-46f6-8a73-52741f75b762.svg?style=flat-square)](https://insight.sensiolabs.com/projects/dab7f14d-cd7b-46f6-8a73-52741f75b762)
[![Scrutinizer](https://img.shields.io/scrutinizer/g/luminark/serializable-values.svg)](https://scrutinizer-ci.com/g/luminark/serializable-values)


Enables you to save serialized attribute values on your models. Simply use the `HasSerializableValuesTrait` trait on your models, define a `values` column on the model table and implement `getSerializableAttributes()` method to define which attributes' values can be serialized.

Example:

```php
class Example extends Model
{
    use HasSerializableValuesTrait;
    
    protected function getSerializableAttributes()
    {
        return ['foo', 'bar'];
    }
}
```