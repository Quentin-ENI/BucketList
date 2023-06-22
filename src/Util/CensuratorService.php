<?php

namespace App\Util;

class CensuratorService
{
    const SLUR_WORDS = [
        "gast",
        "kaoc'h",
        "genaoueg"
    ];

    const SUFFIXES = [
        "ez",
        "ed",
        "ezed"
    ];

    public function purify(string $text) {

        foreach(self::SLUR_WORDS as $word) {
            // /\bgenaoueg(?:ez|ed|ezed)?\b/i
            $regex = '/\b' . preg_quote($word) . '(?:' . implode('|', self::SUFFIXES) . ')?\b/i';
            $text = preg_replace($regex, '****', $text);
        }

        return $text;
    }
}












