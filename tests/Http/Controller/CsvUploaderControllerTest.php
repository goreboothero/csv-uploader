<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function dirname;

class CsvUploaderControllerTest extends WebTestCase
{
    public function test_CSVファイルがアップロードできること(): void
    {
        $csvFilePath = dirname(__FILE__) . '/../../TestFile/export_user_list_csv_test_data_1.csv';
        $csvFile = new UploadedFile($csvFilePath, 'export_user_list_csv_test_data_1.csv');

        $client = static::createClient();
        $client->request('POST', '/', [], ['csv_file' => $csvFile]);
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function test_TEXTファイルはアップロードできない(): void
    {
        $txtFilePath = dirname(__FILE__) . '/../../TestFile/dummy.txt';
        $txtFile = new UploadedFile($txtFilePath, 'dummy.txt');

        $client = static::createClient();
        $client->request('POST', '/', [], ['csv_file' => $txtFile]);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }

    public function test_CSVをアップロードしなかったら400が返ること(): void
    {
        $client = static::createClient();
        $client->request('POST', '/', [], []);
        $this->assertEquals(400, $client->getResponse()->getStatusCode());
    }
}
