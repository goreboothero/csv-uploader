<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class CsvUploader
 */
class CsvUploader
{
    /**
     * Assert\File(
     *     mimeTypes = {"text/csv"},
     *     mimeTypesMessage = "CSVファイルをアップロードしてください。{{ type }} は非対応です。"
     * )
     */
    // TODO: CSVをアップロードした際、text/plainになる問題があるため、text/csvでバリデートさせる https://polidog.jp/2018/07/19/symfony_validator/
    protected $csvFile;

    public function setCsvFile(?UploadedFile $file = null): void
    {
        $this->csvFile = $file;
    }

    public function getCsvFile(): ?UploadedFile
    {
        return $this->csvFile;
    }
}
