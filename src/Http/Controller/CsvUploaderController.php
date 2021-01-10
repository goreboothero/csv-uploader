<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Goreboothero\CsvUploader\DTO\CsvUploader;
use Goreboothero\CsvUploader\Form\Type\CsvUploaderType;
use Goreboothero\CsvUploader\UseCase\CsvUploadUseCase;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Validation;

use function assert;
use function dd;

/**
 * Class CsvUploaderController
 */
class CsvUploaderController
{
    public function index(Request $request): Response
    {
        $validatorBuilder = Validation::createValidatorBuilder();
        $validatorBuilder->enableAnnotationMapping();
        $validator = $validatorBuilder->getValidator();

        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtensions([new HttpFoundationExtension(), new ValidatorExtension($validator)])
            ->getFormFactory();

        $form = $formFactory
            ->createNamedBuilder('', CsvUploaderType::class, new CsvUploader())
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $csvUploader = $form->getData();
            assert($csvUploader instanceof CsvUploader);

            $csvUploadUseCase = new CsvUploadUseCase();
            $csvUploadUseCase->run($csvUploader->getCsvFile());

            return new Response('', Response::HTTP_OK);
        }

        dd((string) $form->getErrors(true, false));

        return new Response('', Response::HTTP_BAD_REQUEST);
    }
}
