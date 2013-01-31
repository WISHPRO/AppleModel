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
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getPlatform()
    {
        return $this->platform;
    }

    /**
     * {@inheritDoc}
     */
    public function getTypeIos()
    {
        if ($this->platform !== SoftwareInterface::PLATFORM_IOS) {
            throw new \LogicException('Can\'t get type iOS in Mac software.');
        }

        if (!$this->screenshotUrls && !$this->iPadScreenshotUrls) {
            throw new \InvalidArgumentException('Not found support devices and supported device.');
        }

        if ($this->screenshotUrls && $this->iPadScreenshotUrls) {
            return SoftwareInterface::TYPE_IOS_UNIVERSAL;
        } else if ($this->screenshotUrls) {
            return SoftwareInterface::TYPE_IOS_IPHONE;
        } else if ($this->iPadScreenshotUrls) {
            return SoftwareInterface::TYPE_IOS_IPAD;
        } else {
            throw new \LogicException('Can\'t get type iOS. Undefined screenshots');
        }
    }

    /**
     * {@inheritDoc}
     */
    public function setTrackName($trackName)
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTrackName()
    {
        return $this->trackName;
    }

    /**
     * {@inheritDoc}
     */
    public function setGameCenter($gameCenter)
    {
        $this->gameCenter = (bool) $gameCenter;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getGameCenter()
    {
        return $this->gameCenter;
    }

    /**
     * {@inheritDoc}
     */
    public function setSupportedDevices(array $supportedDevices)
    {
        $this->supportedDevices = $supportedDevices;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSupportedDevices()
    {
        return $this->supportedDevices;
    }

    /**
     * {@inheritDoc}
     */
    public function setTrackViewUrl($trackViewUrl)
    {
        $this->trackViewUrl = $trackViewUrl;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getTrackViewUrl()
    {
        return $this->trackViewUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setScreenshotUrls(array $screenshotUrls)
    {
        $this->screenshotUrls = $screenshotUrls;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getScreenshotUrls()
    {
        return $this->screenshotUrls;
    }

    /**
     * {@inheritDoc}
     */
    public function setIpadScreenshotUrls(array $iPadScreenshotUrls)
    {
        $this->iPadScreenshotUrls = $iPadScreenshotUrls;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getIpadScreenshotUrls()
    {
        return $this->iPadScreenshotUrls;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrice($price)
    {
        $this->price = (float) $price;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * {@inheritDoc}
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * {@inheritDoc}
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * {@inheritDoc}
     */
    public function setBundleId($bundleId)
    {
        $this->bundleId = $bundleId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getBundleId()
    {
        return $this->bundleId;
    }

    /**
     * {@inheritDoc}
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * {@inheritDoc}
     */
    public function setSellerName($sellerName)
    {
        $this->sellerName = $sellerName;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSellerName()
    {
        return $this->sellerName;
    }

    /**
     * {@inheritDoc}
     */
    public function setSellerUrl($sellerUrl)
    {
        $this->sellerUrl = $sellerUrl;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getSellerUrl()
    {
        return $this->sellerUrl;
    }

    /**
     * {@inheritDoc}
     */
    public function setReleaseDate(\DateTime $releaseDate)
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getReleaseDate()
    {
        return $this->releaseDate;
    }

    /**
     * {@inheritDoc}
     */
    public function setReleaseNotes($releaseNotes)
    {
        $this->releaseNotes = $releaseNotes;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getReleaseNotes()
    {
        return $this->releaseNotes;
    }

    /**
     * {@inheritDoc}
     */
    public function setFileSize($fileSize)
    {
        $this->fileSize = (int) $fileSize;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFileSize()
    {
        return $this->fileSize;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getUserRatingCount()
    {
        return $this->userRatingCount;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getAverageUserRating()
    {
        return $this->averageUserRating;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getUserRatingCountCurrent()
    {
        return $this->userRatingCountCurrent;
    }

    /**
     * {@inheritDoc}
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
     * {@inheritDoc}
     */
    public function getAverageUserRatingCurrent()
    {
        return $this->averageUserRatingCurrent;
    }

    /**
     * {@inheritDoc}
     */
    public function setLanguagesISO2A(array $languagesISO2A)
    {
        $this->languagesISO2A = $languagesISO2A;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getLanguagesISO2A()
    {
        return $this->languagesISO2A;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimaryGenreId($genreId)
    {
        $this->primaryGenreId = $genreId;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryGenreId()
    {
        return $this->primaryGenreId;
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimaryGenreName($genreName)
    {
        $this->primaryGenereName = $genreName;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryGenreName()
    {
        return $this->primaryGenereName;
    }

    /**
     * {@inheritDoc}
     */
    public function setArtworkUrl60($artworkUrl)
    {
        $this->artworkUrl60 = $artworkUrl;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtworkUrl60()
    {
        return $this->artworkUrl60;
    }

    /**
     * {@inheritDoc}
     */
    public function setArtworkUrl100($artworkUrl)
    {
        $this->artworkUrl100 = $artworkUrl;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtworkUrl100()
    {
        return $this->artworkUrl100;
    }

    /**
     * {@inheritDoc}
     */
    public function setArtworkUrl512($artworkUrl512)
    {
        $this->artworkUrl512 = $artworkUrl512;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getArtworkUrl512()
    {
        return $this->artworkUrl512;
    }
}