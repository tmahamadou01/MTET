<?php

namespace MarmitonBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MarmitonBundle:Default:index.html.twig');
    }

    /**
     * @Route("/receipes")
     */
    public function receipesAction()
    {
        return $this->render('MarmitonBundle:Default:receipes.html.twig');
    }
}
