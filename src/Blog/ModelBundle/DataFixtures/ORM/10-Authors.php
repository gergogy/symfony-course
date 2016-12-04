<?php
/**
 * Created by PhpStorm.
 * User: blush
 * Date: 2016. 11. 02.
 * Time: 20:22
 */

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Fixtures for the Author Entity
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Authors extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $a1 = new Author();
        $a1->setName('Ádám');
        $a1->setRoles('ROLE_SUPER_ADMIN');
        $a1->setPassword('admin');
        $a2 = new Author();
        $a2->setName('Éva');
        $a2->setRoles('ROLE_ADMIN');
        $a2->setPassword('admin');
        $a3 = new Author();
        $a3->setName('Tamás');
        $a3->setRoles('ROLE_ADMIN');
        $a3->setPassword('admin');

        $manager->persist($a1);
        $manager->persist($a2);
        $manager->persist($a3);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 10;
    }
}