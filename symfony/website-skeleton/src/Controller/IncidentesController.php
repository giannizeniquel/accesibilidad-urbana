<?php

namespace App\Controller;

use App\Entity\Calle;
use App\Entity\Incidente;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IncidentesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="app_index")
     */
    public function index(Request $request)
    {
        if($request->query->has('incidencias')){
            $incidencias = $this->entityManager->getRepository(Incidente::class)->findAllSector($request->query->get('incidencias'));
        }else{
            $incidencias = $this->entityManager->getRepository(Incidente::class)->findAll();
        }
        
        return $this->render('index.html.twig', [
            'incidencias' => $incidencias,
        ]);
    }

    /**
     * @Route("/recibirReclamo", name="recibirReclamo")
     * methods={"POST"} 
     */
    public function recibirReclamo(Request $request){
        
        
        if ( $request->request->has('incidente')){
            $form = $request->request->get('incidente');
            $calle = $this->entityManager->getRepository(Calle::class)->find($form['calle']);
            $incidente = $this->entityManager->getRepository(Incidente::class)->getExiste($calle->getId(),$form['altura']);
            if($incidente){
                $incidente->setIncidencia($incidente->getIncidencia()+1);
            }else{
                $incidente = new Incidente;
                $incidente->setCalles($calle);
                $incidente->setMotivo($form['motivo']);
                $incidente->setTemporalidad($form['tiempo']);
                $incidente->setAltura($form['altura']);
                $incidente->setIncidencia(1);
            }
            $this->entityManager->persist($incidente);
            $this->entityManager->flush();
            return $this->redirectToRoute('app_index');
        }
    }

    /**
     * @Route("/calles", name="calles")
     * methods={"POST"} 
     */
    public function ajaxCalle(){
        $calle = $this->entityManager->getRepository(Calle::class)->findAllSelector();
        return $this->json($calle);
    }

    /**
     * @Route("/sector/{sector}", name="sector")
     */
    public function sector(Request $request,$sector)
    {
        $incidencias = $sector;
        return $this->redirectToRoute('app_index', array(
            'incidencias' => $incidencias,
        ));
    }

    /**
     * @Route("/buscarCalle/{calle}", name="buscarCalle")
     */
    public function buscarCalle(Request $request,$calle)
    {
        $incidencias = $this->entityManager->getRepository(Incidente::class)->findCalleNombre($calle);
        return $this->redirectToRoute('app_index', array(
            'incidencias' => $incidencias,
        ));
    }

    
};
    