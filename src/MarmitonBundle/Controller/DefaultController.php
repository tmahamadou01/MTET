<?php

namespace MarmitonBundle\Controller;

use MarmitonBundle\Entity\Receipts;
use MarmitonBundle\Form\Type\ReceiptsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $receipes = $em->getRepository('MarmitonBundle:Receipts')->findAll();

        //var_dump($receipes);die();
        return $this->render('MarmitonBundle:Default:index.html.twig', array(
            'receipts' => $receipes
        ));
        //return $this->render('MarmitonBundle:Default:index.html.twig');
    }

    /**
     * @Route("/receipess")
     */
    public function receipesxAction()
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $receipes = $em->getRepository('MarmitonBundle:Receipts')->findAll();

        //var_dump($receipes);die();
        return $this->render('MarmitonBundle:Default:receipes.html.twig', array(
            'receipts' => $receipes
        ));
    }

    /**
     * @Route("/receipes", name="index_receipes")
     */
    public function receipesAction(Request $request)
    {
        $em    = $this->get('doctrine.orm.entity_manager');
        $dql   = "SELECT r FROM MarmitonBundle:Receipts r ORDER BY r.id DESC ";
        $query = $em->createQuery($dql);

        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            8/*limit per page*/
        );

        // parameters to template
        return $this->render('MarmitonBundle:Default:receipes.html.twig', array('pagination' => $pagination));
    }

    /**
     * @Route("/search", name="search")
     */
    public function searchAction(Request $request)
    {
        $data = $request->request->all();

        //var_dump($data);die();
        $repo = $this->getDoctrine()
            ->getRepository('MarmitonBundle:Receipts');
        $query = $repo->createQueryBuilder('r')
            ->where('r.name LIKE :name')
            ->setParameter('name', '%'.$data['search'].'%')
            ->getQuery();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            8/*limit per page*/
        );
        return $this->render('MarmitonBundle:Default:receipes.html.twig', array('pagination'=>$pagination));
    }

    /**
     * @Route("/receipes/add", name="add_receipes")
     */
    public function AddReceiptAction(Request $request)
    {
        //$receipts= $this->
        $receipts = new Receipts();
        $form = $this->createForm(ReceiptsType::class, $receipts, ['csrf_protection' => false]);
        $session = $this->get('session');
        $em = $this->get('doctrine.orm.entity_manager');

        if($request->isMethod('post'))
        {
            $form->handleRequest($request);
            if ($form->isValid()){
                $receipts->uploadProfilePicture();
                $em->persist($receipts);
                $em->flush();
                //var_dump($request);die();
                $this->get('session')->getFlashBag()->add(
                    'notice',
                    array(
                        'alert' => 'success',
                        'title' => 'Success!',
                        'message' => 'Votre recette a été envoyé avec succès.'
                    )
                );
                return $this->redirect($this->generateUrl('add_receipes'));
            }
            $session->getFlashBag()->add('error', 'Renseignez les champs obligatoire');
        }
        return $this->render('MarmitonBundle:Default:addreceipt.html.twig',[
            'form' => $form->createView(),
            'receiptes' => $receipts
        ]);
    }

    /**
     * @Route("/receipes/id/{id}", name="detail_receipes")
     * @param $id
     */
    public function detailReceipesAction(Request $request, $id)
    {
        $em = $this->get('doctrine.orm.entity_manager');
        $receipes = $em->getRepository('MarmitonBundle:Receipts')->findOneBy(['id' => $id]);

        $list_ingredient_array = explode(',', $receipes->ingredients);
        //var_dump($list_ingredient_array);die();

        return $this->render('MarmitonBundle:Default:detail.html.twig',[
            'receipes' => $receipes,
            'ingredients' => $list_ingredient_array
        ]);
    }



}
