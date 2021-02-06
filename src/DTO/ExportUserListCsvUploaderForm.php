<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO;

use Goreboothero\CsvUploader\Validator as CustomAssert;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ExportUserListCsvUploaderForm
 */
class ExportUserListCsvUploaderForm
{
    /**
     * // TODO: CSVをアップロードした際、text/plainになる問題があるため、text/csvでバリデートさせる https://polidog.jp/2018/07/19/symfony_validator/
     * Assert\File(
     *     mimeTypes = {"text/csv"},
     *     mimeTypesMessage = "CSVファイルをアップロードしてください。{{ type }} は非対応です。"
     * )
     * CustomAssert\FileContentTextCharset()
     */
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
