<?php


namespace DataBundle\Tests\Integration;


use DataBundle\DataFixtures\ORM\CarFixtures;
use DataBundle\DataFixtures\ORM\PetrolStationFixtures;
use DataBundle\DataFixtures\ORM\RefuelFixtures;
use DataBundle\Entity\Car;
use DataBundle\Entity\PetrolStation;
use DataBundle\Repository\CarRepository;
use DataBundle\Repository\PetrolStationRepository;
use DataBundle\Repository\RefuelRepository;
use Doctrine\Common\DataFixtures\ProxyReferenceRepository;
use Doctrine\ORM\EntityRepository;
use Liip\FunctionalTestBundle\Test\WebTestCase;
use Symfony\Bundle\FrameworkBundle\Client;

class EntityManagerRemoveTest extends WebTestCase
{
    /**
     * @var ProxyReferenceRepository
     */
    protected $fixtures;

    protected $baseFixtures = [
        'DataBundle\DataFixtures\ORM\CarFixtures',
        'DataBundle\DataFixtures\ORM\FuelTypeFixtures',
        'DataBundle\DataFixtures\ORM\PetrolStationFixtures',
        'DataBundle\DataFixtures\ORM\RefuelFixtures',
    ];

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var CarRepository
     */
    private $carRepository;

    /**
     * @var PetrolStationRepository
     */
    private $petrolStationRepository;

    /**
     * @var RefuelRepository
     */
    private $reFuelRepository;

    protected function setUp()
    {
        $this->fixtures = $this->loadFixtures($this->baseFixtures)->getReferenceRepository();
        $this->client = $this->createClient();
        $this->em = $this->client->getContainer()->get('doctrine.orm.entity_manager');
        $this->carRepository = $this->em->getRepository('DataBundle:Car');
        $this->petrolStationRepository = $this->em->getRepository('DataBundle:PetrolStation');
        $this->reFuelRepository = $this->em->getRepository('DataBundle:Refuel');
    }

    public function testRemoveRefuelButNothingBrokenBetweenRefuelAndCarRelation()
    {
        // Arrange
        $refuel = $this->reFuelRepository->find($this->fixtures->getReference(RefuelFixtures::REF_NAME_ASTRA_1));
        /* @var PetrolStation $petrolStation */
        $petrolStation = $this->petrolStationRepository->find($this->fixtures->getReference(PetrolStationFixtures::REF_NAME_AGIP));
        // Act
        $this->em->remove($refuel);
        $this->em->flush();
        $petrolStation->setName('TE 24/24');
        $this->em->persist($petrolStation);
        $this->em->flush();
        // Assert
        $this->assertNull($this->reFuelRepository->find($this->fixtures->getReference(RefuelFixtures::REF_NAME_ASTRA_1)));
        $this->petrolStationRepository->clear();
        $petrolStation = $this->petrolStationRepository->find($petrolStation->getId());
        $this->assertEquals('TE 24/24', $petrolStation->getName() );
    }

    public function testRemoveCarWithRefuelCollectionAssociatedCascadeRemoveRefuelCollection()
    {
        // Arrange
        /* @var Car $car */
        $car = $this->carRepository->find($this->fixtures->getReference(CarFixtures::REF_NAME_FIAT_PUNTO));
        $carId = $car->getId();
        // Act
        $this->em->remove($car);
        $this->em->flush();
        $carRefuels = $this->reFuelRepository->findBy(['car' => $carId]);
        // Assert
        $this->assertEquals(0, count($carRefuels));
    }
}