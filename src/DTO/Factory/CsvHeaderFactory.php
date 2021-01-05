<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO\Factory;

use Goreboothero\CsvUploader\DTO\CsvHeader;

use function explode;

class CsvHeaderFactory
{
    public function run(string $CsvContentHeader)
    {
        $csvContentHeaderArray = explode(',', $CsvContentHeader);

        return new CsvHeader($csvContentHeaderArray[0], $csvContentHeaderArray[1], $csvContentHeaderArray[2]);
    }
}
