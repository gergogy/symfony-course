<?php

namespace Blog\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Class TagController
 * @package Blog\CoreBundle\Controller
 * @Route("/{_locale}/tags", requirements={"_locale"="|en|hu"}, defaults={"_locale"="en"})
 */
class TagController extends Controller
{
    /**
     * @Route("/list")
     */
    public function indexAction()
    {
        $tagsInUse = $this->getTagManager()
            ->findUsedTags();

        return $this->render('CoreBundle:Tag:index.html.twig', array(
            'tags' => $tagsInUse
        ));
    }

    /**
     * @Route("/show/{slug}")
     */
    public function showAction($slug)
    {
        $tag = $this->getTagManager()
            ->findBySlug($slug);

        return $this->render('CoreBundle:Tag:show.html.twig', array(
            'tag' => $tag,
            'posts' => $tag->getPosts()
        ));
    }

    /**
     * @return \Blog\CoreBundle\Services\TagManager|object
     */
    private function getTagManager()
    {
        return $this->get('core.tag_manager');
    }
}
