<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Converter;

use Doctrine\Common\Collections\ArrayCollection;
use Goreboothero\CsvUploader\DTO\ExportUserListCsv;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function explode;

/**
 * Class CsvFileToCsvCollectionConverter
 */
class CsvFileToCsvCollectionConverter implements ConverterInterface
{
    /**
     * @param UploadedFile $uploadedFile
     * @return ArrayCollection<int, ExportUserListCsv>
     */
    public function convert(UploadedFile $uploadedFile): ArrayCollection
    {
        $csvContent = $uploadedFile->getContent();

        // TODO 複数の改行コードに対応させる
        $csvContentAry = explode("\r\n", $csvContent);

        // TODO 命名を考え直す
        $exportUserListCsvCollection = new ArrayCollection();
        foreach ($csvContentAry as $key => $value) {
            if ($key === 0) {
                continue;
            }

            $line = explode(',', $value);
            $exportUserListCsvCollection->add(new ExportUserListCsv((int) $line[0], $line[1], $line[2]));
        }

        return $exportUserListCsvCollection;
    }
}
