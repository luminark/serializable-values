<?php

use Illuminate\Database\Eloquent\Model;
use Luminark\SerializableValues\Traits\HasSerializableValuesTrait;

class TestModel extends Model
{
    use HasSerializableValuesTrait;
    
    protected $fillable = ['title', 'values'];
    
    protected function getSerializableAttributes()
    {
        return ['foo', 'bar'];
    }
}
