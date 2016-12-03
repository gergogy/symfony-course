<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class AuthorController
 * @package Blog\CoreBundle\Controller
 * @Route("/{_locale}/author", requirements={"_locale"="|en|hu"}, defaults={"_locale"="en"})
 */
class AuthorController extends Controller
{
    /**
     * @param string $slug
     * @return Response
     * @throws NotFoundHttpException
     *
     * @Route("/{slug}")
     */
    public function showAction($slug)
    {
        $am = $this->getAuthorManager();

        $author = $am->findBySlug($slug);

        $posts = $am->findPosts($author);

        return $this->render('CoreBundle:Author:show.html.twig', array(
            'author' => $author,
            'posts' => $posts
        ));
    }

    /**
     * @return \Blog\CoreBundle\Services\AuthorManager|object
     */
    private function getAuthorManager()
    {
        return $this->get('core.author_manager');
    }
}
