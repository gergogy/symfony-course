<?php
/**
 * Created by PhpStorm.
 * User: blush
 * Date: 2016. 11. 02.
 * Time: 20:26
 */

namespace Blog\ModelBundle\DataFixtures\ORM;


use Blog\ModelBundle\Entity\Author;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class Posts extends AbstractFixture implements OrderedFixtureInterface
{
    const
        EXAMPLE_TEXT_1 = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin ante mi, convallis quis lobortis vel, egestas a purus. Mauris eleifend in metus sit amet bibendum. Curabitur efficitur vestibulum sodales. Vivamus vitae elementum neque, sed sollicitudin lorem. Proin convallis quam leo, a faucibus risus porta vel. Vivamus bibendum feugiat diam, vulputate porttitor tellus fermentum nec. Curabitur varius venenatis sem, id luctus augue euismod at. Mauris et tempor ipsum. Praesent ut mi lacinia, fermentum eros sit amet, pellentesque ante.',
        EXAMPLE_TEXT_2 = 'Aliquam tincidunt, massa quis condimentum ornare, urna odio sodales risus, sit amet malesuada est diam in nulla. Donec dui elit, rhoncus at semper in, lacinia vel velit. Cras vel ipsum augue. Cras malesuada nunc et hendrerit placerat. Phasellus euismod pellentesque ipsum, quis blandit augue. Pellentesque tellus nibh, interdum a fringilla hendrerit, posuere a eros. Sed at dignissim mauris. Donec eget blandit quam, sit amet sagittis turpis. Ut vestibulum, justo vitae malesuada cursus, nisl ligula mattis purus, at ullamcorper arcu nisi eget ligula. Maecenas pulvinar nisi in lectus faucibus fringilla. Aenean mollis a nisl sed venenatis. Nullam quis varius sem.',
        EXAMPLE_TEXT_3 = 'Nam metus nulla, pharetra nec orci ut, tristique lacinia justo. Proin quis lectus eget felis facilisis consectetur a id eros. Etiam eget tempus tortor. Integer vehicula dui vel felis posuere, a consequat dolor laoreet. Donec placerat non sapien eu fermentum. Vestibulum vestibulum laoreet risus in commodo. Suspendisse fermentum magna purus, sollicitudin efficitur nisi sodales vel. Sed pellentesque orci lorem, vitae mollis enim pharetra a. Aenean ornare scelerisque odio ut pharetra. Duis mi arcu, tincidunt a nibh eu, consequat maximus eros. Pellentesque lectus risus, condimentum in pharetra id, aliquet quis risus. Pellentesque rhoncus pharetra orci, eget pharetra ipsum laoreet quis. Donec ornare eleifend massa quis placerat. Praesent egestas arcu risus, vel pulvinar dolor placerat sed.'
    ;
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $p1 = new Post();
        $p1->setTitle('Lorem ipsum dolor sit amet 1')
            ->setBody(self::EXAMPLE_TEXT_1)
            ->setAuthor($this->getAuthor($manager, 'Ádám'));

        $p2 = new Post();
        $p2->setTitle('Lorem ipsum dolor sit amet 2')
            ->setBody(self::EXAMPLE_TEXT_2)
            ->setAuthor($this->getAuthor($manager, 'Éva'));

        $p3 = new Post();
        $p3->setTitle('Lorem ipsum dolor sit amet 3')
            ->setBody(self::EXAMPLE_TEXT_3)
            ->setAuthor($this->getAuthor($manager, 'Éva'));

        $manager->persist($p1);
        $manager->persist($p2);
        $manager->persist($p3);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @param string $name
     * @return Author
     */
    private function getAuthor(ObjectManager $manager, $name)
    {
        return $manager->getRepository(Author::class)->findOneBy(
            array(
                'name' => $name
            )
        );
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 15;
    }
}