<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Apple\Model;

/**
 * Software model
 */
class Software extends AbstractModel
{
    /**
     * Platform constants
     */
    const PLATFORM_IOS = 1;
    const PLATFORM_MAC = 2;

    /**
     * Type ios constants
     */
    const TYPE_IOS_IPHONE = 1;
    const TYPE_IOS_IPAD = 2;
    const TYPE_IOS_UNIVERSAL = 3;

    /**
     * Platform type (iOS or Mac)
     *
     * @var integer
     */
    protected $platform;

    /**
     * Software name
     *
     * @var string
     */
    protected $trackName;

    /**
     * Copyright
     *
     * @var string
     */
    protected $copyright;

    /**
     * Is game center enabled for this software
     *
     * @var boolean
     */
    protected $gameCenter = false;

    /**
     * Supported devices
     *
     * @var array
     */
    protected $supportedDevices = array();

    /**
     * Apple link for view this software in iTunes
     *
     * @var string
     */
    protected $trackViewUrl;

    /**
     * iPhone screenshots (if exists)
     *
     * @var array
     */
    protected $screenshotsIphone;

    /**
     * iPad screenshots (if exists)
     *
     * @var array
     */
    protected $screenshotsIpad;

    /**
     * Mac screenshots (if exists)
     *
     * @var array
     */
    protected $screenshotsMac;

    /**
     * @var float
     */
    protected $price;

    /**
     * The currency code (ISO 4217)
     *
     * @var string
     */
    protected $currency;

    /**
     * Software version
     *
     * @var string
     */
    protected $version;

    /**
     * @var string
     */
    protected $bundleId;

    /**
     * @var string
     */
    protected $description;

    /**
     * Seller (Developer) name
     *
     * @var string
     */
    protected $sellerName;

    /**
     * Seller (Developer) url
     *
     * @var string
     */
    protected $sellerUrl;

    /**
     * @var \DateTime
     */
    protected $releaseDate;

    /**
     * @var string
     */
    protected $releaseNotes;

    /**
     * File size in bytes
     *
     * @var string
     */
    protected $fileSize;

    /**
     * Full user rating
     *
     * @var integer
     */
    protected $userRatingCount = 0;

    /**
     * Average star of user rating (0 - 5)
     *
     * @var float
     */
    protected $averageUserRating = 0;

    /**
     * User rating of active version
     *
     * @var integer
     */
    protected $userRatingCountCurrent = 0;

    /**
     * Average star of active version
     *
     * @var float
     */
    protected $averageUserRatingCurrent = 0;

    /**
     * Languages list (ISO2A)
     *
     * @var array
     */
    protected $languages = array();

    /**
     * Genre of this software
     *
     * @var Genre
     */
    protected $primaryGenre;

    /**
     * Logo url (60x60)
     *
     * @var string
     */
    protected $artworkUrl60;

    /**
     * Logo url (100x100)
     *
     * @var string
     */
    protected $artworkUrl100;

    /**
     * Logo url (512x512)
     *
     * @var string
     */
    protected $artworkUrl512;

    /**
     * Set software platform
     *
     * @param integer $platform
     * @throws \InvalidArgumentException
     * @return Software
     */
    public function setPlatform($platform)
    {
        if (!in_array($platform, array(Software::PLATFORM_MAC, Software::PLATFORM_IOS), true)) {
            throw new \InvalidArgumentException(sprintf('Undefined software platform "%s".', $platform));
        }

        $this->platform = $platform;

        return $this;
    }

    /**
     * Get software platform
     *
     * @return integer
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * Get type ios
     * Attention: Control with screenshots
     *
     * @throws \LogicException
     * @return integer
     */
    public function getIosType()
    {
        if ($this->platform !== Software::PLATFORM_IOS) {
            throw new \LogicException('Can\'t get type iOS in Mac software.');
        }

        if ($this->screenshotsIphone && $this->screenshotsIpad) {
            return Software::TYPE_IOS_UNIVERSAL;
        } else if ($this->screenshotsIphone) {
            return Software::TYPE_IOS_IPHONE;
        } else if ($this->screenshotsIpad) {
            return Software::TYPE_IOS_IPAD;
        } else {
            throw new \LogicException('Can\'t get type iOS. Undefined screenshots');
        }
    }

    /**
     * Set software name
     *
     * @param string  $trackName
     * @return Software
     */
    public function setTrackName($trackName)
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * Get track name
     *
     * @return string
     */
    public function getTrackName()
    {
        return $this->trackName;
    }

    /**
     * Set copyright
     *
     * @param string $copyright
     * @return Software
     */
    public function setCopyright($copyright)
    {
        $this->copyright = $copyright;

        return $this;
    }

    /**
     * Get copyright
     *
     * @return string
     */
    public function getCopyright()
    {
        return $this->copyright;
    }

