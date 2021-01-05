<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\UseCase;

use Goreboothero\CsvUploader\Converter\CsvFileToCsvCollectionConverter;
use Goreboothero\CsvUploader\DTO\CsvUploader;

/**
 * Class CsvUploadUseCase
 */
class CsvUploadUseCase
{
    public function run(CsvUploader $csv): void
    {
        $csvFileToCsvCollectionConverter = new CsvFileToCsvCollectionConverter();

        $csvFile = $csv->getCsvFile();
        $csvFileToCsvCollectionConverter->convert($csvFile);
    }
}
