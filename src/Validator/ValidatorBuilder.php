<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Validator;

use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ValidatorBuilder
 */
class ValidatorBuilder
{
    /**
     * @return RecursiveValidator|ValidatorInterface
     */
    public function run(): ValidatorInterface
    {
        $validatorBuilder = Validation::createValidatorBuilder();
        $validatorBuilder->enableAnnotationMapping();

        return $validatorBuilder->getValidator();
    }
}
