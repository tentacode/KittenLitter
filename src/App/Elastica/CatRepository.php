<?php

namespace App\Elastica;

use FOS\ElasticaBundle\Repository;

class CatRepository extends Repository
{
    public function findLike($term)
    {
        return $this->find(sprintf('*%s*', $term));
    }
}