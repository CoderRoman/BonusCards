<?php

namespace AppBundle\Controller;

use AppBundle\Entity\BonusCardStatusHelper;
use AppBundle\EntityService\BonusCardService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $pagination = $this->get('knp_paginator')->paginate(
            $this->getList(),
            $this->get('request')->query->get('page', 1),
            50/*limit per page*/
        );
        return $this->render('@App/default/index.html.twig', array(
            'pagination' => $pagination,
            'statusCards' => BonusCardStatusHelper::instance()->getAllStatus()

        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        $pagination = $this->get('knp_paginator')->paginate(
            $this->getList(),
            $this->get('request')->query->get('page', 1),
            50/*limit per page*/
        );

        return $this->render('@App/default/index.html.twig', array(

            'pagination' => $pagination,
            'statusCards' => BonusCardStatusHelper::instance()->getAllStatus()

        ));
    }

    /**
     * @Route("/detail", name="detail")
     */
    public function detailAction()
    {
        return $this->render('@App/default/index.html.twig', array(



        ));
    }

    protected function getList(array $params=null){

        return $this->getService()->getCardsListQuery($params);
    }

    /**
     * @Route("/generator", name="generator_form")
     */
    public function generatorAction()
    {
         return $this->render('@App/default/generator_form.html.twig', array(

        ));
    }
    /**
     * @Route("/generate", name="generate")
     */
    public function generateAction(Request $request)
    {
        try {
            $form = $request->request->get('form');
            $validation = $this->getService()->validate($form);
            if($validation->isValid()) {
                $this->getService()->generateCard($form);
                return $this->redirect($this->generateUrl('homepage'));
            }
        } catch(\Exception $e) {
            die($e->getMessage());
            return $this->render('@App/default/generator_form.html.twig', array(

            ));
        }



    }

    /**
     * @return BonusCardService
     */
    protected function getService(){
        return $this->get('app.bonusCard');
    }
}
