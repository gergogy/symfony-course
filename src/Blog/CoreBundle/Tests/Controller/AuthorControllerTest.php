<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Author;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class AuthorControllerTest
 * @package Blog\CoreBundle\Tests\Controller
 */
class AuthorControllerTest extends WebTestCase
{
    /**
     * Test show
     */
    public function testShow()
    {
        $client = static::createClient();

        /** @var Author $author */
        $author = $client->getContainer()
            ->get('core.author_manager')
            ->findFirst();

        $authorPostsCount = $author->getPosts()->count();

        $crawler = $client->request('GET', '/en/author/' . $author->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'The response was not successful');

        $this->assertCount(
            $authorPostsCount,
            $crawler->filter('h2'),
            'There should be ' . $authorPostsCount . 'post'
        );
    }

}
