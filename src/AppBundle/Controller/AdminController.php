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
}