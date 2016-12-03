<?php

namespace Blog\ModelBundle\DataFixtures\ORM;
use Blog\ModelBundle\Entity\Comment;
use Blog\ModelBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class Comments
 * @package Blog\ModelBundle\DataFixtures\ORM
 */
class Comments extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $posts = $manager->getRepository(Post::class)->findAll();
        $comments = array(
            'Suspendisse quis lacus arcu. Proin sodales leo ac purus viverra sagittis. Nullam luctus dictum leo, vitae laoreet ligula volutpat quis. Ut lacus orci, dapibus nec malesuada sit amet, convallis sit amet libero.',
            'Quisque sit amet justo fringilla, suscipit ligula eleifend, interdum tellus. Pellentesque pulvinar accumsan nulla. Aliquam erat volutpat.',
            'Etiam vehicula tellus sit amet ante rutrum, eu pellentesque massa elementum. Mauris lorem metus, consectetur eu justo in, convallis dictum magna.'
        );
        $i = 0;
        foreach ($posts as $post) {
            $comment = new Comment();
            $comment->setAuthorName('Example author');
            $comment->setBody($comments[$i++]);
            $comment->setPost($post);
            $manager->persist($comment);
        }
        $manager->flush();
    }
    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 20;
    }
}