    /**
     * Set status game center
     *
     * @param bool $gameCenter
     * @return Software
     */
    public function setGameCenter($gameCenter)
    {
        $this->gameCenter = (bool) $gameCenter;

        return $this;
    }

    /**
     * Get status game center
     *
     * @return bool
     */
    public function getGameCenter()
    {
        return $this->gameCenter;
    }

    /**
     * Set supported devices
     *
     * @param array $supportedDevices
     * @return Software
     */
    public function setSupportedDevices(array $supportedDevices)
    {
        $this->supportedDevices = $supportedDevices;

        return $this;
    }

    /**
     * Get supported devices
     *
     * @return array
     */
    public function getSupportedDevices()
    {
        return $this->supportedDevices;
    }

    /**
     * Set software view URL (On iTunes)
     *
     * @param string $trackViewUrl
     * @return Software
     */
    public function setTrackViewUrl($trackViewUrl)
    {
        $this->trackViewUrl = $trackViewUrl;

        return $this;
    }

    /**
     * Get track view URL
     *
     * @return string
     */
    public function getTrackViewUrl()
    {
        return $this->trackViewUrl;
    }

    /**
     * Set screenshots URL
     *
     * @param array $screenshots
     * @return Software
     */
    public function setScreenshotsIphone(array $screenshots)
    {
        $this->screenshotsIphone = $screenshots;

        return $this;
    }

    /**
     * Get screenshots url
     *
     * @return array|null
     */
    public function getScreenshotsIphone()
    {
        return $this->screenshotsIphone;
    }

    /**
     * Set iPad screenshots url
     *
     * @param array $screenshots
     * @return Software
     */
    public function setScreenshotsIpad(array $screenshots)
    {
        $this->screenshotsIpad = $screenshots;

        return $this;
    }

    /**
     * Get iPad screenshots url
     *
     * @return array|null
     */
    public function getScreenshotsIpad()
    {
        return $this->screenshotsIpad;
    }

    /**
     * Set Mac screenshots
     *
     * @param array $screenshots
     * @return Software
     */
    public function setScreenshotsMac(array $screenshots)
    {
        $this->screenshotsMac = $screenshots;

        return $this;
    }

