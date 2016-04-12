<?php

namespace DataBundle\DataFixtures\ORM;


use DataBundle\Entity\Car;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CarFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    const REF_NAME_OPEL_ASTRA = 'car_opel_astra';
    const REF_NAME_FIAT_PUNTO = 'car_fiat_pnto';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $opelAstra = new Car();
        $opelAstra->setName('Opel Astra');
        $manager->persist($opelAstra);
        $this->addReference(self::REF_NAME_OPEL_ASTRA, $opelAstra);

        $fiatPunto = new Car();
        $fiatPunto->setName('Fiat Punto');
        $manager->persist($fiatPunto);
        $this->addReference(self::REF_NAME_FIAT_PUNTO, $fiatPunto);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return DataFixtureOrder::CAR;
    }


}