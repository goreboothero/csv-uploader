<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Entity\File;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Csv
 */
class Csv
{
    /**
     * @Assert\File(
     *     mimeTypes={"text/csv"},
     *     mimeTypesMessage="CSVファイルをアップロードしてください"
     * )
     */
    protected $csvFile;

    public function setCsvFile(File $file = null): void
    {
        $this->csvFile = $file;
    }

    public function getCsvFile(): ?File
    {
        return $this->csvFile;
    }
}
