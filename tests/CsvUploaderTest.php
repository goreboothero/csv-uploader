<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CsvUploaderTest extends WebTestCase
{
    /** @var CsvUploader */
    protected $csvUploader;

    protected function setUp(): void
    {

    }

    public function testIsInstanceOfCsvUploader(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
