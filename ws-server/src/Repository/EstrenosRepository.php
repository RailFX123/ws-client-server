<?php

namespace App\Repository;

use App\Entity\Estrenos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Estrenos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estrenos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estrenos[]    findAll()
 * @method Estrenos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstrenosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estrenos::class);
    }

    public function transform(Estrenos $movie)
    {
        return [
            'id' => (int) $movie->getId(),
            'titulo' => (string) $movie->getTitulo(),
            'year_salida' => (string) $movie->getYearSalida(),
            'url_trailer' => (string) $movie->getUrlTrailer(),
        ];
    }

    public function transformAll()
    {
        $movies = $this->findAll();
        $moviesArray = [];

        foreach ($movies as $movie) {
            $moviesArray[] = $this->transform($movie);
        }

        return $moviesArray;
    }

    // /**
    //  * @return Estrenos[] Returns an array of Estrenos objects
    //  */
    /*
    public function findByExampleField($value)
    {
    return $this->createQueryBuilder('e')
    ->andWhere('e.exampleField = :val')
    ->setParameter('val', $value)
    ->orderBy('e.id', 'ASC')
    ->setMaxResults(10)
    ->getQuery()
    ->getResult()
    ;
    }
     */

    /*
public function findOneBySomeField($value): ?Estrenos
{
return $this->createQueryBuilder('e')
->andWhere('e.exampleField = :val')
->setParameter('val', $value)
->getQuery()
->getOneOrNullResult()
;
}
 */
}
