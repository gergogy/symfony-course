<?php

namespace Blog\CoreBundle\Services;
use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorManager
 * @package Blog\CoreBundle\Services
 */
class AuthorManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * AuthorManager constructor.
     * @param $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $slug
     * @return Author|null|object
     */
    public function findBySlug($slug)
    {
        $author = $this->getRepository()->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if ($author === null) {
            throw new NotFoundHttpException('Author was not found');
        }
        
        return $author;
    }

    /**
     * @param Author $author
     * @return array|\Blog\ModelBundle\Entity\Post[]
     */
    public function findPosts($author)
    {
        $posts = $this->em->getRepository(Post::class)->findBy(
            array(
                'author' => $author
            )
        );

        return $posts;
    }

    /**
     * @return Author
     */
    public function findFirst()
    {
        return $this->getRepository()->findFirst();
    }

    /**
     * @return \Blog\ModelBundle\Repository\AuthorRepository|\Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->em->getRepository(Author::class);
    }
}