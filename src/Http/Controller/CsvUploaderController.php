<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Goreboothero\CsvUploader\DTO\CsvUploader;
use Goreboothero\CsvUploader\Form\FormFactoryBuilder;
use Goreboothero\CsvUploader\Form\Type\CsvUploaderType;
use Goreboothero\CsvUploader\UseCase\CsvUploadUseCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use function assert;

/**
 * Class CsvUploaderController
 */
class CsvUploaderController
{
    /**
     * @var FormFactoryBuilder
     */
    private $formFactoryBuilder;

    /**
     * CsvUploaderController constructor.
     * @param FormFactoryBuilder $formFactoryBuilder
     */
    public function __construct(FormFactoryBuilder $formFactoryBuilder)
    {
        $this->formFactoryBuilder = $formFactoryBuilder;
    }

    public function index(Request $request): Response
    {
        $formFactory = $this->formFactoryBuilder->run();

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

        return new Response('', Response::HTTP_BAD_REQUEST);
    }
}
