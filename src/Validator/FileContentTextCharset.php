<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class FileContentTextCharset extends Constraint
{
    public const DEFAULT_ERROR_MESSAGE = 'アップロードファイルの文字コードは UTF-8 のみに対応しています。 アップロードいただいたファイルは {{ charset-name }} と判定しています。';

    public $message = self::DEFAULT_ERROR_MESSAGE;
}
