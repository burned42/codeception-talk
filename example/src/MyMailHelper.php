<?php

namespace App;

use InvalidArgumentException;

class MyMailHelper
{
    /**
     * Example method to have something to unit test using different inputs.
     * Generates a salutation for usage the beginning of a mail text.
     *
     * @param string $language
     * @param string $gender
     * @param string $name
     *
     * @return string
     */
    public static function getSalutation(string $language, string $gender, string $name): string
    {
        switch ($language) {
            case 'de':
                $salutation = 'Sehr';

                if ($gender === 'male') {
                    $salutation .= ' geehrter Herr '.$name.',';
                } elseif ($gender === 'female') {
                    $salutation .= ' geehrte Frau '.$name.',';
                } else {
                    throw new InvalidArgumentException('gender not implemented');
                }

                break;
            case 'en':
                $salutation = 'Dear';

                if ($gender === 'male') {
                    $salutation .= ' Mr '.$name;
                } elseif ($gender === 'female') {
                    $salutation .= ' Ms '.$name;
                } else {
                    throw new InvalidArgumentException('gender not implemented');
                }

                break;
            default:
                throw new InvalidArgumentException('language not implemented');
        }

        return $salutation;
    }
}
