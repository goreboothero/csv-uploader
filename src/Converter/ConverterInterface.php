<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Converter;

use Symfony\Component\HttpFoundation\File\UploadedFile;

interface ConverterInterface
{
    public function convert(UploadedFile $uploadedFile);
}
