<?php

namespace Blog\CoreBundle\Services;

use Blog\ModelBundle\Entity\Tag;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class TagManager
 * @package Blog\CoreBundle\Services
 */
class TagManager
{
    private $em;

    /**
     * TagManager constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $slug
     * @return null|object|Tag
     */
    public function findBySlug($slug)
    {
        $tag = $this->getRepository()->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if ($tag === null) {
            throw new NotFoundHttpException('Tag was not found');
        }

        return $tag;
    }

    /**
     * @return array
     */
    public function findUsedTags()
    {
        return $this->getRepository()->findUsedTags();
    }

    /**
     * @return \Blog\ModelBundle\Repository\TagRepository|\Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->em->getRepository(Tag::class);
    }
}