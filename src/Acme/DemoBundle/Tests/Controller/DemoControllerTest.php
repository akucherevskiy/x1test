<?php

namespace Acme\DemoBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemoControllerTest extends WebTestCase
{
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/list?width=200&height=200&bgColor=3b73fc&textColor=00ff00');
        $client->getResponse();
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        $client->request('GET', '/list?width=50&height=200&bgColor=3b73fc&textColor=00ff00');
        $client->getResponse();
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/list?width=200&height=1000&bgColor=3b73fc&textColor=00ff00');
        $client->getResponse();
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/list?width=200&height=200&bgColor=3b73fc');
        $client->getResponse();
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/list?width=200&height=200');
        $client->getResponse();
        $this->assertEquals(404, $client->getResponse()->getStatusCode());

        $client->request('GET', '/list?width=200');
        $client->getResponse();
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
    }
}
