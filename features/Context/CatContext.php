<?php

namespace Context;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Context\TurnipAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Exception\ExpectationException;
use Behat\Behat\Tester\Exception\PendingException;
use Faker\Factory as FakerFactory;
use Faker\ORM\Doctrine\Populator;
use AppKernel;
use App\Faker\Provider\Cat as CatProvider;

class CatContext extends RawMinkContext implements ContextInterface, TurnipAcceptingContext
{
    private $app;

    public function __construct(array $parameters)
    {
        $this->app = new AppKernel('test', true);
        $this->app->boot();
    }

    /**
     * @Given there is :number cats
     * @Given there is :number :gender cats
     */
    public function thereIsGenderCats($number, $gender = null)
    {
        $em = $this->app->getContainer()->get('doctrine.orm.entity_manager');

        $generator = FakerFactory::create();
        $generator->seed(123456789);

        $catProvider = new CatProvider($generator);

        if ($gender === null) {
            $customOptions = [
                'gender' => function() use ($catProvider) { return $catProvider->gender(); },
                'name' => function() use ($catProvider) { return $catProvider->catName($catProvider->gender()); }
            ];
        } else {
            $gender = ucfirst($gender);
            $customOptions = [
                'gender' => $gender,
                'name' => function() use ($catProvider, $gender) { return $catProvider->catName($gender); }
            ];
        }

        $populator = new Populator($generator, $em);
        $populator->addEntity('App\Entity\Cat', $number, $customOptions);
        $populator->execute();
    }

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

    /**
     * @Then I should not see any cats
     */
    public function iShouldNotSeeAnyCats()
    {
        $this->assertSession()->pageTextContains("No kittens were found :(");
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
