<?php

namespace RestAPIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('RestAPIBundle:Default:index.html.twig');
    }
}
