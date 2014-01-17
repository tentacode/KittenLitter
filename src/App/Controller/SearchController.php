<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cat;

class SearchController extends Controller
{
    public function searchAction(Request $request)
    {
        $form = $this->getForm();
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
        } else {
            $form->submit(['term' => $request->get('term')]);
        }

        $searchFilter = $form->getData();

        $cats = $this
            ->get('fos_elastica.manager')
            ->getRepository('App:Cat')
            ->findLike($searchFilter)
        ;

        return [
            'cats' => $cats,
            'searchFilter' => $searchFilter,
            'form' => $form->createView()
        ];
    }

    private function getForm()
    {
        $builder = $this->createFormBuilder()
            ->add('term', 'search', [
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Search'
                ]
            ])
            ->add('gender', 'choice', [
                'required' => false,
                'empty_value' => 'Any gender',
                'choices' => [
                    'Male' => 'Male',
                    'Female' => 'Female'
                ],
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
        ;

        return $builder->getForm();
    }
}