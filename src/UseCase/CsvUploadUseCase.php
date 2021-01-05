<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\UseCase;

use Goreboothero\CsvUploader\Converter\CsvFileToCsvCollectionConverter;
use Goreboothero\CsvUploader\Entity\File\Csv;

/**
 * Class CsvUploadUseCase
 * @package Goreboothero\CsvUploader\UseCase
 */
class CsvUploadUseCase
{
    /**
     * @param Csv $csv
     */
    public function run(Csv $csv)
    {
        $csvFileToCsvCollectionConverter = new CsvFileToCsvCollectionConverter();

        $csvFile = $csv->getCsvFile();
        $csvFileToCsvCollectionConverter->convert($csvFile);
    }
}