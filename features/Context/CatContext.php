<?php

namespace Context;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Context\TurnipAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Exception\ExpectationException;
use Behat\Behat\Tester\Exception\PendingException;

class CatContext extends RawMinkContext implements ContextInterface, TurnipAcceptingContext
{
    /**
     * @Then I should see :visibleCatNumber cats
     * @Then I should see :visibleCatNumber cats out of :totalCatNumber
     */
    public function iShouldSeeCatsOutOfTotalCats($visibleCatNumber, $totalCatNumber = null)
    {
        $cats = $this->getListedCats();
        if (sizeof($cats) != $visibleCatNumber) {
            throw new ExpectationException(sprintf(
                '%s cats were expected but only %s were found.',
                $visibleCatNumber,
                sizeof($cats)
            ), $this->getSession());
        }

        if ($totalCatNumber !== null) {
            $this->assertTotalCats($totalCatNumber);
        }
    }

    protected function getListedCats()
    {
        return $this
            ->getSession()
            ->getPage()
            ->findAll('css', '.listed-cat')
        ;
    }

    protected function assertTotalCats($totalCatNumber)
    {
        $this->assertSession()->pageTextContains(sprintf("There's as much as %s cats", $totalCatNumber));
    }
}
