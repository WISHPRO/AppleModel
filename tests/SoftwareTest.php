<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use Apple\Model\Software;
use Apple\Model\Genre;

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

        $this->assertInstanceOf('Apple\Model\AbstractModel', $model);

        // Platform test
        $this->setValuesTest($model, 'setPlatform', 'getPlatform', array(Software::PLATFORM_MAC, Software::PLATFORM_IOS));

        try {
            $model->setPlatform('new platform');
            $this->fail('Not control platform');
        } catch (\InvalidArgumentException $e) {
        }

        try {
            $model->setPlatform('1');
            $this->fail('Not strict control platform.');
        } catch (\InvalidArgumentException $e) {
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
        $this->setValuesTest($model, 'setArtworkUrl60', 'getArtworkUrl60', array('url 1', 'url 2'));
        $this->setValuesTest($model, 'setArtworkUrl100', 'getArtworkUrl100', array('url 1', 'url 2'));
        $this->setValuesTest($model, 'setArtworkUrl512', 'getArtworkUrl512', array('url 1', 'url 2'));

        // Track view url test
        $this->setValuesTest($model, 'setTrackViewUrl', 'getTrackViewurl', array(
          'url1', 'url2', 'http://itunes.apple.com/app/id12312312'
        ));

        // Screenshots test
        $screenshots = array(
            'screenhot1', 'screenshot2'
        );

        $model->setScreenshotUrls($screenshots);
        $this->assertEquals($screenshots, $model->getScreenshotUrls());

        $model->setIpadScreenshotUrls($screenshots);
        $this->assertEquals($screenshots, $model->getIpadScreenshotUrls());

        // Supported devices test
        $model->setSupportedDevices(array('ipad', 'iphone'));
        $this->assertEquals(array('ipad', 'iphone'), $model->getSupportedDevices());
    }

    /**
     * Test type ios (Control by screenshots)
     *
     * @dataProvider providerSoftwareTypeIos
     */
    public function testSoftwareTypeIos(array $screens, array $ipadScreens, $type)
    {
        $model = $this->createNewModel();
        $model->setPlatform(Software::PLATFORM_IOS);
        $model->setScreenshotUrls($screens);
        $model->setIpadScreenshotUrls($ipadScreens);

        if ('error' === $type) {
            $this->setExpectedException('LogicException');
        }

        $this->assertEquals($type, $model->getTypeIos());
    }

    /**
     * Provider for testing get type ios (By screenshots)
     */
    public function providerSoftwareTypeIos()
    {
        return array(
            array(array(), array(), 'error'),
            array(array('s1'), array(), Software::TYPE_IOS_IPHONE),
            array(array(), array('ci1'), Software::TYPE_IOS_IPAD),
            array(array('s1'), array('s2'), Software::TYPE_IOS_UNIVERSAL)
        );
    }

    /**
     * Test control ratings
     *
     * @dataProvider providerControlRatings
     */
    public function testConrolRatings($method, $rating, $error = false)
    {
        $model = $this->createNewModel();

        if (true === $error) {
            $this->setExpectedException('InvalidArgumentException');
        }

        $model->{$method}($rating);
    }

    /**
     * Provider for testing set ratings errors
     */
    public function providerControlRatings()
    {
        return array(
            array('setUserRatingCount', -2, true),
            array('setUserRatingCount', -5, true),
            array('setUserRatingCount', 1, false),
            array('setUserRatingCount', 1000, false),

            array('setUserRatingCountCurrent', -2, true),
            array('setUserRatingCountCurrent', -5, true),
            array('setUserRatingCountCurrent', 1, false),
            array('setUserRatingCountCurrent', 1000, false),

            array('setAverageUserRating', -1, true),
            array('setAverageUserRating', -5, true),
            array('setAverageUserRating', 1.1, true),
            array('setAverageUserRating', 2.75, true),
            array('setAverageUserRating', 5.5, true),
            array('setAverageUserRating', 10, true),
            array('setAverageUserRating', 5, false),
            array('setAverageUserRating', 2.5, false),
            array('setAverageUserRating', 0, false),
            array('setAverageUserRating', 3, false),

            array('setAverageUserRatingCurrent', -1, true),
            array('setAverageUserRatingCurrent', -5, true),
            array('setAverageUserRatingCurrent', 1.1, true),
            array('setAverageUserRatingCurrent', 2.75, true),
            array('setAverageUserRatingCurrent', 5.5, true),
            array('setAverageUserRatingCurrent', 10, true),
            array('setAverageUserRatingCurrent', 5, false),
            array('setAverageUserRatingCurrent', 2.5, false),
            array('setAverageUserRatingCurrent', 0, false),
            array('setAverageUserRatingCurrent', 3, false)
        );
    }

    /**
     * Test set genre
     */
    public function testSetGenre()
    {
        $model = $this->createNewModel();
        $genre = new Genre;
        $model->setPrimaryGenre($genre);
        $this->assertEquals($genre, $model->getPrimaryGenre());
    }
}