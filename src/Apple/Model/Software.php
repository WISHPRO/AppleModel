<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyring and license information, please view the LICENSE
 * file that was distributed with this source code
 */

namespace Apple\Model;

/**
 * Software model
 */
class Software extends AbstractModel implements SoftwareInterface
{
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
    protected $gameCenter = FALSE;

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
     * @var integer
     */
    protected $primaryGenreId;

    /**
     * @var string
     */
    protected $primaryGenereName;

    /**
     * @var string
     */
    protected $artworkUrl160;

    /**
     * @{inerhitDoc}
     */
    public function setPlatform($platform)
    {
        if (!in_array($platform, array(SoftwareInterface::PLATFORM_MAC, SoftwareInterface::PLATFORM_IOS), TRUE)) {
            throw new \InvalidArgumentException(sprintf('Undefined software platform "%s".', $platform));
        }

        $this->platform = $platform;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * @{inerhitDoc}
     */
    public function getTypeIos()
    {
        if ($this->platform !== SoftwareInterface::PLATFORM_IOS) {
            throw new \LogicException('Can\'t get type iOS in Mac software.');
        }

        if (!$this->supportedDevices && !$this->screenshotUrls && !$this->iPadScreenshotUrls) {
            throw new \InvalidArgumentException('Not found support devices and supported device.');
        }

        if (in_array('all', $this->supportedDevices)) {
            return SoftwareInterface::TYPE_IOS_UNIVERSAL;
        }

        if ($this->screenshotUrls && $this->iPadScreenshotUrls) {
            return SoftwareInterface::TYPE_IOS_UNIVERSAL;
        }
        else if ($this->screenshotUrls) {
            return SoftwareInterface::TYPE_IOS_IPHONE;
        }
        else if ($this->iPadScreenshotUrls) {
            return SoftwareInterface::TYPE_IOS_IPAD;
        }
        else {
            throw new \LogicException('Can\'t get type iOS. Undefined screenshots');
        }
    }

    /**
     * @{inerhitDoc}
     */
    public function setTrackName($trackName)
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getTrackName()
    {
        return $this->trackName;
    }

    /**
     * @{inerhitDoc}
     */
    public function setGameCenter($gameCenter)
    {
        $this->gameCenter = (bool) $gameCenter;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getGameCenter()
    {
        return $this->gameCenter;
    }

    /**
     * @{inerhitDoc}
     */
    public function setSupportedDevices(array $supportedDevices)
    {
        $this->supportedDevices = $supportedDevices;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getSupportedDevices()
    {
        return $this->supportedDevices;
    }

    /**
     * @{inerhitDoc}
     */
    public function setTrackViewUrl($trackViewUrl)
    {
        $this->trackViewUrl = $trackViewUrl;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getTrackViewUrl()
    {
        return $this->trackViewUrl;
    }

    /**
     * @{inerhitDoc}
     */
    public function setScreenshotUrls(array $screenshotUrls)
    {
        $this->screenshotUrls = $screenshotUrls;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getScreenshotUrls()
    {
        return $this->screenshotUrls;
    }

    /**
     * @{inerhitDoc}
     */
    public function setIpadScreenshotUrls(array $iPadScreenshotUrls)
    {
        $this->iPadScreenshotUrls = $iPadScreenshotUrls;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getIpadScreenshotUrls()
    {
        return $this->iPadScreenshotUrls;
    }

    /**
     * @{inerhitDoc}
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @{inerhitDoc}
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @{inerhitDoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @{inerhitDoc}
     */
    public function setBundleId($bundleId)
    {
        $this->bundleId = $bundleId;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getBundleId()
    {
        return $this->bundleId;
    }

    /**
     * @{inerhitDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @{inerhitDoc}
     */
    public function setSellerName($sellerName)
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getSellerName()
    {
        return $this->sellerName;
    }

    /**
     * @{inerhitDoc}
     */
    public function setSellerUrl($sellerUrl)
    {
        $this->sellerUrl = $sellerUrl;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getSellerUrl()
    {
        return $this->sellerUrl;
    }

    /**
     * @{inerhitDoc}
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * @{inerhitDoc}
     */
    public function setReleaseNotes($releaseNotes)
    {
        $this->releaseNotes = $releaseNotes;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getReleaseNotes()
    {
        return $this->releaseNotes;
    }

    /**
     * @{inerhitDoc}
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = (int) $fileSize;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * @{inerhitDoc}
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
     * @{inerhitDoc}
     */
    public function getUserRatingCount()
    {
        return $this->userRatingCount;
    }

    /**
     * @{inerhitDoc}
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
     * @{inerhitDoc}
     */
    public function getAverageUserRating()
    {
        return $this->averageUserRating;
    }

    /**
     * @{inerhitDoc}
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
     * @{inerhitDoc}
     */
    public function getUserRatingCountCurrent()
    {
        return $this->userRatingCountCurrent;
    }

    /**
     * @{inerhitDoc}
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
     * @{inerhitDoc}
     */
    public function getAverageUserRatingCurrent()
    {
        return $this->averageUserRatingCurrent;
    }

    /**
     * @{inerhitDoc}
     */
    public function setLanguagesISO2A(array $languagesISO2A)
    {
        $this->languagesISO2A = $languagesISO2A;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getLanguagesISO2A()
    {
        return $this->languagesISO2A;
    }

    /**
     * @{inerhitDoc}
     */
    public function setPrimaryGenreId($genreId)
    {
        $this->primaryGenreId = $genreId;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getPrimaryGenreId()
    {
        return $this->primaryGenreId;
    }

    /**
     * @{inerhitDoc}
     */
    public function setPrimaryGenreName($genreName)
    {
        $this->primaryGenereName = $genreName;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getPrimaryGenreName()
    {
        return $this->primaryGenereName;
    }

    /**
     * @{inerhitDoc}
     */
    public function setArtworkUrl160($artworkUrl160)
    {
        $this->artworkUrl160 = $artworkUrl160;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getArtworkUrl160()
    {
        return $this->artworkUrl160;
    }
}