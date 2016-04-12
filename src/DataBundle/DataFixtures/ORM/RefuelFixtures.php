<?php

namespace DataBundle\DataFixtures\ORM;


use DataBundle\Entity\Refuel;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RefuelFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    const REF_NAME_PUNTO_1 = 'refuel_punto_1';
    const REF_NAME_PUNTO_2 = 'refuel_punto_2';
    const REF_NAME_ASTRA_1 = 'refuel_astra_1';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $refuelPunto1 = new Refuel();
        $refuelPunto1Date = new \DateTime();
        $refuelPunto1Date->setDate(2016, 4, 10);
        $refuelPunto1->setDate($refuelPunto1Date)
            ->setCar($this->getReference(CarFixtures::REF_NAME_FIAT_PUNTO))
            ->setCarDistance(1000)
            ->setType($this->getReference(FuelTypeFixtures::REF_NAME_BENZINA))
            ->setPetrolStation($this->getReference(PetrolStationFixtures::REF_NAME_AGIP))
            ->setUnitPrice(1.23)
            ->setAmountPurchased(20.50);
        $manager->persist($refuelPunto1);
        $this->addReference(self::REF_NAME_PUNTO_1, $refuelPunto1);

        $refuelPunto2 = new Refuel();
        $refuelPunto2Date = new \DateTime();
        $refuelPunto2Date->setDate(2016, 4, 12);
        $refuelPunto2->setDate($refuelPunto2Date)
            ->setCar($this->getReference(CarFixtures::REF_NAME_FIAT_PUNTO))
            ->setCarDistance(1300)
            ->setType($this->getReference(FuelTypeFixtures::REF_NAME_BENZINA))
            ->setPetrolStation($this->getReference(PetrolStationFixtures::REF_NAME_ESSO))
            ->setUnitPrice(1.25)
            ->setAmountPurchased(15.00);
        $manager->persist($refuelPunto2);
        $this->addReference(self::REF_NAME_PUNTO_2, $refuelPunto2);

        $refuelAstra1 = new Refuel();
        $refuelAstra1Date = new \DateTime();
        $refuelAstra1Date->setDate(2016, 4, 9);
        $refuelAstra1->setDate($refuelAstra1Date)
            ->setCar($this->getReference(CarFixtures::REF_NAME_OPEL_ASTRA))
            ->setCarDistance(3000)
            ->setType($this->getReference(FuelTypeFixtures::REF_NAME_GPL))
            ->setPetrolStation($this->getReference(PetrolStationFixtures::REF_NAME_TAMOIL))
            ->setUnitPrice(0.59)
            ->setAmountPurchased(14.00);
        $manager->persist($refuelAstra1);
        $this->addReference(self::REF_NAME_ASTRA_1, $refuelAstra1);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return DataFixtureOrder::REFUEL;
    }
}