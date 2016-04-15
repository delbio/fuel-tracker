<?php

namespace RestAPIBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class PetrolStationController extends FOSRestController
{
    public function getPetrolStationManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:PetrolStation');
    }

    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * List all petrostations.
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Annotations\View()
     *
     * @return array
     */
    public function getPetrolStationsAction()
    {
        $cars = $this->getPetrolStationManager()->findAll();
        return ['petrol_stations' => $cars];
    }

}
