<?php

namespace DataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Refuel
 *
 * @ORM\Table(name="refuel")
 * @ORM\Entity(repositoryClass="DataBundle\Repository\RefuelRepository")
 */
class Refuel
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="car_distance", type="integer")
     */
    private $carDistance;

    /**
     * @var float
     *
     * @ORM\Column(name="unit_price", type="float")
     */
    private $unitPrice;

    /**
     * @var float
     *
     * @ORM\Column(name="amount_purchased", type="float")
     */
    private $amountPurchased;

    /**
     * @var FuelType
     * @ORM\ManyToOne(targetEntity="FuelType")
     */
    private $type;

    /**
     * @var Car
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="refuels")
     */
    private $car;

    /**
     * @var PetrolStation
     * @ORM\ManyToOne(targetEntity="PetrolStation")
     */
    private $petrolStation;

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
     * Set date
     *
     * @param \DateTime $date
     * @return Refuel
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set carDistance
     *
     * @param integer $carDistance
     * @return Refuel
     */
    public function setCarDistance($carDistance)
    {
        $this->carDistance = $carDistance;

        return $this;
    }

    /**
     * Get carDistance
     *
     * @return integer 
     */
    public function getCarDistance()
    {
        return $this->carDistance;
    }

    /**
     * Set unitPrice
     *
     * @param float $unitPrice
     * @return Refuel
     */
    public function setUnitPrice($unitPrice)
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    /**
     * Get unitPrice
     *
     * @return float 
     */
    public function getUnitPrice()
    {
        return $this->unitPrice;
    }

    /**
     * Set amountPurchased
     *
     * @param float $amountPurchased
     * @return Refuel
     */
    public function setAmountPurchased($amountPurchased)
    {
        $this->amountPurchased = $amountPurchased;

        return $this;
    }

    /**
     * Get amountPurchased
     *
     * @return float 
     */
    public function getAmountPurchased()
    {
        return $this->amountPurchased;
    }

    /**
     * @return FuelType
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param FuelType $type
     * @return Refuel
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return Car
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * @param Car $car
     * @return Refuel
     */
    public function setCar($car)
    {
        $this->car = $car;
        return $this;
    }

    /**
     * @return PetrolStation
     */
    public function getPetrolStation()
    {
        return $this->petrolStation;
    }

    /**
     * @param PetrolStation $petrolStation
     * @return Refuel
     */
    public function setPetrolStation($petrolStation)
    {
        $this->petrolStation = $petrolStation;
        return $this;
    }

}
