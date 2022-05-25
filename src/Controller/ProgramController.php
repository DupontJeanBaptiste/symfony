<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {

        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render(
            'program/index.html.twig', 
            ['programs' => $programs,
            'categories' => $categories
         ]);
    }

    #[Route('/show/{id<\d+>}/', methods: ['GET'], name: 'show')]
    public function show(int $id = 1, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }

        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'id' => $id,
            'programs' => $programs,
            'categories' => $categories,
        ]);
    }
}