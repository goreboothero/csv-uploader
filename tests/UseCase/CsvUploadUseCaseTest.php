<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\UseCase;

use Goreboothero\CsvUploader\Converter\CsvFileToCsvCollectionConverter;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CsvUploadUseCaseTest extends TestCase
{
    public function test(): void
    {
        $uploadedFileP = $this->prophesize(UploadedFile::class);
        $uploadedFileP->willBeConstructedWith([dirname(__FILE__) . '/../TestFile/dummy.txt', '', '', null, false]);
        $uploadedFile = $uploadedFileP->reveal();

        $csvFileToCsvCollectionConverterP = $this->prophesize(CsvFileToCsvCollectionConverter::class);
        $csvFileToCsvCollectionConverterP->convert($uploadedFile)->shouldBeCalledTimes(1);
        $csvFileToCsvCollectionConverter = $csvFileToCsvCollectionConverterP->reveal();

        $SUT = $this->getSUT($csvFileToCsvCollectionConverter);
        $SUT->run($uploadedFile);
    }

    private function getSUT(CsvFileToCsvCollectionConverter $csvFileToCsvCollectionConverter)
    {
        return new CsvUploadUseCase($csvFileToCsvCollectionConverter);
    }
}
