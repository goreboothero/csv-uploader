<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Goreboothero\CsvUploader\Entity\File\Csv;
use Goreboothero\CsvUploader\Form\Type\CsvUploaderType;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

use function dd;

/**
 * Class CsvUploaderController
 */
class CsvUploaderController
{
    public function index(Request $request): void
    {
        $validatorBuilder = Validation::createValidatorBuilder();
        $validatorBuilder->enableAnnotationMapping();
        $validator = $validatorBuilder->getValidator();

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtensions([new HttpFoundationExtension(), new ValidatorExtension($validator)])
            ->getFormFactory();

        $form = $formFactory
            ->createNamedBuilder('', CsvUploaderType::class, new Csv())
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dd('成功');
        }

        dd((string) $form->getErrors(true, true));
    }
}
