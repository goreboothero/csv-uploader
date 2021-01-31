<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Throwable;

use function dd;
use function mb_detect_encoding;

/**
 * Class FileContentTextCharsetValidator
 */
class FileContentTextCharsetValidator extends ConstraintValidator
{
    /**
     * @param mixed|UploadedFile $value
     * @param Constraint|FileContentTextCharset $constraint
     */
    public function validate($value, Constraint $constraint): void
    {
        if (! $this->validateUploadedFile($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ charset-name }}', $this->getCharsetNameMessage($value))
                ->addViolation();
        }
    }

    /**
     * @param mixed|UploadedFile $value
     */
    private function validateUploadedFile($value): bool
    {
        try {
            $fileContent = $value->getContent();

            if (mb_detect_encoding($fileContent) === 'UTF-8') {
                return true;
            }
        } catch (Throwable $e) {
            return false;
        }

        return false;
    }

    /**
     * @param mixed|UploadedFile $value
     */
    private function getCharsetNameMessage($value): string
    {
        try {
            return mb_detect_encoding($value->getContent(), ['ASCII', 'ISO-2022-JP', 'UTF-8', 'EUC-JP', 'SJIS']);
        } catch (Throwable $e) {
        }

        return '対応していない文字コード';
    }
}
