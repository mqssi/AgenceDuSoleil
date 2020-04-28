<?php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
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


    /**
     * @Route("/download", name="download_file")
    **/
     public function downloadFile()
    {
        $response = new BinaryFileResponse('../EasyStock.rar');
        $response->setContentDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT,'EasyStock.rar');
        return $response;


    }


}