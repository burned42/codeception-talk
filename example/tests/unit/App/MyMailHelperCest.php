<?php

namespace App;

use Codeception\Example;
use InvalidArgumentException;
use UnitTester;

class MyMailHelperCest
{
    /**
     * @example ["de", "male", "Doe", "Sehr geehrter Herr Doe,"]
     * @example ["en", "male", "Doe", "Dear Mr Doe"]
     * @example ["de", "female", "Doe", "Sehr geehrte Frau Doe,"]
     * @example ["en", "female", "Doe", "Dear Ms Doe"]
     */
    public function testGetSalutation(UnitTester $I, Example $example): void
    {
        $salutation = MyMailHelper::getSalutation(
            $example[0],
            $example[1],
            $example[2]
        );

        $I->assertEquals($example[3], $salutation);
    }

    public function testExceptionOnInvalidLanguage(UnitTester $I): void
    {
        $I->expectThrowable(
            InvalidArgumentException::class,
            static function () {
                MyMailHelper::getSalutation('foobar', 'male', 'Test');
            }
        );

        $I->expectThrowable(
            new InvalidArgumentException('language not implemented'),
            static function () {
                MyMailHelper::getSalutation('foobar', 'male', 'Test');
            }
        );
    }
}
