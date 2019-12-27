<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
* @Route("/hello")
*/
class HelloController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"}, name="app_hello")
     */
    public function index()
    {
        

        return new JsonResponse([
            "code" => 200,
            "error" => false,
        ]);
    }
}