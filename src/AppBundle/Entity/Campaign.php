<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Campaign
 *
 * @ORM\Table(name="campaign")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CampaignRepository")
 */
class Campaign
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="order_date", type="date")
     */
    private $orderDate;

    /**
     * @var string
     *
     * @ORM\Column(name="invoice_value", type="decimal")
     */
    private $invoiceValue;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="payment_date", type="date")
     */
    private $paymentDate;

    /**
     * @var string
     *
     * @ORM\Column(name="profit", type="decimal")
     */
    private $profit;


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
     * Set name
     *
     * @param string $name
     * @return Campaign
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set orderDate
     *
     * @param \DateTime $orderDate
     * @return Campaign
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;

        return $this;
    }

    /**
     * Get orderDate
     *
     * @return \DateTime
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * Set invoiceValue
     *
     * @param string $invoiceValue
     * @return Campaign
     */
    public function setInvoiceValue($invoiceValue)
    {
        $this->invoiceValue = $invoiceValue;

        return $this;
    }

    /**
     * Get invoiceValue
     *
     * @return string
     */
    public function getInvoiceValue()
    {
        return $this->invoiceValue;
    }

    /**
     * Set paymentDate
     *
     * @param \DateTime $paymentDate
     * @return Campaign
     */
    public function setPaymentDate($paymentDate)
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /**
     * Get paymentDate
     *
     * @return \DateTime
     */
    public function getPaymentDate()
    {
        return $this->paymentDate;
    }

    /**
     * Set profit
     *
     * @param string $profit
     * @return Campaign
     */
    public function setProfit($profit)
    {
        $this->profit = $profit;

        return $this;
    }

    /**
     * Get profit
     *
     * @return string
     */
    public function getProfit()
    {
        return $this->profit;
    }

    /**
     * Define magic function toString
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
