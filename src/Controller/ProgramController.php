<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\ProgramRepository;
use App\Entity\Program;
use App\Repository\CategoryRepository;
use App\Entity\Category;
use App\Repository\SeasonRepository;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use Symfony\Component\HttpClient\Response\AmpResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ProgramType;


#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository, 
    CategoryRepository $categoryRepository): Response
    {

        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render(
            'program/index.html.twig', 
            ['programs' => $programs,
            'categories' => $categories
         ]);
    }

    #[Route('/new', name: 'new')]
        public function new(CategoryRepository $categoryRepository, ProgramRepository $programRepository, Request $request): Response
        {
            $categories = $categoryRepository->findAll();

            $programs = $programRepository->findAll();

            $program = new Program();

            $form = $this->createForm(ProgramType::class, $program);
            $form->handleRequest($request);

            if ($form->isSubmitted()) {
                $programRepository->add($program, true);

                return $this->redirectToRoute('program_index');
            }

            return $this->renderForm('program/new.html.twig', 
            [
                'form' => $form,
                'categories' => $categories,
                'programs' => $programs,
            ]);
        }

    #[Route('/show/{id<\d+>}/', methods: ['GET'], name: 'show')]
    public function show(Program $program, 
    ProgramRepository $programRepository, 
    CategoryRepository $categoryRepository, 
    SeasonRepository $seasonRepository, 
    int $id = 1): Response
    {
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

    #[Route('/show/program/{programId<\d+>}/season/{seasonId<\d+>}/', methods: ['GET'], name: 'show_season')]
    #[Entity('program', options: ['id' => 'programId'])]
    #[Entity('season', options: ['id' => 'seasonId'])]
    public function showSeason(
    Program $program,
    Season $season,
    ProgramRepository $programRepository, 
    CategoryRepository $categoryRepository, 
    SeasonRepository $seasonRepository, 
    EpisodeRepository $episodeRepository,
    int $seasonId = 1): Response
    {
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

    #[Route('/show/program/{programId<\d+>}/season/{seasonId<\d+>}/episode/{episodeId<\d+>}', methods: ['GET'], name: 'show_episode')]
    #[Entity('program', options: ['id' => 'programId'])]
    #[Entity('season', options: ['id' => 'seasonId'])]
    #[Entity('episode', options: ['id' => 'episodeId'])]
    public function showEpisode(
    Program $program,
    Season $season,
    Episode $episode,
    ProgramRepository $programRepository, 
    CategoryRepository $categoryRepository, 
    SeasonRepository $seasonRepository, 
    EpisodeRepository $episodeRepository,
    int $episodeId = 1): Response
    {
        if (!$episode) {
            throw $this->createNotFoundException(
                'No season with id :'. $episodeId .' found in season\'s table.'
            );
        }
        $programs = $programRepository->findAll();

        $categories = $categoryRepository->findAll();

        return $this->render('program/episode_show.html.twig', [
            'programs' => $programs,
            'categories' => $categories,
            'season' => $season,
            'episode' => $episode,
        ]);
    }

}