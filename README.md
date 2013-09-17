Apple models
============

Each models implements ModelInterface and have defaults method:

* setTrackId(integer $trackId)
* getTrackId()
* setAppStore(Apple\AppStore\AppStoreInterface $appStore)
* getAppStore()
* setArtistName(string $artistName)
* getArtistName()
* setArtistId(integer $artistId)
* getArtistId


Software model
--------------

Example code:
```php
use Apple\Model\Software;

$softwareModel = new Software;
$softwareModel
    ->setTrackId(123456789)
    ->setTrackName('Track name')
    // another setters
    ->setArtistId(54321)
    ->setArtistName('Artist name');

var_dump($softwareModel);
```
