<?php

namespace Blog\AdminBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class SettingController
 * @package Blog\AdminBundle\Controller
 * @Route("setting")
 */
class SettingController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('@Admin/Setting/index.html.twig');
    }

    /**
     * @param Request $request
     *
     * @Route("/modify")
     * @Method("POST")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function modifyAction(Request $request)
    {
        $config = $this->get('core.settings');
        $em = $this->getDoctrine()->getManager();
        $settings = $request->get('settings', array());

        foreach ($settings as $key => $value) {
            $setting = $config->findByKey($key);

            $setting->setVal($value);

            $em->persist($setting);
        }

        $em->flush();

        return $this->redirect(
            $this->generateUrl('blog_admin_setting_index')
        );
    }
}