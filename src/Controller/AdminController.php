<?php
// src/Controller/Admincontroller.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\StudentLocation;
use App\Repository\StudentLocationRepository;
use App\Form\LocationType;


class AdminController extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $em = $this->getDoctrine()->getManager();
        $em->getRepository(StudentLocation::class)->createXMLMarkers();

        return $this->render('map/map.html.twig');
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function adminIndex(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $studentLocations = $em->getRepository(StudentLocation::class)->findAll();

        $locations = new StudentLocation();
        $form = $this->createForm(LocationType::class, $locations);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        }

        return $this->render('admin/admin.html.twig', [
            'form' => $form->createView(),
            'locations' => $studentLocations
        ]);
    }

}
