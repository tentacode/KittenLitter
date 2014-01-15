<?php

namespace App\Controller;

class CatController extends Controller
{
    public function indexAction(array $cats)
    {
        return ['cats' => $cats];
    }

    public function searchAction()
    {
        $term = $this->getRequest()->get('term');

        $cats = $this->get('fos_elastica.index.kitten.cat')
            ->search($term)
        ;
        
        return [
            'cats' => $cats,
            'term' => $term
        ];
    }
}