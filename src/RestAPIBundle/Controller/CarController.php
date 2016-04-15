<?php

namespace RestAPIBundle\Controller;

use DataBundle\Entity\Car;
use DataBundle\Form\CarType;

use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CarController extends FOSRestController
{
    public function getCarManager()
    {
        return $this->getDoctrine()->getRepository('DataBundle:Car');
    }

    public function getEntityManager()
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * List all cars.
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
    public function getCarsAction()
    {
        $cars = $this->getCarManager()->findAll();
        return ['cars' => $cars];
    }

    /**
     * Get a single car.
     *
     * @ApiDoc(
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
     * @param int     $id      the car id
     *
     * @return View
     *
     * @throws NotFoundHttpException when car not exist
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

    /**
     * Creates a new car from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "DataBundle\Form\CarType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface[]|View
     */
    public function postCarsAction(Request $request)
    {
        $car = new Car();
        $form = $this->createForm(new CarType(), $car);

        $form->submit($request);
        if ($form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($car);
            $em->flush();

            return $this->routeRedirectView('get_car', array('id' => $car->getId()));
        }

        return array(
            'form' => $form
        );
    }

    /**
     * Removes a car.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful",
     *     404 = "Returned when the car is not found"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the car id
     *
     * @return View
     *
     * @throws NotFoundHttpException when car not exist
     */
    public function deleteCarsAction(Request $request, $id)
    {
        $car = $this->getCarManager()->find($id);

        if (is_null($car)) {
            throw $this->createNotFoundException("Car does not exist.");
        }
        $em = $this->getEntityManager();
        $em->remove($car);
        $em->flush();

        // There is a debate if this should be a 404 or a 204
        // see http://leedavis81.github.io/is-a-http-delete-requests-idempotent/
        return $this->routeRedirectView('get_cars', array(), Response::HTTP_NO_CONTENT);
    }
}
