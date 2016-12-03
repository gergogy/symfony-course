<?php

namespace Blog\ModelBundle\Repository;

use Blog\ModelBundle\Entity\Tag;
use Doctrine\ORM\EntityRepository;

/**
 * Class TagsRepository
 * @package Blog\ModelBundle\Repository
 */
class TagRepository extends EntityRepository
{
    /**
     * @return array
     */
    public function findUsedTags()
    {
        $qb = $this->getQueryBuilder()
            ->select('t')
            ->innerJoin('t.posts', 'p')
            ->groupBy('t.id');

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Tag
     */
    public function findFirst()
    {
        $qb = $this->getQueryBuilder()
            ->addOrderBy('t.id', 'ASC')
            ->setMaxResults(1);

        return $qb->getQuery()->getSingleResult();
    }

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $qb = $em->getRepository(Tag::class)
            ->createQueryBuilder('t');

        return $qb;
    }
}