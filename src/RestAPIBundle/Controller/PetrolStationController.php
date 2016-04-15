<?php

namespace RestAPIBundle\Controller;

use DataBundle\Entity\PetrolStation;
use DataBundle\Form\PetrolStationType;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormTypeInterface;
use Symfony\Component\HttpFoundation\Request;

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
    public function getPetrolstationsAction()
    {
        $cars = $this->getPetrolStationManager()->findAll();
        return ['petrol_stations' => $cars];
    }

    /**
     * Creates a new petrol station from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "DataBundle\Form\PetrolStationType",
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
    public function postPetrolstationsAction(Request $request)
    {
        $station = new PetrolStation();
        $form = $this->createForm(new PetrolStationType(), $station);

        $form->submit($request);
        if ($form->isValid()) {
            $em = $this->getEntityManager();
            $em->persist($station);
            $em->flush();

            return $this->routeRedirectView('get_petrolstations');
        }

        return array(
            'form' => $form
        );
    }

}
