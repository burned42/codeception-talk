<?php

use Codeception\Example;
use Codeception\Util\HttpCode;

class RestCountriesCest
{
    /**
     * @example ["de", "Germany"]
     * @example ["us", "United States of America"]
     */
    public function testCountrySearchByISOAlpha2(ApiTester $I, Example $example): void
    {
        $I->sendGET('/alpha/'.$example[0]);
        $I->pause();

        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeResponseIsJson();
        $I->seeResponseMatchesJsonType([
            'name' => 'string',
            'population' => 'integer',
        ]);
        $I->seeResponseContainsJson(['name' => $example[1]]);
    }

    public function testErrorOnInvalidISOAlpha2(ApiTester $I): void
    {
        $I->sendGET('/alpha/xyz');

        $I->seeResponseCodeIs(HttpCode::NOT_FOUND);

        $response = json_decode($I->grabResponse(), true);
        $I->assertEquals('Not Found', $response['message']);

        codecept_debug($response);
    }

    public function testErrorOnPost(ApiTester $I): void
    {
        $I->haveHttpHeader('Content-Type', 'application/json');

        $I->sendPOST('/alpha/de', ['nope' => 'nope']);

        $I->seeResponseCodeIs(HttpCode::METHOD_NOT_ALLOWED);
    }
}
