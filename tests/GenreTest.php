<?php

/**
 * This file is part of the AppleModel package
 *
 * (c) Vitaliy Zhuk <zhuk2205@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code
 */

use Apple\Model\Genre;

/**
 * Genre testing
 */
class GenreTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerGenre
     */
    public function testDefault($id, $name)
    {
        $genre = new Genre();
        $genre->setId($id);
        $genre->setName($name);

        $this->assertEquals($id, $genre->getId());
        $this->assertEquals($name, $genre->getName());
    }

    /**
     * Provider for testing genre
     */
    public function providerGenre()
    {
        return array(
            array(1, 'Foo'),
            array(2, 'bar')
        );
    }
}