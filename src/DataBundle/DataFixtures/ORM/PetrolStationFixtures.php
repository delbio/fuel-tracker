<?php

namespace DataBundle\DataFixtures\ORM;


use DataBundle\Entity\PetrolStation;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PetrolStationFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    const REF_NAME_ESSO = 'petrol_station_esso';
    const REF_NAME_TAMOIL = 'petrol_station_tamoil';
    const REF_NAME_Q8 = 'petrol_station_q8';
    const REF_NAME_AGIP = 'petrol_station_agip';

    /**
     * @inheritDoc
     */
    public function load(ObjectManager $manager)
    {
        $esso = new PetrolStation();
        $esso->setName('Esso');
        $manager->persist($esso);
        $this->addReference(self::REF_NAME_ESSO, $esso);

        $tamoil = new PetrolStation();
        $tamoil->setName('Tamoil');
        $manager->persist($tamoil);
        $this->addReference(self::REF_NAME_TAMOIL, $tamoil);

        $q8 = new PetrolStation();
        $q8->setName('Q8');
        $manager->persist($q8);
        $this->addReference(self::REF_NAME_Q8, $q8);

        $agip = new PetrolStation();
        $agip->setName('Agip');
        $manager->persist($agip);
        $this->addReference(self::REF_NAME_AGIP, $agip);

        $manager->flush();
    }

    /**
     * @inheritDoc
     */
    public function getOrder()
    {
        return DataFixtureOrder::PETROL_STATION;
    }


}