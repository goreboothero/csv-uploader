<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Goreboothero\CsvUploader\Entity\File\Csv;
use Goreboothero\CsvUploader\Form\Type\CsvUploaderType;
use Goreboothero\CsvUploader\UseCase\CsvUploadUseCase;
use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Extension\Validator\ValidatorExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class CsvUploaderController
 */
class CsvUploaderController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request):Response
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
            /** @var Csv $csv */
            $csv = $form->getData();

            $csvUploadUseCase = new CsvUploadUseCase();
            $csvUploadUseCase->run($csv);

            return new Response();
        }

        return new Response('', Response::HTTP_BAD_REQUEST);
    }
}
