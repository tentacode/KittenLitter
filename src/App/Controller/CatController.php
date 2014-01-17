<?php

namespace App\Controller;

class CatController extends Controller
{
    public function indexAction(array $cats)
    {
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $cats,
            $this->get('request')->query->get('page', 1),
            9
        );

        return ['cats' => $pagination];
    }
}