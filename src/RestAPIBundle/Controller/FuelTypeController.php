<?php

namespace RestAPIBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

class FuelTypeController extends FOSRestController
{
    public function getFuelTypeManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:FuelType');
    }

    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * List all fueltypes.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View()
     *
     * @return array
     */
    public function getFuelTypesAction()
    {
        $fuelTypes = $this->getFuelTypeManager()->findAll();
        return ['types' => $fuelTypes];
    }

}
