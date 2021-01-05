<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO\Factory;

use Goreboothero\CsvUploader\DTO\ExportUserListCsvHeader;

use function explode;

class ExportUserListCsvHeaderFactory
{
    public function run(string $CsvContentHeader)
    {
        $csvContentHeaderArray = explode(',', $CsvContentHeader);

        return new ExportUserListCsvHeader($csvContentHeaderArray[0], $csvContentHeaderArray[1], $csvContentHeaderArray[2]);
    }
}
