<?php

namespace AppBundle\Controller;

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



        ));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction()
    {
        return $this->render('@App/default/index.html.twig', array(



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
    public function generateAction()
    {

        $this->getService()->generateCard([]);

        return $this->render('@App/default/generator_form.html.twig', array(

        ));
    }
    //'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),

    /**
     * @return BonusCardService
     */
    protected function getService(){
        return $this->get('app.bonusCard');
    }
}
