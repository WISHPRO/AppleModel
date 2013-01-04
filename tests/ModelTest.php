<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use Apple\Model\ModelInterface,
    Apple\AppStore\Stores\USStore;

abstract class ModelTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Create a new testing model
     */
    abstract protected function createNewModel();

    /**
     * Base test model
     */
    public function testModel()
    {
        $model = $this->createNewModel();

        $this->assertTrue($model instanceof ModelInterface);

        $appStore = new USStore;
        $model
            ->setArtistName('ARTIST_NAME')
            ->setArtistId(111)
            ->setTrackId(222)
            ->setAppStore($appStore);

        $this->assertEquals($model->getArtistName(), 'ARTIST_NAME');
        $this->assertEquals($model->getArtistId(), 111);
        $this->assertEquals($model->getTrackId(), 222);
        $this->assertEquals($model->getAppStore(), $appStore);
    }

    /**
     * Serializer test
     */
    public function testSerialize()
    {
        $model = $this->createNewModel();

        $model
                ->setArtistName('ARTIST')
                ->setArtistId(1)
                ->setTrackId(2);

        $modelSerialize = serialize($model);

        $newModel = unserialize($modelSerialize);

        $this->assertEquals($newModel->getArtistName(), 'ARTIST');
        $this->assertEquals($newModel->getArtistId(), 1);
        $this->assertEquals($newModel->getTrackId(), 2);
    }

    /**
     * Test setters and getters
     */
    public function testSettersGetters()
    {
        $model = $this->createNewModel();

        $refModel = new \ReflectionObject($model);

        $valids = array();

        foreach ($refModel->getMethods() as $method) {
            $methodName = $method->getName();

            // Method is valid
            if (in_array($methodName, $valids) || !$method->isPublic()) {
                continue;
            }

            if (strpos($methodName, 'set') === 0) {
                // Setter (Find getter)
                $getterName = 'get' . substr($methodName, 3);

                $this->assertTrue($refModel->hasMethod($getterName));

                $valids[] = $methodName;
                $valids[] = $getterName;

                $this->getterSetterTest($method, new \ReflectionMethod($model, $getterName));
            }
            else {
                // Other method
            }
        }
    }

    /**
     * Test getters after set values
     */
    protected function getterSetterTest(\ReflectionMethod $setter, \ReflectionMethod $getter)
    {
        $this->assertFalse($setter->isStatic());
        $this->assertFalse($getter->isStatic());
    }

    /**
     * Set values tests
     */
    protected function setValuesTest($model, $setterMethod, $getterMethod, array $values)
    {
        foreach ($values as $v) {
            $model->{$setterMethod}($v);
            $this->assertEquals($model->{$getterMethod}(), $v);
        }
    }
}