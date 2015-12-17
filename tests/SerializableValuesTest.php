<?php

use Orchestra\Testbench\TestCase;

/**
 * Class UrlTest
 */
class UrlTest extends TestCase
{
    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();
        $this->artisan('migrate', [
          '--database' => 'testbench',
          '--path' => '../tests/database/migrations',
        ]);
        
        // Workaround to get Eloquent Model events working in tests
        TestModel::flushEventListeners();
        TestModel::boot();
    }
    
    /**
     * Define environment setup.
     *
     * @param Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['path.base'] = __DIR__ . '/../src';
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
          'driver' => 'sqlite',
          'database' => ':memory:',
          'prefix' => '',
        ]);
    }

    protected function getPackageProviders($app)
    {
        return [];
    }
    
    public function testSerializableValues()
    {
        $testModel = TestModel::create([
            'title' => 'Title',
            'values' => [
                'foo' => 'Something',
                'bar' => 'Baz'
            ]
        ]);
        
        $this->assertEquals('Something', $testModel->foo, 'Serialized value not properly set.');
        $this->assertEquals('Baz', $testModel->bar, 'Serialized value not properly set.');
        
        $testModel->foo = 'Bar';
        
        $this->assertEquals('Bar', $testModel->foo, 'Serialized value not properly set.');
        
        $testModel->baz = 'bar';
        
        $this->assertNull($testModel->getValue('baz'), 'Unallowed value was set.');
    }
}
