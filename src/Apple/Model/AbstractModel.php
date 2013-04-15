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

use Apple\AppStore\AppStoreInterface;

/**
 * Abstract core for control apple models
 */
abstract class AbstractModel
{
    /**
     * @var integer
     */
    protected $trackId;

    /**
     * @var AppStoreInterface
     */
    protected $appStore;

    /**
     * @var string
     */
    protected $artistName;

    /**
     * @var integer
     */
    protected $artistId;

    /**
     * Implements of \Serializable
     */
    public function serialize()
    {
        $data = array();

        foreach (get_object_vars($this) as $propertyName => $propertyValue) {
            $data[$propertyName] = $propertyValue;
        }

        return serialize($data);
    }

    /**
     * Implements if \Serializable
     */
    public function unserialize($str)
    {
        $data = @unserialize($str);

        if ($data === FALSE) {
            throw new \RuntimeException(sprintf('Can\'t unserialize model data: %s', $str));
        }

        if (!is_array($data)) {
            throw new \RuntimeException(sprintf('Unserialized data must be array, "%s" given.', gettype($data)));
        }

        foreach ($data as $propertyName => $propertyValue) {
            if (!property_exists($this, $propertyName)) {
                throw new \LogicException(sprintf('Undefined property "%s" in model "%s". Allowed properies: "%s".', $propertyName, get_class($this), implode('", "', array_keys(get_object_vars($this)))));
            }

            $this->{$propertyName} = $propertyValue;
        }
    }

    /**
     * Set track ID
     *
     * @param int $trackId
     * @return $this
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;

        return $this;
    }

    /**
     * Get track ID
     *
     * @return integer
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * Set app store
     *
     * @param AppStoreInterface $appStore
     * @return $this
     */
    public function setAppStore(AppStoreInterface $appStore)
    {
        $this->appStore = $appStore;

        return $this;
    }

    /**
     * Get app store
     *
     * @return AppStoreInterface
     */
    public function getAppStore()
    {
        return $this->appStore;
    }

    /**
     * Set artist name
     *
     * @param string $artistName
     * @return $this
     */
    public function setArtistName($artistName)
    {
        $this->artistName = $artistName;

        return $this;
    }

    /**
     * Get artist name
     *
     * @return string
     */
    public function getArtistName()
    {
        return $this->artistName;
    }

    /**
     * Set artist ID
     *
     * @param integer $artistId
     * @return $this
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;

        return $this;
    }

    /**
     * Get artist ID
     *
     * @return integer
     */
    public function getArtistId()
    {
        return $this->artistId;
    }
}