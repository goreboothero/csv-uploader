<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\UseCase;

use Goreboothero\CsvUploader\Converter\CsvFileToCsvCollectionConverter;
use Goreboothero\CsvUploader\Entity\File\Csv;

/**
 * Class CsvUploadUseCase
 */
class CsvUploadUseCase
{
    public function run(Csv $csv): void
    {
        $csvFileToCsvCollectionConverter = new CsvFileToCsvCollectionConverter();

        $csvFile = $csv->getCsvFile();
        $csvFileToCsvCollectionConverter->convert($csvFile);
    }
}
