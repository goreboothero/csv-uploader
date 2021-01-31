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
    /** @var CsvFileToCsvCollectionConverter */
    private $csvFileToCsvCollectionConverter;

    /**
     * CsvUploadUseCase constructor.
     * @param CsvFileToCsvCollectionConverter $csvFileToCsvCollectionConverter
     */
    public function __construct(CsvFileToCsvCollectionConverter $csvFileToCsvCollectionConverter)
    {
        $this->csvFileToCsvCollectionConverter = $csvFileToCsvCollectionConverter;
    }

    public function run(UploadedFile $csvFile): void
    {
        $exportUserListCsvCollection = $this->csvFileToCsvCollectionConverter->convert($csvFile);
    }
}
