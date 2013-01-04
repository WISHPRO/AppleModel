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
 * Abstract core for control apple models
 */
abstract class AbstractModel implements ModelInterface
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
     * Impelements if \Serializable
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
     * @{inerhitDoc}
     */
    public function setTrackId($trackId)
    {
        $this->trackId = $trackId;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getTrackId()
    {
        return $this->trackId;
    }

    /**
     * @{inerhitDoc}
     */
    public function setAppStore(AppStoreInterface $appStore)
    {
        $this->appStore = $appStore;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getAppStore()
    {
        return $this->appStore;
    }

    /**
     * @{inerhitDoc}
     */
    public function setArtistName($artistName)
    {
        $this->artistName = $artistName;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getArtistName()
    {
        return $this->artistName;
    }

    /**
     * @{inerhitDoc}
     */
    public function setArtistId($artistId)
    {
        $this->artistId = $artistId;

        return $this;
    }

    /**
     * @{inerhitDoc}
     */
    public function getArtistId()
    {
        return $this->artistId;
    }
}