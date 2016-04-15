<?php

namespace RestAPIBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;

class ReFuelController extends FOSRestController
{
    public function getCarManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Car');
    }

    public function getRefuelManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Refuel');
    }

    public function getEntityManager()
    {
        return $this->getDoctrine()->getEntityManager();
    }

    /**
     * List all refuels.
     * ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Annotations\View()
     *
     * @var Request $request
     * @return array
     */
    public function getRefuelsAction(Request $request, $carId)
    {
        $car = $this->getCarManager()->find($carId);
        if (is_null($car)) {
            throw $this->createNotFoundException("Car does not exist.");
        }
        return ['refuels' => $car->getRefuels()];
    }

}
