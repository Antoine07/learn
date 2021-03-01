<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/api/pass", name="register")
     */
    public function index(Request $request, SerializerInterface $serializer): Response
    {
        dump($request);

        return new Response(
            $serializer->serialize(
                ['a' => '1'], 
                'json' 
            )
        );
    }
}