    /**
     * Get Mac screenshots
     *
     * @return array|null
     */
    public function getScreenshotsMac()
    {
        return $this->screenshotsMac;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Software
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set currency
     *
     * @param string $currency
     * @return Software
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set version
     *
     * @param string $version
     * @return Software
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set bundle ID
     *
     * @param string $bundleId
     * @return Software
     */
    public function setBundleId($bundleId)
    {
        $this->bundleId = $bundleId;

        return $this;
    }

    /**
     * Get bundle ID
     *
     * @return string
     */
    public function getBundleId()
    {
        return $this->bundleId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Software
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set seller name
     *
     * @param string $sellerName
     * @return Software
     */
    public function setSellerName($sellerName)
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    /**
     * Get seller name
     *
     * @return string
     */
    public function getSellerName()
    {
        return $this->sellerName;
    }

    /**
     * Set seller url
     *
     * @param string $sellerUrl
     * @return Software
     */
    public function setSellerUrl($sellerUrl)
    {
        $this->sellerUrl = $sellerUrl;

        return $this;
    }

    /**
     * Get seller url
     *
     * @return string
     */
    public function getSellerUrl()
    {
        return $this->sellerUrl;
    }

    /**
     * Set release date
     *
     * @param \DateTime $releaseDate
     * @return Software
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * Get release date
     *
     * @return \DateTime
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * Set release notes
     *
     * @param string $releaseNotes
     * @return Software
     */
    public function setReleaseNotes($releaseNotes)
    {
        $this->releaseNotes = $releaseNotes;

        return $this;
    }

    /**
     * Get release notes
     *
     * @return string
     */
    public function getReleaseNotes()
    {
        return $this->releaseNotes;
    }

    /**
     * Set software file size in bytes
     *
     * @param integer $fileSize
     * @return Software
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = (int) $fileSize;

        return $this;
    }

    /**
     * Get file size
     *
     * @return integer
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * Set user rating count
     *
     * @param integer $userRatingCount
     * @throws \InvalidArgumentException
     * @return Software
     */
    public function setUserRatingCount($userRatingCount)
    {
        $userRatingCount = (int) $userRatingCount;

        if ($userRatingCount < 0) {
            throw new \InvalidArgumentException(sprintf(
                'User rating can\'t be less than "0", "%s" given.',
                $userRatingCount
            ));
        }

        $this->userRatingCount = (int) $userRatingCount;

        return $this;
    }

    /**
     * Get user rating count
     *
     * @return integer
     */
    public function getUserRatingCount()
    {
        return $this->userRatingCount;
    }

    /**
     * Set user average rating
     *
     * @param float $averageUserRating
     * @throws \InvalidArgumentException
     * @return Software
     */
    public function setAverageUserRating($averageUserRating)
    {
        $averageUserRating = (float) $averageUserRating;

        if ($averageUserRating < 0 || $averageUserRating > 5) {
            throw new \InvalidArgumentException(sprintf(
                'Average user rating must be between 0 and 5, "%s" given.',
                $averageUserRating
            ));
        }

        if ($averageUserRating && fmod($averageUserRating, 0.5)) {
            throw new \InvalidArgumentException(sprintf(
                'Rating must be division by 0.5, "%s" given.',
                $averageUserRating
            ));
        }

        $this->averageUserRating = $averageUserRating;

        return $this;
    }

    /**
     * Get user average rating
     *
     * @return float
     */
    public function getAverageUserRating()
    {
        return $this->averageUserRating;
    }

    /**
     * Set user rating count for current version
     *
     * @param integer $userRatingCountCurrent
     * @throws \InvalidArgumentException
     * @return Software
     */
    public function setUserRatingCountCurrent($userRatingCountCurrent)
    {
        $userRatingCountCurrent = (int) $userRatingCountCurrent;

        if ($userRatingCountCurrent < 0) {
            throw new \InvalidArgumentException(sprintf(
                'User rating can\'t be less than "0", "%s" given.',
                $userRatingCountCurrent
            ));
        }

        $this->userRatingCountCurrent = (int) $userRatingCountCurrent;

        return $this;
    }

    /**
     * Get use rating count for current version
     *
     * @return integer
     */
    public function getUserRatingCountCurrent()
    {
        return $this->userRatingCountCurrent;
    }

    /**
     * Set average user rating for current version
     *
     * @param float $averageUserRatingCurrent
     * @throws \InvalidArgumentException
     * @return Software
     */
    public function setAverageUserRatingCurrent($averageUserRatingCurrent)
    {
        $averageUserRatingCurrent = (float) $averageUserRatingCurrent;

        if ($averageUserRatingCurrent < 0 || $averageUserRatingCurrent > 5) {
            throw new \InvalidArgumentException(sprintf(
                'Average user rating must be between 0 and 5, "%s" given.',
                $averageUserRatingCurrent
            ));
        }

        if ($averageUserRatingCurrent && fmod($averageUserRatingCurrent, 0.5)) {
            throw new \InvalidArgumentException(sprintf(
                'Rating must be division by 0.5, "%s" given.',
                $averageUserRatingCurrent
            ));
        }

        $this->averageUserRatingCurrent = $averageUserRatingCurrent;

        return $this;
    }

    /**
     * Get average user rating for current version
     *
     * @return float
     */
    public function getAverageUserRatingCurrent()
    {
        return $this->averageUserRatingCurrent;
    }

    /**
     * Set languages (ISO2A)
     *
     * @param array $languages
     * @return Software
     */
    public function setLanguages(array $languages)
    {
        $this->languages = $languages;

        return $this;
    }

    /**
     * Get languages (ISO2A)
     *
     * @return array
     */
    public function getLanguages()
    {
        return $this->languages;
    }

    /**
     * Set primary category (Genre)
     *
     * @param Genre $genre
     * @return Software
     */
    public function setPrimaryGenre(Genre $genre)
    {
        $this->primaryGenre = $genre;

        return $this;
    }

    /**
     * Get primary genre
     *
     * @return Genre
     */
    public function getPrimaryGenre()
    {
        return $this->primaryGenre;
    }

    /**
     * Set artwork url (logo) 60x60
     *
     * @param string $artworkUrl
     * @return Software
     */
    public function setArtworkUrl60($artworkUrl)
    {
        $this->artworkUrl60 = $artworkUrl;

        return $this;
    }

    /**
     * Get artwork url (logo) 60x60
     *
     * @return string
     */
    public function getArtworkUrl60()
    {
        return $this->artworkUrl60;
    }

    /**
     * Set artwork url (logo) 100x100
     *
     * @param string $artworkUrl
     * @return Software
     */
    public function setArtworkUrl100($artworkUrl)
    {
        $this->artworkUrl100 = $artworkUrl;

        return $this;
    }

    /**
     * Get artwork url (logo) 100x100
     *
     * @return string
     */
    public function getArtworkUrl100()
    {
        return $this->artworkUrl100;
    }

    /**
     * Set artwork url (logo) 512x512
     *
     * @param string $artworkUrl512
     * @return Software
     */
    public function setArtworkUrl512($artworkUrl512)
    {
        $this->artworkUrl512 = $artworkUrl512;

        return $this;
    }

    /**
     * Get artwork url (logo) 512x512
     *
     * @return string
     */
    public function getArtworkUrl512()
    {
        return $this->artworkUrl512;
    }
}