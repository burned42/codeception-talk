<?php

use Codeception\Example;
use Facebook\WebDriver\WebDriverKeys;

class ExampleSearchCest
{
    /**
     * @example ["https://google.com"]
     * @example ["https://duckduckgo.com"]
     */
    public function testSearchForCodeception(AcceptanceTester $I, Example $example): void
    {
        $I->amOnUrl($example[0]);

        $I->fillField(['name' => 'q'], 'Codeception');
        $I->pressKey(['name' => 'q'], WebDriverKeys::ENTER);

        $I->see('Codeception', 'a');
        $I->seeElement('a', ['href' => 'https://codeception.com/']);
    }
}
