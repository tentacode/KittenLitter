<?php

namespace Context;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Context\TurnipAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Exception\ExpectationException;
use Behat\Behat\Tester\Exception\PendingException;

class SearchContext extends RawMinkContext implements ContextInterface, TurnipAcceptingContext
{
    /**
     * @When I use the quick search to find for :search
     */
    public function iUseTheQuickSearchToFindFor($search)
    {
        $this->getSession()->getPage()->fillField('Search', $search);
        $this->getSession()->getPage()->pressButton('Search teh kitten');
    }
}