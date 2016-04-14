<?php

namespace RestAPIBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarController extends FOSRestController
{
    public function getCarManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Car');
    }

    /**
     * List all cars.
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
    public function getCarsAction()
    {
        $cars = $this->getCarManager()->findAll();
        return ['cars' => $cars];
    }

    /**
     * Get a single car.
     *
     * ApiDoc(
     *   output = "DataBundle\Entity\Car",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the car is not found"
     *   }
     * )
     *
     * @Annotations\View(templateVar="car")
     *
     * @param Request $request the request object
     * @param int     $id      the note id
     *
     * @return array
     *
     * @throws NotFoundHttpException when note not exist
     */
    public function getCarAction(Request $request, $id)
    {
        $car = $this->getCarManager()->find($id);
        if (is_null($car)) {
            throw $this->createNotFoundException("Car does not exist.");
        }

        $view = new View($car);

        return $view;
    }
}
