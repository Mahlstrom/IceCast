# IceCast
A simple class that parses status.xsl and returns the stream-data as objects.

Installation:
```
composer require mahlstrom/icecast
```


Example:
```
<?php
require_once 'vendor/autoload.php';
 
$streams=new \mahlstrom\IceCast\IceCastStatus('127.0.0.1:8000');
print_r($streams);
```
Output:
```
mahlstrom\IceCast\IceCastStatus Object
(
    [streams] => Array
        (
            [0] => mahlstrom\IceCast\IceCastStream Object
                (
                    [name] => pop_radio_aacp
                    [streamTitle] => pop_radio
                    [contentType] => audio/aacp
                    [mountStart] => 31/Jan/2017:01:29:38 +0100
                    [bitrate] => 64
                    [currentListeners] => 0
                    [peakListeners] => 0
                    [streamGenre] => -
                    [currentSong] => RIHANNA - RUSSIAN ROULETTE
                )
        )

)
```
