<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Incident;
use Symfony\Component\HttpFoundation\Request;
use Psr\Log\LoggerInterface;


/**
 * @Route("/incident", name="incident")
 */
class IncidentController extends AbstractController
{

    /**
     * @Route("/", name="incident_index", methods={"GET"})
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Incident::class);


        $incidents = $repository->findAll();

        return $this->json([
            'code'=> 200,
            'incidents' => $incidents,
        ]);
    }

    /**
     * @Route("/", name="incident_index_post", methods={"POST"})
     */
    public function new(Request $request, LoggerInterface $logger)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(Incident::class);

    
        $newDate = $request->get("new_date", null);

        $incident = $repository->find(1);

        $logger->info("[1] Realizó qry");

        if(is_null($incident)) {
            return $this->json([
                'code' => 404,
                'msg' => 'not found'
            ]);    
        }
        $lastIncident = $incident->getLastIncident();
        $lastRecordInDays = $incident->getLastRecordInDays();
        
        $logger->info("[1] Existe CO");

        $now = time();

        $logger->info("[1] now: ".$now);
        $logger->info("[2] newDate: ".$newDate);

        if(is_null($newDate)) {
            $newDate = $now;
        }

        $logger->info("[3] newDate: ".$newDate);
        /**
         * Nuevo record
         */
        $diff = $newDate - $lastIncident;

        $logger->info("[4] Diff: ".$diff);
        $logger->info("[5] lastRecordInDays: ".$lastRecordInDays);
        $logger->info("[6] if: ". ($diff > $lastRecordInDays));
        if($diff > $lastRecordInDays) {
            $incident->setLastRecordInDays($diff);
        }

        $incident->setLastIncident($newDate);

        $em->persist($incident);
        $em->flush();

        $incidents = $repository->findAll();

        return $this->json([
            'code' => 200,
            'msg' => 'success',
            'data' => [
                'incidents' => $incidents
            ]
        ]);
    }

}
