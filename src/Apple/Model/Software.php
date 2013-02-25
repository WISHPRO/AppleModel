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
     * @var integer
     */
    protected $platform;

    /**
     * @var string $trackName
     */
    protected $trackName;

    /**
     * @var boolean
     */
    protected $gameCenter = false;

    /**
     * @var array
     */
    protected $supportedDevices = array();

    /**
     * @var string
     */
    protected $trackViewUrl;

    /**
     * @var array
     */
    protected $screenshotUrls = array();

    /**
     * @var array
     */
    protected $iPadScreenshotUrls = array();

    /**
     * @var float
     */
    protected $price;

    /**
     * @var string
     */
    protected $currency;

    /**
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
     * @var string
     */
    protected $sellerName;

    /**
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
     * @var string
     */
    protected $fileSize;

    /**
     * @var integer
     */
    protected $userRatingCount = 0;

    /**
     * @var float
     */
    protected $averageUserRating = 0;

    /**
     * @var integer
     */
    protected $userRatingCountCurrent = 0;

    /**
     * @var float
     */
    protected $averageUserRatingCurrent = 0;

    /**
     * @var array
     */
    protected $languagesISO2A = array();

    /**
     * @var Genre
     */
    protected $primaryGenre;

    /**
     * @var string
     */
    protected $artworkUrl60;

    /**
     * @var string
     */
    protected $artworkUrl100;

    /**
     * @var string
     */
    protected $artworkUrl512;

    /**
     * Set software platform
     *
     * @param integer $platform
     */
    public function setPlatform($platform)
    {
        if (!in_array($platform, array(Software::PLATFORM_MAC, Software::PLATFORM_IOS), TRUE)) {
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
     *
     * @return integer
     */
    public function getTypeIos()
    {
        if ($this->platform !== Software::PLATFORM_IOS) {
            throw new \LogicException('Can\'t get type iOS in Mac software.');
        }

        if ($this->screenshotUrls && $this->iPadScreenshotUrls) {
            return Software::TYPE_IOS_UNIVERSAL;
        } else if ($this->screenshotUrls) {
            return Software::TYPE_IOS_IPHONE;
        } else if ($this->iPadScreenshotUrls) {
            return Software::TYPE_IOS_IPAD;
        } else {
            throw new \LogicException('Can\'t get type iOS. Undefined screenshots');
        }
    }

    /**
     * Set software name
     *
     * @param string  $trackName
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
     * Set status game center
     *
     * @param bool $gameCenter
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
     *   if iPhone or Mac software
     *
     * @param array $screenshotUrls
     */
    public function setScreenshotUrls(array $screenshotUrls)
    {
        $this->screenshotUrls = $screenshotUrls;

        return $this;
    }

    /**
     * Get screenshots url
     *
     * @return array
     */
    public function getScreenshotUrls()
    {
        return $this->screenshotUrls;
    }

    /**
     * Set iPad screenshots url
     *
     * @param array $iPadScreenshotUrls
     */
    public function setIpadScreenshotUrls(array $iPadScreenshotUrls)
    {
        $this->iPadScreenshotUrls = $iPadScreenshotUrls;

        return $this;
    }

    /**
     * Get iPad screenshots url
     *
     * @return array
     */
    public function getIpadScreenshotUrls()
    {
        return $this->iPadScreenshotUrls;
    }

    /**
     * Set price
     *
     * @param float $price
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
     */
    public function setUserRatingCount($userRatingCount)
    {
        $userRatingCount = (int) $userRatingCount;

        if ($userRatingCount < 0) {
            throw new \InvalidArgumentException(sprintf('User rating can\'t be less than "0", "%s" given.', $userRatingCount));
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
     */
    public function setAverageUserRating($averageUserRating)
    {
        $averageUserRating = (float) $averageUserRating;

        if ($averageUserRating < 0 || $averageUserRating > 5) {
            throw new \InvalidArgumentException(sprintf('Average user rating must be beetwen 0 and 5, "%s" given.', $averageUserRating));
        }

        if ($averageUserRating && fmod($averageUserRating, 0.5)) {
            throw new \InvalidArgumentException(sprintf('Rating must be division by 0.5, "%s" given.', $averageUserRating));
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
     */
    public function setUserRatingCountCurrent($userRatingCountCurrent)
    {
        $userRatingCountCurrent = (int) $userRatingCountCurrent;

        if ($userRatingCountCurrent < 0) {
            throw new \InvalidArgumentException(sprintf('User rating can\'t be less than "0", "%s" given.', $userRatingCountCurrent));
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
     */
    public function setAverageUserRatingCurrent($averageUserRatingCurrent)
    {
        $averageUserRatingCurrent = (float) $averageUserRatingCurrent;

        if ($averageUserRatingCurrent < 0 || $averageUserRatingCurrent > 5) {
            throw new \InvalidArgumentException(sprintf('Average user rating must be beetwen 0 and 5, "%s" given.', $averageUserRatingCurrent));
        }

        if ($averageUserRatingCurrent && fmod($averageUserRatingCurrent, 0.5)) {
            throw new \InvalidArgumentException(sprintf('Rating must be division by 0.5, "%s" given.', $averageUserRatingCurrent));
        }

        $this->averageUserRatingCurrent = $averageUserRatingCurrent;

        return $this;
    }

    /**
     * Get average user rating for currect version
     *
     * @return float
     */
    public function getAverageUserRatingCurrent()
    {
        return $this->averageUserRatingCurrent;
    }

    /**
     * Set languages in ISO2A
     *
     * @param array $languagesISO2A
     */
    public function setLanguagesISO2A(array $languagesISO2A)
    {
        $this->languagesISO2A = $languagesISO2A;

        return $this;
    }

    /**
     * Get languages
     *
     * @return array
     */
    public function getLanguagesISO2A()
    {
        return $this->languagesISO2A;
    }

    /**
     * Set primary category (Genre)
     *
     * @param Category $genre
     */
    public function setPrimaryGenre(Genre $genre)
    {
        $this->primaryGenre = $genre;

        return $this;
    }

    /**
     * Get primary category ID
     *
     * @return string
     */
    public function getPrimaryGenre()
    {
        return $this->primaryGenere;
    }

    /**
     * Set artwork URL 60
     *
     * @param string $artworkUrl
     */
    public function setArtworkUrl60($artworkUrl)
    {
        $this->artworkUrl60 = $artworkUrl;

        return $this;
    }

    /**
     * Get artwork URL 60
     *
     * @return string
     */
    public function getArtworkUrl60()
    {
        return $this->artworkUrl60;
    }

    /**
     * Set artwork URL 100
     *
     * @param string $artworkUrl
     */
    public function setArtworkUrl100($artworkUrl)
    {
        $this->artworkUrl100 = $artworkUrl;

        return $this;
    }

    /**
     * Get artwork URL 100
     *
     * @return string
     */
    public function getArtworkUrl100()
    {
        return $this->artworkUrl100;
    }

    /**
     * Set artwork URL 512
     *
     * @param string $artworkUrl512
     */
    public function setArtworkUrl512($artworkUrl512)
    {
        $this->artworkUrl512 = $artworkUrl512;

        return $this;
    }

    /**
     * Get artwork URL 512
     */
    public function getArtworkUrl512()
    {
        return $this->artworkUrl512;
    }
}