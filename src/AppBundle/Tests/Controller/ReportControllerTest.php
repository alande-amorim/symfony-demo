<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportControllerTest extends WebTestCase
{

    public function testindexAction()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'anna_admin',
            'PHP_AUTH_PW' => 'kitten',
        ]);

        $crawler = $client->request('GET', '/pt_BR/admin/report');

        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("Nenhum relatório encontrado.")')->count()
        );
    }

}
