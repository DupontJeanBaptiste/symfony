<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Repository\CategoryRepository;
use App\Repository\SeasonRepository;
use App\Repository\EpisodeRepository;
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
    public function show(int $id = 1, ProgramRepository $programRepository, CategoryRepository $categoryRepository, SeasonRepository $seasonRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table.'
            );
        }

        $seasons = $seasonRepository->findBy(['program' => $id]);

        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render('program/show.html.twig', [
            'program' => $program,
            'id' => $id,
            'programs' => $programs,
            'categories' => $categories,
            'seasons' => $seasons,
        ]);
    }

    #[Route('/show/{programId<\d+>}/{seasonId<\d+>}/', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId = 1, int $seasonId = 1, ProgramRepository $programRepository, CategoryRepository $categoryRepository, SeasonRepository $seasonRepository, EpisodeRepository $episodeRepository): Response
    {
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No season with id :'. $seasonId .' found in season\'s table.'
            );
        }


        $episodes = $episodeRepository->findBy(['season' => $seasonId]);

        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render('program/season_show.html.twig', [
            'programs' => $programs,
            'categories' => $categories,
            'season' => $season,
            'episodes' => $episodes,
        ]);
    }
}