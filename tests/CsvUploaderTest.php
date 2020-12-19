<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader;

use PHPUnit\Framework\TestCase;

class CsvUploaderTest extends TestCase
{
    /** @var CsvUploader */
    protected $csvUploader;

    protected function setUp(): void
    {
        $this->csvUploader = new CsvUploader();
    }

    public function testIsInstanceOfCsvUploader(): void
    {
        $actual = $this->csvUploader;
        $this->assertInstanceOf(CsvUploader::class, $actual);
    }
}
