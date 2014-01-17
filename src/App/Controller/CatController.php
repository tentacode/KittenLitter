<?php

namespace App\Controller;

class CatController extends Controller
{
    public function indexAction(array $cats)
    {
        return ['cats' => $cats];
    }
}