<?php

namespace RestAPIBundle\Controller;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the car is not found"
     *   }
     * )
     * @Annotations\View()
     *
     * @param int     $carId      the car id
     *
     * @return array
     */
    public function getRefuelsAction($carId)
    {
        $car = $this->getCarManager()->find($carId);
        if (is_null($car)) {
            throw $this->createNotFoundException("Car does not exist.");
        }
        return ['refuels' => $car->getRefuels()];
    }

    /**
     * Get a single car refuel.
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the refuel is not found"
     *   }
     * )
     * @Annotations\View()
     *
     * @param int     $carId      the car id
     * @param int     $id   the refuel id
     *
     * @return View
     *
     * @throws NotFoundHttpException when refuel not exist
     */
    public function getRefuelAction($carId, $id)
    {
        $refuel = $this->getRefuelManager()->findOneBy(['car' => $carId, 'id' => $id]);

        if (is_null($refuel)) {
            throw $this->createNotFoundException("Refuel does not exist.");
        }

        $view = new View($refuel);

        return $view;
    }

    /**
     * Removes a refuel.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful",
     *     404 = "Returned when the refuel is not found"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $carId   the car id
     * @param int     $id      the car id
     *
     * @return View
     *
     * @throws NotFoundHttpException when refuel not exist
     */
    public function deleteRefuelsAction(Request $request, $carId, $id)
    {
        $refuel = $this->getRefuelManager()->findOneBy(['car' => $carId, 'id' => $id]);

        if (is_null($refuel)) {
            throw $this->createNotFoundException("Refuel does not exist.");
        }
        $em = $this->getEntityManager();
        $em->remove($refuel);
        $em->flush();

        // There is a debate if this should be a 404 or a 204
        // see http://leedavis81.github.io/is-a-http-delete-requests-idempotent/
        return $this->routeRedirectView('get_cars_refuels', array('carId' => $carId), Response::HTTP_NO_CONTENT);
    }
}
