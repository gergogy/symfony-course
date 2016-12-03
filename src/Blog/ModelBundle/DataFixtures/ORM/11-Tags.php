<?php
/**
 * Created by PhpStorm.
 * User: blush
 * Date: 2016. 12. 02.
 * Time: 21:01
 */

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Tags
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Tags extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $t1 = new Tag();
        $t1->setName('Test tag');
        $t2 = new Tag();
        $t2->setName('Test tag 2');
        $t3 = new Tag();
        $t3->setName('Test tag 3');
        $manager->persist($t1);
        $manager->persist($t2);
        $manager->persist($t3);
        $manager->flush();
    }
    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 11;
    }
}