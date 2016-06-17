<?php

// src/AppBundle/Controller/AdminController.php
namespace AppBundle\Controller;

use AppBundle\Form\Type\OrderType;
use AppBundle\Entity\Order;
use AppBundle\Entity\OrderProduct;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;

class AdminController extends EasyAdminController
{
	/**
     * @Route("/admin/", name="easyadmin")
     */
    public function indexAction(Request $request)
    {
        return parent::indexAction($request);
    }

    /**
     * Creates the form used to create an entity.
     *
     * @param object $entity
     * @param array  $entityProperties
     *
     * @return Form
     */
    protected function createOrderEditForm($entity, array $entityProperties)
    {
    	$entity = new Order();
        $tag1 = new OrderProduct();
        $tag1->setName('tag1');
        $tag1->setUnitPrice(200);
        $entity->getProducts()->add($tag1);
        $tag2 = new OrderProduct();
        $tag2->setName('tag2');
        $tag2->setUnitPrice(400);
        $entity->getProducts()->add($tag2);

    	return $this->createForm(OrderType::class, $entity);
    }

}