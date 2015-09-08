<?php

namespace AppBundle\EntityService;


use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Knp\Component\Pager\Paginator;

abstract class EntityServiceBase implements ContainerAwareInterface{


    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }

    /**
     * Sets the Container.
     *
     * @param ContainerInterface|null $container A ContainerInterface instance or null
     *
     * @api
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer() {
        return $this->container;
    }
    /**
     * @return Registry
     */
    public function getDoctrine() {
        return $this->get('doctrine');
    }

    /**
     * @return Paginator
     */
    public function getPaginator() {
        return $this->get('knp_paginator');;
    }
    public function get($id) {
        return $this->container->get($id);
    }

    public function saveObject($object, $flush = true) {
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);

        if($flush){
            $em->flush();
        }
    }


    public function removeObject($object) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
    }

     public function getFormValue($form, $field, $default = null) {
        if(!array_key_exists($field, $form)) {
            return $default;
        }

        return $form[$field];
    }

    protected abstract  function getRepository();
}