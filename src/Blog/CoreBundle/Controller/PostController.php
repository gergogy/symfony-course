<?php

namespace Blog\CoreBundle\Controller;

use Blog\ModelBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class PostController
 * @package Blog\CoreBundle\Controller
 * @Route("/{_locale}", requirements={"_locale"="|en|hu"}, defaults={"_locale"="en"})
 */
class PostController extends Controller
{
    /**
     * @return array
     *
     * @Route("/")
     */
    public function indexAction()
    {
        $pm = $this->getPostManager();
        $posts = $pm->findAll();
        $latestPosts = $pm->findLatest(5);

        return $this->render('CoreBundle:Post:index.html.twig', array(
            'posts' => $posts,
            'latestPosts' => $latestPosts
        ));
    }

    /**
     * Show a post
     * @param $slug
     * @return array
     * @throws NotFoundHttpException
     *
     * @Route("/{slug}")
     * @Template()
     */
    public function showAction($slug)
    {
        $pm = $this->getPostManager();
        $post = $pm->findBySlug($slug);
        $config = $this->get('core.settings');
        $commentSetting = $config->get('anonymous_comment');

        $form = $this->createForm(new CommentType());

        return array(
            'post' => $post,
            'form' => $form->createView(),
            'anonymous_comments' => $commentSetting
        );
    }

    /**
     * @param Request $request
     * @param string $slug
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws NotFoundHttpException
     *
     * @Route("/{slug}/create-comment")
     * @Method("POST")
     */
    public function createCommentAction(Request $request, $slug)
    {
        $pm = $this->getPostManager();
        $post = $pm->findBySlug($slug);

        $form = $pm->createComment($post, $request);

        if ($form === true) {
            $this->get('session')->getFlashBag()->add('success', 'Your comment was submitted successfully!');

            return $this->redirect(
                $this->generateUrl('blog_core_post_show', array('slug' => $post->getSlug()))
            );
        }

        return $this->render('@Core/Post/show.html.twig', array(
            'post' => $post,
            'form' => $form->createView()
        ));
    }

    /**
     * @return \Blog\CoreBundle\Services\PostManager|object
     */
    private function getPostManager()
    {
        return $this->get('core.post_manager');
    }
}
