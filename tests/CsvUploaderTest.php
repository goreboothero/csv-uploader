<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function dirname;

class CsvUploaderTest extends WebTestCase
{
    public function test(): void
    {
        $csvFilePath = dirname(__FILE__) . '/TestFile/test_data_1.csv';
        $csvFile = new UploadedFile($csvFilePath, 'test_data_1.csv');

        $client = static::createClient();
        $client->request('POST', '/', [], ['csv_file' => $csvFile]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
