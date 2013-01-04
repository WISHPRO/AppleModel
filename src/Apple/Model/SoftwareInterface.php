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
 * Interface for control apple software model
 */
interface SoftwareInterface
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
     * Set platform
     *
     * @param integer $platform
     */
    public function setPlatform($platform);

    /**
     * Get platform
     *
     * @return integer
     */
    public function getPlatform();

    /**
     * Get type IOS
     *
     * @return integer
     */
    public function getTypeIos();

    /**
     * Set track name
     *
     * @param string $trackName
     */
    public function setTrackName($trackName);

    /**
     * Get track name
     *
     * @return string
     */
    public function getTrackName();

    /**
     * Set game center enabled
     *
     * @param boolean $gameCenter
     */
    public function setGameCenter($gameCenter);

    /**
     * Get game center
     *
     * @return boolean
     */
    public function getGameCenter();

    /**
     * Set supported devices
     *
     * @param array $supportedDevices
     */
    public function setSupportedDevices(array $supportedDevices);

    /**
     * Get supported devices
     *
     * @return array
     */
    public function getSupportedDevices();

    /**
     * Set track view URL
     *
     * @param string $trackViewUrl
     */
    public function setTrackViewUrl($trackViewUrl);

    /**
     * Get track view URL
     *
     * @return string
     */
    public function getTrackViewUrl();

    /**
     * Set screenshot urls
     *
     * @param array $screenshotUrls
     */
    public function setScreenshotUrls(array $screenshotUrls);

    /**
     * Get screenshot urls
     *
     * @return array
     */
    public function getScreenshotUrls();

    /**
     * Set iPad screenshot urls
     *
     * @param array $iPadScreenshotUrls
     */
    public function setIpadScreenshotUrls(array $iPadScreenshotUrls);

    /**
     * Get iPad screenshot urls
     *
     * @return array
     */
    public function getIpadScreenshotUrls();

    /**
     * Set price
     *
     * @param float $price
     */
    public function setPrice($price);

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice();

    /**
     * Set price currency
     *
     * @param string $currency
     */
    public function setCurrency($currency);

    /**
     * Get price currency
     *
     * @return string
     */
    public function getCurrency();

    /**
     * Set version
     *
     * @param string $version
     */
    public function setVersion($version);

    /**
     * Get version
     *
     * @return string
     */
    public function getVersion();

    /**
     * Set bundle ID
     *
     * @param string $bundleId
     */
    public function setBundleId($bundleId);

    /**
     * Get bundle ID
     *
     * @return string
     */
    public function getBundleId();

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description);

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription();

    /**
     * Set seller name
     *
     * @param string $sellerName
     */
    public function setSellerName($sellerName);

    /**
     * Get seller name
     *
     * @return string
     */
    public function getSellerName();

    /**
     * Set seller url
     *
     * @param string $sellerUrl
     */
    public function setSellerUrl($sellerUrl);

    /**
     * Get seller URL
     *
     * @return string
     */
    public function getSellerUrl();

    /**
     * Set release date
     *
     * @param \DateTime $releaseDate
     */
    public function setReleaseDate(\DateTime $releaseDate);

    /**
     * Get release date
     *
     * @return \DateTime
     */
    public function getReleaseDate();

    /**
     * Set release notes
     *
     * @param string $releaseNotes
     */
    public function setReleaseNotes($releaseNotes);

    /**
     * Get release notes
     *
     * @return string
     */
    public function getReleaseNotes();

    /**
     * Set file size
     *
     * @param integer $fileSize
     */
    public function setFileSize($fileSize);

    /**
     * Get file size
     *
     * @return integer
     */
    public function getFileSize();

    /**
     * Set user rating count
     *
     * @param integer $userRatingCount
     */
    public function setUserRatingCount($userRatingCount);

    /**
     * Get user rating count
     *
     * @return integer
     */
    public function getUserRatingCount();

    /**
     * Set average user rating
     *
     * @param float $userAverageRating
     */
    public function setAverageUserRating($userAverageRating);

    /**
     * Get average user rating
     *
     * @return float
     */
    public function getAverageUserRating();

    /**
     * Set user rating count for current version
     *
     * @param integer $userRatingCount
     */
    public function setUserRatingCountCurrent($userRatingCount);

    /**
     * Get user rating count for current version
     *
     * @return integer
     */
    public function getUserRatingCountCurrent();

    /**
     * Set average user rating for current version
     *
     * @param float $averageUserRating
     */
    public function setAverageUserRatingCurrent($averageUserRating);

    /**
     * Get average user rating for current version
     *
     * @return float
     */
    public function getAverageUserRatingCurrent();

    /**
     * Set languages ISO2A
     *
     * @param array $languagesISO2A
     */
    public function setLanguagesISO2A(array $languagesISO2A);

    /**
     * Get languages ISO2A
     *
     * @return array
     */
    public function getLanguagesISO2A();

    /**
     * Set primary genre ID
     *
     * @param integer $genreId
     */
    public function setPrimaryGenreId($genreId);

    /**
     * Get primary genre ID
     *
     * @return integer
     */
    public function getPrimaryGenreId();

    /**
     * Set primary genre name
     *
     * @param string $genreName
     */
    public function setPrimaryGenreName($genreName);

    /**
     * Get primary genre name
     *
     * @return string
     */
    public function getPrimaryGenreName();

    /**
     * Set artwork url [60]
     *
     * @param string $artworkUrl
     */
    public function setArtworkUrl60($artworkUrl);

    /**
     * Get artwork url [60]
     *
     * @return string
     */
    public function getArtworkUrl60();

    /**
     * Set artwork url [100]
     *
     * @param string $artworkUrl
     */
    public function setArtworkUrl100($artworkUrl);

    /**
     * Get artwork url [100]
     *
     * @return string
     */
    public function getArtworkUrl100();

    /**
     * Set artwork url [512]
     *
     * @param string $artworkUrl
     */
    public function setArtworkUrl512($artworkUrl);

    /**
     * Get artwork url [512]
     *
     * @return string
     */
    public function getArtworkUrl512();
}