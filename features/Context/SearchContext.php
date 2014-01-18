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

    /**
     * @Given I am on the advanced search page
     */
    public function iAmOnTheAdvancedSearchPage()
    {
        $this->getSession()->visit($this->locatePath('/search'));
    }

    /**
     * @When I search for cats that are :gender
     * @When I search for cats that are :gender and named :name
     */
    public function iSearchForCatsThatAre($gender, $name = null)
    {
        $this->getSession()->getPage()->selectFieldOption('form_gender', $gender);
        if ($name !== null) {
            $this->getSession()->getPage()->fillField('Search', $name);
        }

        $this->getSession()->getPage()->pressButton('Search');
    }

}