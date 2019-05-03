<?php

class ExceptionCest
{
    public function testConstructor(UnitTester $I): void
    {
        $exception = new Exception();

        $I->assertInstanceOf(Exception::class, $exception);
    }

    public function testGetMessage(UnitTester $I): void
    {
        $message = 'foobar';

        $exception = new Exception($message);

        $I->assertEquals($message, $exception->getMessage());
    }
}
