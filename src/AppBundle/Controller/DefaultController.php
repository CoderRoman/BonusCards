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
        return $this->render('@App/default/index.html.twig', array(
            'pagination' => $this->getList(),
            'statusCards' => BonusCardStatusHelper::instance()->getAllStatus()

        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        $search = $this->get('request')->query->get('search');


        return $this->render('@App/default/index.html.twig', array(

            'pagination' => $this->getList($search),
            'statusCards' => BonusCardStatusHelper::instance()->getAllStatus()

        ));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */

    public function deleteAction($id)
    {
        try {
            $card=$this->getService()->getBonusCardById($id);
            if (!$card)
                throw new \Exception('Error');

            $this->getService()->removeCard($card);
            return $this->redirect($this->generateUrl('homepage'));

        }
        catch(\Exception $e) {


        }
        return $this->render('@App/default/index.html.twig', array(


            'pagination' => $this->getList(),
            'statusCards' => BonusCardStatusHelper::instance()->getAllStatus()
        ));



    }

    /**
     * @Route("/toggle_activate/{id}", name="toggleActivate")
     */
    public function toggleActivateAction($id)
    {
        try {
            $card=$this->getService()->getBonusCardById($id);
            if (!$card)
                throw new \Exception('Error');

            $this->getService()->toggleActivateCard($card);
            return $this->redirect($this->generateUrl('homepage'));

        }
        catch(\Exception $e) {


        }
        return $this->render('@App/default/index.html.twig', array(


            'pagination' => $this->getList(),
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
        return $pagination = $this->get('knp_paginator')->paginate(
            $this->getService()->getCardsListQuery($params),
            $this->get('request')->query->get('page', 1),
            50/*limit per page*/
        );
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
