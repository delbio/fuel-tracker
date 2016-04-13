<?php

namespace DataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Car
 *
 * @ORM\Table(name="car")
 * @ORM\Entity(repositoryClass="DataBundle\Repository\CarRepository")
 */
class Car
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
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="Refuel", mappedBy="car", cascade={"remove"})
     */
    private $refuels;

    /**
     * Car constructor.
     */
    public function __construct()
    {
        $this->refuels = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Car
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
     * @return ArrayCollection
     */
    public function getRefuels()
    {
        return $this->refuels;
    }

    /**
     * @param ArrayCollection $refuels
     * @return Car
     */
    public function setRefuels($refuels)
    {
        if ($refuels instanceof ArrayCollection)
            $this->refuels = $refuels;

        if (is_array($refuels))
            $this->refuels = new ArrayCollection($refuels);

        return $this;
    }

    /**
     * @param Refuel $refuel
     * @return $this
     */
    public function addRefuel(Refuel $refuel)
    {
        if ( !$this->refuels->contains($refuel) ) {
            $this->refuels[] = $refuel;
        }
        return $this;
    }

    /**
     * @param Refuel $refuel
     * @return bool
     */
    public function removeRefuel(Refuel $refuel)
    {
        return $this->refuels->removeElement($refuel);
    }

}
