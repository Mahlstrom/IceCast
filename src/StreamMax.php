<?php
/**
 * Created by PhpStorm.
 * User: mahlstrom
 * Date: 08/12/14
 * Time: 13:15
 */

namespace mahlstrom\IceCast;


use DateTime;

class StreamMax
{

    private $maxStation = [];
    private $changed = false;
    private $filePath = '';

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        if (file_exists($filePath)) {
            $this->maxStation = json_decode(file_get_contents($filePath), true);
        }
    }

    public function checkValue($station, $value, Datetime $date)
    {
        if (!array_key_exists($station, $this->maxStation)) {
            $this->maxStation[$station] = [
                'max' => $value,
                'date' => $date->format('Y-m-d H:i:s')
            ];
            $this->maxStation[$station]['history'][$date->format('Y-m-d')] = $value;
            $this->changed = true;
        } else {
            if ($this->maxStation[$station]['max'] < $value) {
                $this->maxStation[$station]['max'] = $value;
                $this->maxStation[$station]['date'] = $date->format('Y-m-d H:i:s');
                $this->maxStation[$station]['history'][$date->format('Y-m-d')] = $value;
                $this->changed = true;
            }
        }
    }

    public function dump()
    {
        if ($this->changed) {
            $this->save();
        }
    }

    private function save()
    {
        if ($this->changed) {
            file_put_contents($this->filePath, json_encode($this->maxStation, JSON_PRETTY_PRINT));
            $this->changed = 0;
        }
    }

    public function __destruct()
    {
        if ($this->changed) {
            $this->save();
        }
    }
}
