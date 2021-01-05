<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function dirname;

class CsvUploaderControllerTest extends WebTestCase
{
    public function test_CSVをアップロードした際、200が返ってくること(): void
    {
        $csvFilePath = dirname(__FILE__) . '/../../TestFile/test_data_1.csv';
        $csvFile = new UploadedFile($csvFilePath, 'test_data_1.csv');

        $client = static::createClient();
        $client->request('POST', '/', [], ['csv_file' => $csvFile]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test_CSVをアップロードしなかったら、400が返ってくること(): void
    {
        $client = static::createClient();
        $client->request('POST', '/', [], []);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
