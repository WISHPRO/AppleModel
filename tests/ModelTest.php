<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use Apple\AppStore\USStore;

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

        $appStore = new USStore;
        $model
            ->setArtistName('ARTIST_NAME')
            ->setArtistId(111)
            ->setTrackId(222)
            ->setAppStore($appStore);

        $this->assertEquals('ARTIST_NAME', $model->getArtistName());
        $this->assertEquals(111, $model->getArtistId());
        $this->assertEquals(222, $model->getTrackId());
        $this->assertEquals($appStore, $model->getAppStore());
    }

    /**
     * Serializer test
     */
    public function tttestSerialize()
    {
        $model = $this->createNewModel();

        $model
                ->setArtistName('ARTIST')
                ->setArtistId(1)
                ->setTrackId(2);

        $modelSerialize = serialize($model);

        $newModel = unserialize($modelSerialize);

        $this->assertEquals('ARTIST', $newModel->getArtistName());
        $this->assertEquals(1, $newModel->getArtistId());
        $this->assertEquals(2, $newModel->getTrackId());
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
            $this->assertEquals($v, $model->{$getterMethod}());
        }
    }
}