<?php

namespace App\DataFixtures\ORM;

use Knp\RadBundle\DataFixtures\ORM\LoadAliceFixtures as BaseLoadAliceFixtures;
use App\Faker\Provider\CatProvider;
use Faker\Generator;

class LoadAliceFixtures extends BaseLoadAliceFixtures
{
    const SEED = 1337;

    protected function getAliceOptions()
    {
        $fakerGenerator = new Generator();
        $fakerGenerator->seed(self::SEED);

        return array(
            'providers' => array($this, new CatProvider($fakerGenerator, $this->container)),
            'seed' => self::SEED
        );
    }
}
