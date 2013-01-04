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

use Apple\AppStore\AppStoreInterface;

/**
 * Interface for control all models in Apple stores
 */
interface ModelInterface extends \Serializable
{
    /**
     * Set track ID
     *
     * @param integer $trackId
     */
    public function setTrackId($trackId);

    /**
     * Get track ID
     *
     * @return integer
     */
    public function getTrackId();

    /**
     * Set app store
     *
     * @param AppStoreInterface $appStore
     */
    public function setAppStore(AppStoreInterface $appStore);

    /**
     * Get app store
     *
     * @return AppStoreInterface
     */
    public function getAppStore();

    /**
     * Set artist name
     *
     * @param string $artistName
     */
    public function setArtistName($artistName);

    /**
     * Get artist name
     *
     * @return string
     */
    public function getArtistName();

    /**
     * Set artist ID
     *
     * @param integer $artistId
     */
    public function setArtistId($artistId);

    /**
     * Get artist ID
     *
     * @return integer
     */
    public function getArtistId();
}