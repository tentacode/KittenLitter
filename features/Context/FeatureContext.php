<?php

namespace Context;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Context\TurnipAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\Tools\SchemaTool;

class FeatureContext extends RawMinkContext implements ContextInterface, TurnipAcceptingContext
{
    private $app;

    /**
     * Initializes context. Every scenario gets its own context object.
     *
     * @param array $parameters Suite parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        $this->app = new \AppKernel('test', true);
        $this->app->boot();
    }

    /**
     * @BeforeScenario
     */
    public function purge()
    {
        $em = $this->app->getContainer()->get('doctrine.orm.default_entity_manager');
        $schemaTool = new SchemaTool($em);
        $schemaTool->dropSchema($em->getMetadataFactory()->getAllMetadata());
        $schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());
    }

    /**
     * @BeforeScenario
     */
    public function loadAliceData()
    {
        exec('app/console doctrine:fixtures:load --env=test --no-interaction');
    }

    /**
     * @BeforeScenario
     */
    public function resetSession()
    {
        exec('rm -rf app/cache/test/sessions/*');
    }
}
