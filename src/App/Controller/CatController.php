<?php

namespace App\Controller;

class CatController
{
    public function indexAction(array $cats)
    {
        return ['cats' => $cats];
    }
}