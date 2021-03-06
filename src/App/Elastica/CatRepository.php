<?php

namespace App\Elastica;

use FOS\ElasticaBundle\Repository;
use Elastica\Query;
use Elastica\Query\QueryString;
use Elastica\Filter\Term;

class CatRepository extends Repository
{
    public function findLikeForPaginator($filter)
    {
        $query = new Query();
        
        if (isset($filter['term'])) {
            $qs = new QueryString();
            $qs->setQuery($filter['term']);
            $query->setQuery($qs);
        }

        if (isset($filter['gender'])) {
            $gender  = new Term();
            $gender->setTerm('gender', strtolower($filter['gender']));
            $query->setFilter($gender);
        }

        return $this->createPaginatorAdapter($query);
    }
}