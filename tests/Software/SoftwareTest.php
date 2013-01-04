<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use Apple\Model\Software,
    Apple\Model\SoftwareInterface,
    Apple\Model\ModelInterface;

/**
 * Software model test
 */
class SoftwareTest extends \ModelTest
{
    /**
     * Create a new model
     */
    protected function createNewModel()
    {
        return new Software;
    }

    /**
     * Default test
     */
    public function testSoftware()
    {
        $model = new Software;

        $this->assertTrue($model instanceof SoftwareInterface);
        $this->assertTrue($model instanceof ModelInterface);

        // Platform test
        $this->setValuesTest($model, 'setPlatform', 'getPlatform', array(SoftwareInterface::PLATFORM_MAC, SoftwareInterface::PLATFORM_IOS));

        try {
            $model->setPlatform('new platform');
            $this->fail('Not control platform');
        }
        catch (\InvalidArgumentException $e)
        {
        }

        try {
            $model->setPlatform('1');
            $this->fail('Not strict control platform.');
        }
        catch (\InvalidArgumentException $e)
        {
        }

        // Price, version, game center, bundle and etc. tests
        $this->setValuesTest($model, 'setTrackName', 'getTrackName', array('AppRus', 'Finder'));
        $this->setValuesTest($model, 'setPrice', 'getPrice', array(0, 1.99, 5.99, 10));
        $this->setValuesTest($model, 'setVersion', 'getVersion', array('1.1', '2.0-dev', 3.1));
        $this->setValuesTest($model, 'setGameCenter', 'getGameCenter', array(TRUE, FALSE));
        $this->setValuesTest($model, 'setBundleId', 'getBundleId', array('com.apple.itunes', 11, 'new.bundle'));
        $this->setValuesTest($model, 'setCurrency', 'getCurrency', array('RUB', 'USD'));
        $this->setValuesTest($model, 'setDescription', 'getDescription', array('description 1', str_repeat('description 2', 1000)));
        $this->setValuesTest($model, 'setSellerName', 'getSellerName', array('ZhukV', 'Seller'));
        $this->setValuesTest($model, 'setSellerUrl', 'getSellerurl', array('http://google.com', 'seller url'));
        $this->setValuesTest($model, 'setReleaseNotes', 'getReleaseNotes', array('Fix bug #1', 'New release notes.'));
        $this->setValuesTest($model, 'setReleaseDate', 'getReleaseDate', array(new \DateTime('now'), new \DateTime('yesterday')));
        $this->setValuesTest($model, 'setFileSize', 'getFileSize', array(111, 222, '140000'));
        $this->setValuesTest($model, 'setUserRatingCount', 'getUserRatingCount', array(1, '100', 1000));
        $this->setValuesTest($model, 'setAverageUserRating', 'getAverageUserRating', array(0, 1, 1.5, 4.5, 5));
        $this->setValuesTest($model, 'setUserRatingCountCurrent', 'getUserRatingCountCurrent', array(1, '100', 1000));
        $this->setValuesTest($model, 'setAverageUserRatingCurrent', 'getAverageUserRatingCurrent', array(0, '1', '1.5', 4, 5));
        $this->setValuesTest($model, 'setLanguagesISO2A', 'getLanguagesISO2A', array(array('RU', 'EN', 'US')));
        $this->setValuesTest($model, 'setPrimaryGenreId', 'getPrimaryGenreId', array(1, '6014', 345));
        $this->setValuesTest($model, 'setprimaryGenreName', 'getPrimaryGenreName', array('Games', 'Utilites'));
        $this->setValuesTest($model, 'setArtworkUrl160', 'getArtworkUrl160', array('url 1', 'url 2'));

        // Track view url test
        $this->setValuesTest($model, 'setTrackViewUrl', 'getTrackViewurl', array(
          'url1', 'url2', 'http://itunes.apple.com/app/id12312312'
        ));

        // Screenshots test
        $screenshots = array(
            'screenhot1', 'screenshot2'
        );

        $model->setScreenshotUrls($screenshots);
        $this->assertEquals($model->getScreenshotUrls(), $screenshots);

        $model->setIpadScreenshotUrls($screenshots);
        $this->assertEquals($model->getIpadScreenshotUrls(), $screenshots);

        // Supported devices test
        $model->setSupportedDevices(array('ipad', 'iphone'));
        $this->assertEquals($model->getSupportedDevices(), array('ipad', 'iphone'));
    }

    /**
     * Test platform
     */
    public function testSoftwareTypeIOS()
    {
        $model = $this->createNewModel();

        // Mac (Error)
        $model->setPlatform(SoftwareInterface::PLATFORM_MAC);

        try {
            $model->getTypeIos();
            $this->fail('Not control mac platform in get type iOS');
        }
        catch (\LogicException $e)
        {
        }

        // Set iOS platform
        $model->setPlatform(SoftwareInterface::PLATFORM_IOS);

        // Universal type iOS
        $model->setSupportedDevices(array('iphone', 'ipad', '....', 'all'));
        $this->assertEquals($model->getTypeIos(), SoftwareInterface::TYPE_IOS_UNIVERSAL);

        // Not universal iOS (Control devices)
        $model->setSupportedDevices(array(1, 2, 3));
        $model->setScreenshotUrls(array('s1', 's2', 's3')); // Must be iPhone type iOS
        $this->assertNotEquals($model->getTypeIos(), SoftwareInterface::TYPE_IOS_UNIVERSAL);

        // Not iPad screens - iPhone type
        $this->assertEquals($model->getTypeIos(), SoftwareInterface::TYPE_IOS_IPHONE);

        // Clear screenshots and set iPad screenshots
        $model->setScreenshotUrls(array());
        $model->setIpadScreenshotUrls(array('s1', 's2', 's3'));
        $this->assertEquals($model->getTypeIos(), SoftwareInterface::TYPE_IOS_IPAD);

        // Add iPhone screenshots
        $model->setScreenshotUrls(array('s1', 's2', 's3'));
        $this->assertEquals($model->getTypeIos(), SoftwareInterface::TYPE_IOS_UNIVERSAL);

        // Clear all screenshots (Error)
        $model->setScreenshotUrls(array());
        $model->setIpadScreenshotUrls(array());

        try {
            $model->getTypeIos();
            $this->fail('Not control screenshots error.');
        }
        catch (\LogicException $e)
        {
        }

        // Clear supported device
        $model->setSupportedDevices(array());

        try {
            $model->getTypeIos();
            $this->fail('Not control error: Undefined supported device and screenshots.');
        }
        catch (\InvalidArgumentException $e)
        {
        }
    }

    /**
     * Control rating errors
     */
    public function testControlRating()
    {
        $model = $this->createNewModel();

        try {
            $model->setUserRatingCount(-2);
            $this->fail('Not control user rating');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setUserRatingCountCurrent(-2);
            $this->fail('Not control user rating for current version.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRating(-2);
            $this->fail('Not control average user rating, less than 0.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRating(2.33);
            $this->fail('No control division by 0.5.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRating(6);
            $this->fail('Not control average user rating, large than 5.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRatingCurrent(-2);
            $this->fail('Not control average user rating for current version, less than 0.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRatingCurrent(2.33);
            $this->fail('No control division by 0.5 in current average.');
        }
        catch (\InvalidArgumentException $e) {}

        try {
            $model->setAverageUserRatingCurrent(6);
            $this->fail('Not control average user rating for current version, large than 5.');
        }
        catch (\InvalidArgumentException $e) {}
    }
}