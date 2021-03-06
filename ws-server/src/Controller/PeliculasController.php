<?php
namespace App\Controller;

use App\Entity\Estrenos;
use App\Repository\EstrenosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PeliculasController extends ApiController
{
    /**
     * @Route("/movies", methods="GET")
     */
    public function index(EstrenosRepository $movieRepository)
    {
        $movies = $movieRepository->transformAll();

        return $this->respond($movies);
    }


    /**
     * @Route("/movies", methods="POST")
     */
    public function create(Request $request, EstrenosRepository $movieRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (!$request->get('titulo')||!$request->get('year_salida')||!$request->get('url_trailer')) {
            return $this->respondValidationError('Please provide a title!');
        }

        // persist the new movie
        $movie = new Estrenos;
        $movie->setTitulo($request->get('titulo'));
        $movie->setYearSalida($request->get('year_salida'));
        $movie->setUrlTrailer($request->get('url_trailer'));
        $em->persist($movie);
        $em->flush();

        return $this->respond($movieRepository->transform($movie));
    }

    /**
     * @Route("/update", methods="POST")
     */
    public function update(Request $request, EstrenosRepository $movieRepository, EntityManagerInterface $em)
    {
        $request = $this->transformJsonBody($request);

        if (!$request) {
            return $this->respondValidationError('Please provide a valid request!');
        }

        // validate the title
        if (!$request->get('titulo')||!$request->get('year_salida')||!$request->get('url_trailer')) {
            return $this->respondValidationError('Please provide a title!');
        }

        // persist the new movie
        $movie = $movieRepository->find($request->get('id'));;
        if (!$movie) {
            return $this->respondNotFound();
        }
        
        $movie->setTitulo($request->get('titulo'));
        $movie->setYearSalida($request->get('year_salida'));
        $movie->setUrlTrailer($request->get('url_trailer'));
        $em->persist($movie);
        $em->flush();

        return $this->respond($movieRepository->transform($movie));
    }

    /**
     * @Route("/movies/{id}/delete", methods="GET")
     */
    public function deleteEstreno($id, EntityManagerInterface $em, EstrenosRepository $movieRepository)
    {
        $movie = $movieRepository->find($id);

        if (!$movie) {
            return $this->respondNotFound();
        }
        $em->remove($movie);
        $em->flush();
        return $this->respond([
            'deleted' => $movie->getId()
        ]);
    }

 
}
