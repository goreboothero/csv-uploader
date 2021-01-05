<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Converter;

use Doctrine\Common\Collections\ArrayCollection;
use Goreboothero\CsvUploader\DTO\Csv;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function dirname;

class CsvFileToCsvCollectionConverterTest extends TestCase
{
    public function test(): void
    {
        $SUT = $this->getSUT();

        $csvFilePath = dirname(__FILE__) . '/../TestFile/test_data_1.csv';
        $csvFile = new UploadedFile($csvFilePath, 'test_data_1.csv');

        $actual = $SUT->convert($csvFile);

        $this->assertInstanceOf(ArrayCollection::class, $actual);
        $this->assertInstanceOf(Csv::class, $actual[0]);

        $this->assertInstanceOf(Csv::class, $actual[0]);
        $this->assertInstanceOf(Csv::class, $actual[1]);
        $this->assertInstanceOf(Csv::class, $actual[2]);
        $this->assertInstanceOf(Csv::class, $actual[3]);

        /**
         * @var Csv $csv
         */
        $csv = $actual[0];

        $this->assertEquals(1, $csv->getId(), 'CSV内で見出しを除いた1行目の内容が正しくオブジェクト化できていません');
        $this->assertEquals('山田', $csv->getFamilyName(), 'CSV内で見出しを除いた1行目の内容が正しくオブジェクト化できていません');
        $this->assertEquals('一郎', $csv->getLastName(), 'CSV内で見出しを除いた1行目の内容が正しくオブジェクト化できていません');
    }

    private function getSUT()
    {
        return new CsvFileToCsvCollectionConverter();
    }
}
