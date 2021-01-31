<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Form;

use Goreboothero\CsvUploader\Validator\ValidatorBuilder;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;

/**
 * Class FormFactoryBuilder
 */
class FormFactoryBuilder
{
    /** @var ValidatorBuilder */
    private $validatorBuilder;

    /**
     * FormFactoryBuilder constructor.
     * @param ValidatorBuilder $validatorBuilder
     */
    public function __construct(ValidatorBuilder $validatorBuilder)
    {
        $this->validatorBuilder = $validatorBuilder;
    }

    public function run(): FormFactoryInterface
    {
        return Forms::createFormFactoryBuilder()
            ->addExtensions([new HttpFoundationExtension(), new ValidatorExtension($this->validatorBuilder->run())])
            ->getFormFactory();
    }
}
