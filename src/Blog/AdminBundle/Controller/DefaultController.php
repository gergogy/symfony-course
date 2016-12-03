<?php

namespace Blog\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class DefaultController
 * @package Blog\AdminBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @return RedirectResponse
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->redirect(
            $this->generateUrl('blog_admin_post_index')
        );
    }
}
