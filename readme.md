#Luminark Serializable Values Package

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