<?php
// src/Controller/CategoryController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/category', name: 'category_')]
class CategoryController extends AbstractController
{

    #[Route ('/', name: 'index')]
    public function index(CategoryRepository $categoryRepository, ProgramRepository $programRepository): Response
    {
        $categories = $categoryRepository->findAll();

        $programs = $programRepository->findAll();

        return $this->render(
            'category/index.html.twig', 
            ['categories' => $categories,
            'programs' => $programs
         ]);
    }

    #[Route ('/show/{id<\d+>}', methods: ['GET'], name: 'show')]
    public function show(int $id = 1, ProgramRepository $programRepository, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy(['id' => $id]);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category with id : '.$id.' found in category\'s table.'
            );
        }else {
            $categoryProgram = $programRepository->findBy(['category' => $category], ['id' => 'DESC'], 3, 0);
        }
            $programs = $programRepository->findAll();
            
            $categories = $categoryRepository->findAll();
            
            return $this->render('category/show.html.twig', [
                'category' => $category,
                'categories' => $categories,
                'programs' => $programs,
                'categoryProgram' => $categoryProgram,
            ]);
        }
}