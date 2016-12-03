<?php

namespace Blog\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'admin',
            'PHP_AUTH_PW' => 'admin',
        ));

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/post/');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Bad response');
        $crawler = $client->click($crawler->selectLink('Create a new post')->link());

        $authorValue = $crawler->filter('#blog_modelbundle_post_author option:contains("Ádám")')->attr('value');

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(
            array(
                'blog_modelbundle_post[title]' => 'New post',
                'blog_modelbundle_post[body]' => 'This is a new post',
                'blog_modelbundle_post[author]' => $authorValue
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(
            0,
            $crawler->filter('td:contains("Ádám")')->count(),
            'New post is not showing up'
        );

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(
            array(
                'blog_modelbundle_post[title]' => 'Updated post',
            )
        );

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(
            0,
            $crawler->filter('[value="Updated post"]')->count(),
            'The edited post is not showing up'
        );

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Updated post/', $client->getResponse()->getContent());
    }
}
