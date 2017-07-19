<?php

namespace MarmitonBundle\Controller;

use MarmitonBundle\Entity\Receipts;
use MarmitonBundle\Form\Type\ReceiptsType;
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

    /**
     * @Route("/receipes/add")
     */
    public function AddReceiptAction()
    {
        //$receipts= new
        $receipts = new Receipts();
        $form = $this->createForm(ReceiptsType::class, $receipts, ['csrf_protection' => false]);
        return $this->render('MarmitonBundle:Default:addreceipt.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
