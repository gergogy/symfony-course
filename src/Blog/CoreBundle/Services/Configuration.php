<?php

namespace Blog\CoreBundle\Services;

use Doctrine\ORM\EntityManager;
use Blog\ModelBundle\Entity\Configuration as ConfigurationEntity;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Configuration
 * @package Blog\CoreBundle\Services
 */
class Configuration
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Configuration constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $key
     * @return ConfigurationEntity|null|object
     */
    public function findByKey($key)
    {
        $setting = $this->getRepository()->findOneBy(
            array(
                'setting' => $key
            )
        );

        if ($setting === null) {
            throw new NotFoundHttpException('Setting was not found');
        }

        return $setting;
    }

    public function findAll()
    {
        return $this->getData();
    }

    public function get($key)
    {
        $result = $this->findByKey($key);

        return $result->getVal();
    }

    private function getData()
    {
        $settings = $this->getRepository()->findAll();

        $result = array();
        foreach ($settings as $setting) {
            $this->$result[$setting->getSetting()] = $setting->getVal();
        }

        return $result;
    }

    private function getRepository()
    {
        return $this->em->getRepository(ConfigurationEntity::class);
    }
}