<?php

namespace Blog\CoreBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class BullshitExtension
 * @package Blog\CoreBundle\Twig
 */
class BullshitExtension extends \Twig_Extension
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * BullshitExtension constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('bullshit', array($this, 'bullshitFilter'))
        );
    }

    public function bullshitFilter($string)
    {
        $start = $this->container->getParameter('core.bullshit_filter.start');
        $end = $this->container->getParameter('core.bullshit_filter.end');

        return $start . $string . $end;
    }

    public function getName()
    {
        return 'bullshit_extension';
    }
}