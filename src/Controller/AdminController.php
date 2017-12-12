<?php
// src/Controller/Admincontroller.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\StudentLocation;
use App\Repository\StudentLocationRepository;


class AdminController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $markers = $em->getRepository(StudentLocation::class)->findMarkers();

        

        return $this->render('map/map.html.twig');
    }

}
