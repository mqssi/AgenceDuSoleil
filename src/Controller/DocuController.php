<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocuController extends AbstractController
{




    /**
     * @Route ("/documentation", name = "docu.index")
     *
     * 
     */
    public function index(): Response
    {

        return $this->render('pages/docu.html.twig',[

            'current_menu'=> 'docs'



        ]);


    }





}