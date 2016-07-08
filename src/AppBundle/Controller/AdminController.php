<?php

// src/AppBundle/Controller/AdminController.php
namespace AppBundle\Controller;

use AppBundle\Form\Type\OrderType;
use AppBundle\Entity\Order;
use AppBundle\Entity\OrderProduct;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as EasyAdminController;
use JavierEguiluz\Bundle\EasyAdminBundle\Event\EasyAdminEvents;
use Doctrine\Common\Collections\ArrayCollection;

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
     * Overwrite edit order action
     */
    public function editOrderAction()
    {
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        $order = $this->em->getRepository('AppBundle:Order')->find($id);
        $originalProducts = new ArrayCollection();

        // Create an ArrayCollection of the current Tag objects in the database
        foreach ($order->getProducts() as $product) {
            $originalProducts->add($product);
        }

        if ($this->request->isXmlHttpRequest() && $property = $this->request->query->get('property')) {
            $newValue = 'true' === strtolower($this->request->query->get('newValue'));
            $fieldsMetadata = $this->entity['list']['fields'];

            if (!isset($fieldsMetadata[$property]) || 'toggle' !== $fieldsMetadata[$property]['dataType']) {
                throw new \RuntimeException(sprintf('The type of the "%s" property is not "toggle".', $property));
            }

            $this->updateEntityProperty($entity, $property, $newValue);

            return new Response((string) $newValue);
        }

        $fields = $this->entity['edit']['fields'];

        $editForm = $this->createEditForm($entity, $fields);
        $deleteForm = $this->createDeleteForm($this->entity['name'], $id);

        $editForm->handleRequest($this->request);
        if ($editForm->isValid()) {
            foreach ($originalProducts as $product) {
                if (false === $entity->getProducts()->contains($product)) {
                    $product->setOrder(null);

                    $this->em->persist($product);

                    $this->em->remove($product);
                }
            }

            foreach ($entity->getProducts() as $product)
            {
                $product->setOrder($entity);
            }

            $this->em->persist($entity);
            $this->em->flush();

            $refererUrl = $this->request->query->get('referer', '');

            return !empty($refererUrl)
                ? $this->redirect(urldecode($refererUrl))
                : $this->redirect($this->generateUrl('easyadmin', array('action' => 'list', 'entity' => $this->entity['name'])));
        }

        return $this->render($this->entity['templates']['edit'], array(
            'form' => $editForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * The method that is executed when the user performs a 'new' action on an entity.
     *
     * @return RedirectResponse|Response
     */
    protected function newOrderAction()
    {
        $entity = $this->createNewEntity();

        $easyadmin = $this->request->attributes->get('easyadmin');
        $easyadmin['item'] = $entity;
        $this->request->attributes->set('easyadmin', $easyadmin);

        $fields = $this->entity['new']['fields'];

        $newForm = $this->createNewForm($entity, $fields);;

        $newForm->handleRequest($this->request);
        if ($newForm->isValid()) {

            foreach ($entity->getProducts() as $product)
            {
                $product->setOrder($entity);
            }

            $this->em->persist($entity);
            $this->em->flush();

            $refererUrl = $this->request->query->get('referer', '');

            return !empty($refererUrl)
                ? $this->redirect(urldecode($refererUrl))
                : $this->redirect($this->generateUrl('easyadmin', array('action' => 'list', 'entity' => $this->entity['name'])));
        }

        return $this->render($this->entity['templates']['new'], array(
            'form' => $newForm->createView(),
            'entity_fields' => $fields,
            'entity' => $entity,
        ));
    }

    /**
     * The method is used to display order invocie
     *
     * @return RedirectResponse|Response
     */
    public function viewOrderInvoiceAction()
    {
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        return $this->render('easy_admin/Order/viewInvoice.html.twig', array(
            'entity' => $entity
        ));

    }

    /**
     * The method is used to display campaign invocie
     *
     * @return RedirectResponse|Response
     */
    public function viewCampaignInvoiceAction()
    {
        $id = $this->request->query->get('id');
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        return $this->render('easy_admin/Campaign/viewInvoice.html.twig', array(
            'entity' => $entity
        ));
    }

}