<?php

namespace App\Repository;

use App\Entity\Lesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Lesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method Lesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method Lesson[]    findAll()
 * @method Lesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Lesson::class);
    }

    /**
     * allPostByTermId
     *
     * @param $termId
     * @return array
     */
    public function allLessonByTermId($termId, $customType = 'App\Entity\Lesson', $limit = -1)
    {
        $dql = sprintf(
            '
                 SELECT l
                 FROM %s l
                 JOIN p.taxonomies t
                 WHERE t.id = :termId
                 ',
            $customType
        );

        $query = $this->getEntityManager()
            ->createQuery($dql);

        $query->setParameter('termId', $termId);

        if ($limit != -1 && $limit > 0)
            $query->setMaxResults($limit);

        return $query->getResult();
    }

    public function allLessons( $orderRate = 'DESC', $status = ['publish', 'private'])
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery("
            SELECT a, t, l
            FROM App\Entity\Lesson l 
            JOIN l.authors a
            JOIN  l.taxonomies t
            WHERE l.status IN ('publish', 'private')
            ORDER BY l.rate $orderRate
        ");

        return $query->getResult();
    }
}
