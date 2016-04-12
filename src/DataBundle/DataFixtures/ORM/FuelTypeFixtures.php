<?php

namespace DataBundle\DataFixtures\ORM;


use DataBundle\Entity\FuelType;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FuelTypeFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    const REF_NAME_BENZINA = 'fuel_type_benzina';
    const REF_NAME_GPL = 'fuel_type_gpl';
    const REF_NAME_METANO = 'fuel_type_metano';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $benzina = new FuelType();
        $benzina->setName('Benzina');
        $manager->persist($benzina);
        $this->addReference(self::REF_NAME_BENZINA, $benzina);

        $gpl = new FuelType();
        $gpl->setName('Gpl');
        $manager->persist($gpl);
        $this->addReference(self::REF_NAME_GPL, $gpl);

        $metano = new FuelType();
        $metano->setName('Metano');
        $manager->persist($metano);
        $this->addReference(self::REF_NAME_METANO, $metano);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return DataFixtureOrder::FUEL_TYPE;
    }
}