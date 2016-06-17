<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Order
 *
 * @ORM\Table(name="`order`")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\OrderRepository")
 */
class Order
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Client")
     *
     * @var AppBundle\Entity\Client;
     */
    protected $client;

    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Campaign")
     *
     * @var AppBundle\Entity\Campaign
     */
    protected $campaign;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderProduct", mappedBy="order", cascade={"persist"})
     *
     * @var AppBundle\Entity\OrderProduct
     */
    protected $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * Set client
     *
     * @param \AppBundle\Entity\Client $client
     *
     * @return Client
     */
    public function setClient(\AppBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \AppBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set campaign
     *
     * @param \AppBundle\Entity\Campaign $campaign
     *
     * @return Campaign
     */
    public function setCampaign(\AppBundle\Entity\Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \AppBundle\Entity\Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }

    /**
     * Implement toStriing magic function
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getProduct();
    }

    /**
     * Get the products
     *
     * @return ArrayCollection
     */
    public function getProducts()
    {
        return $this->products;
    }

    /**
     * Add products
     *
     * @param \AppBundle\Entity\OrderProduct $products
     * @return Order
     */
    public function addProduct(\AppBundle\Entity\OrderProduct $products)
    {
        $this->products[] = $products;

        return $this;
    }

    /**
     * Remove products
     *
     * @param \AppBundle\Entity\OrderProduct $products
     */
    public function removeProduct(\AppBundle\Entity\OrderProduct $products)
    {
        $this->products->removeElement($products);
    }
}
