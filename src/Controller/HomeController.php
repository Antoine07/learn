<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Serializer\SerializerInterface;

use App\Entity\Lesson;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/{reactRouting}", name="index", defaults={"reactRouting" : null })
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'title' => 'Home page',
        ]);
    }

    /**
     * @Route("/api/best-lessons", name="best-lessons")
     */
    public function best(SerializerInterface $serializer): Response
    {
        $repoLesson = $this->getDoctrine()->getRepository(Lesson::class);

        return new Response(
            $serializer->serialize(
                $repoLesson->allLessons(), 
                'json', ['groups' => 'show_lesson'] 
            )
        );
    }

    /**
     * @Route("/api/lesson/{id}", name="lesson")
     */
    public function getLesson(SerializerInterface $serializer, Lesson $lesson): Response
    {
        
        return new Response(
            $serializer->serialize(
                [], 
                'json', ['groups' => 'show_lesson'] 
            )
        );
    }
}
