<?php
/**
 * Created by PhpStorm.
 * User: mahlstrom
 * Date: 10/09/14
 * Time: 19:05
 */

namespace mahlstrom\IceCast;


class IceCastStatus
{
    /** @var IceCastStream[] */
    public $streams = [];

    public function __construct($addr)
    {
        $D = new \DOMDocument();
        $D->loadHTMLFile('http://' . $addr . '/status.xsl');
        $tables = $D->getElementsByTagName('table');
        $i = 0;

        /** @var \DOMElement $tbl */
        /** @var \DOMElement $d2 */
        $C = new IceCastStream();
        foreach ($tables as $tbl) {
            $data2 = $tbl->getElementsByTagName('tr');
            foreach ($data2 as $d2) {
                $tds = $d2->getElementsByTagName('td');
                if (!($i % 2)) {
                    $C = new IceCastStream();
                    $C->name = str_replace('Mount Point /', '', $tds->item(0)->nodeValue);
                } else {
                    $k = (string)$tds->item(0)->nodeValue;
                    switch ($k) {
                        case 'Stream Title:':
                            $C->streamTitle = $tds->item(1)->nodeValue;
                            break;
                        case 'Content Type:':
                            $C->contentType = $tds->item(1)->nodeValue;
                            break;
                        case 'Mount Start:':
                            $C->mountStart = $tds->item(1)->nodeValue;
                            break;
                        case 'Bitrate:':
                            $C->bitrate = $tds->item(1)->nodeValue;
                            break;
                        case 'Current Listeners:':
                            $C->currentListeners = $tds->item(1)->nodeValue;
                            break;
                        case 'Peak Listeners:':
                            $C->peakListeners = $tds->item(1)->nodeValue;
                            break;
                        case 'Stream Genre:':
                            $C->streamGenre = $tds->item(1)->nodeValue;
                            break;
                        case 'Current Song:':
                            $C->currentSong = $tds->item(1)->nodeValue;
                            break;
                    }
#			echo sprintf('%28s %-28s', $tds->item(0)->nodeValue, $tds->item(1)->nodeValue) . PHP_EOL;
                }
            }
            if (($i % 2)) {
                $this->streams[] = $C;
#		print_r($C);
            }

            $i++;
        }

    }
}