<?php

namespace Blog\CoreBundle\Tests\Controller;

use Blog\ModelBundle\Entity\Tag;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/en/tags/list');

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Bad response');

        $this->assertGreaterThan(
            2,
            $crawler->filter('a')->count(),
            'There should be at least 3 tag'
        );
    }

    public function testShow()
    {
        $client = static::createClient();

        /** @var Tag $tag */
        $tag = $client->getContainer()
            ->get('doctrine')
            ->getManager()
            ->getRepository(Tag::class)
            ->findFirst();

        $crawler = $client->request('GET', '/en/tags/show/' . $tag->getSlug());

        $this->assertTrue($client->getResponse()->isSuccessful(), 'Bad response');

        $this->assertGreaterThan(
            1,
            $crawler->filter('h2')->count(),
            'There should be at least 2 post'
        );
    }

}
