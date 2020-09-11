<?php

namespace App\Controller;

use App\Entity\Club;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubController extends AbstractController
{
    /**
     * @Route("/club", name="club")
     */
    public function index()
    {   $em=$this->getDoctrine()->getManager();
        $clubs=$em->getRepository(Club::class)->showAllClubByTitle();
       return $this->render('club/index.html.twig',
            ['clubs'=>$clubs]
        );

    }





}
