<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Converter;

use Doctrine\Common\Collections\ArrayCollection;
use Goreboothero\CsvUploader\DTO\Csv;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use function explode;

/**
 * Class CsvFileToCsvCollectionConverter
 */
class CsvFileToCsvCollectionConverter implements ConverterInterface
{
    /**
     * @param UploadedFile $csvFile
     * @return ArrayCollection|Csv[]
     */
    public function convert(UploadedFile $csvFile): ArrayCollection
    {
        $csvContent = $csvFile->getContent();

        // TODO 複数の改行コードに対応させる
        $csvContentAry = explode("\r\n", $csvContent);

        // TODO 命名を考え直す
        $csvCollection = new ArrayCollection();
        foreach ($csvContentAry as $key => $value) {
            if ($key === 0) {
                continue;
            }

            $line = explode(',', $value);
            $csvCollection->add(new Csv((int) $line[0], $line[1], $line[2]));
        }

        return $csvCollection;
    }
}
