<?php

namespace Blog\AdminBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TagControllerTest extends WebTestCase
{
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient(array(), array(
            'PHP_AUTH_USER' => 'sadmin',
            'PHP_AUTH_PW' => 'admin'
        ));

        // Create a new entry in the database
        $crawler = $client->request('GET', '/admin/tag/');
        $this->assertTrue($client->getResponse()->isSuccessful(), 'Bad response');
        $crawler = $client->click($crawler->selectLink('Create a new tag')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'blog_modelbundle_tag[name]'  => 'Test'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertEquals(
            1,
            $crawler->filter('td:contains("Test")')->count(),
            'Missing element td:contains("Test")'
        );

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Edit')->form(array(
            'blog_modelbundle_tag[name]'  => 'edited'
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertEquals(
            1,
            $crawler->filter('[value="edited"]')->count(),
            'Missing element [value="edited"]'
        );

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/edited/', $client->getResponse()->getContent());
    }
}
