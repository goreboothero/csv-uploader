<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\UseCase;

use Goreboothero\CsvUploader\Converter\CsvFileToCsvCollectionConverter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class CsvUploadUseCase
 */
class CsvUploadUseCase
{
    public function run(UploadedFile $csvFile): void
    {
        $csvFileToCsvCollectionConverter = new CsvFileToCsvCollectionConverter();
        $exportUserListCsvCollection = $csvFileToCsvCollectionConverter->convert($csvFile);
    }
}
