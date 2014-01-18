<?php

namespace Context;

use Behat\Behat\Context\Context as ContextInterface;
use Behat\Behat\Context\TurnipAcceptingContext;
use Behat\MinkExtension\Context\RawMinkContext;
use Doctrine\ORM\Tools\SchemaTool;
use AppKernel;

class FeatureContext extends RawMinkContext implements ContextInterface, TurnipAcceptingContext
{
    /**
     * @BeforeScenario
     */
    public function purge()
    {
        $app = new AppKernel('test', true);
        $app->boot();
        $em = $app->getContainer()->get('doctrine.orm.default_entity_manager');
        $schemaTool = new SchemaTool($em);
        $schemaTool->dropSchema($em->getMetadataFactory()->getAllMetadata());
        $schemaTool->createSchema($em->getMetadataFactory()->getAllMetadata());
    }

    /**
     * @BeforeScenario
     */
    public function resetSearchIndex()
    {
        exec('app/console fos:elastica:reset --env=test');
    }

    /**
     * @BeforeScenario @Alice
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
