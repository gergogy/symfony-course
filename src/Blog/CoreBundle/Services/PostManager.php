<?php

namespace Blog\CoreBundle\Services;
use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Blog\ModelBundle\Form\CommentType;
use Blog\ModelBundle\Repository\PostRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostManager
 * @package Blog\CoreBundle\Services
 */
class PostManager
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * PostManager constructor.
     * @param EntityManager $em
     * @param FormFactoryInterface $formFactory
     */
    public function __construct(EntityManager $em, FormFactoryInterface $formFactory)
    {
        $this->em = $em;
        $this->formFactory = $formFactory;
    }

    /**
     * @return array|\Blog\ModelBundle\Entity\Post[]
     */
    public function findAll()
    {
        $posts = $this->getRepository()->findAll();

        return $posts;
    }

    /**
     * @param $num
     * @return array
     */
    public function findLatest($num)
    {
        $latest = $this->getRepository()->findLatest($num);

        return $latest;
    }

    /**
     * @param $slug
     * @return Post|null|object
     */
    public function findBySlug($slug)
    {
        $post = $this->getRepository()->findOneBy(
            array(
                'slug' => $slug
            )
        );

        if ($post === null) {
            throw new NotFoundHttpException('Post was not found');
        }

        return $post;
    }

    /**
     * @param Post $post
     * @param Request $request
     * @return bool|FormInterface
     */
    public function createComment(Post $post, Request $request)
    {
        $comment = new Comment();
        $comment->setPost($post);

        $form = $this->formFactory->create(new CommentType(), $comment);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->em->persist($comment);
            $this->em->flush();

            return true;
        }

        return $form;
    }

    /**
     * @return PostRepository|\Doctrine\ORM\EntityRepository
     */
    private function getRepository()
    {
        return $this->em->getRepository(Post::class);
    }
}