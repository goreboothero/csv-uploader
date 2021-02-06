<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Goreboothero\CsvUploader\DTO\ExportUserListCsvUploaderForm;
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
    /** @var FormFactoryBuilder */
    private $formFactoryBuilder;

    /** @var CsvUploadUseCase */
    private $csvUploadUseCase;

    /**
     * CsvUploaderController constructor.
     * @param FormFactoryBuilder $formFactoryBuilder
     * @param CsvUploadUseCase $csvUploadUseCase
     */
    public function __construct(FormFactoryBuilder $formFactoryBuilder, CsvUploadUseCase $csvUploadUseCase)
    {
        $this->formFactoryBuilder = $formFactoryBuilder;
        $this->csvUploadUseCase = $csvUploadUseCase;
    }

    public function index(Request $request): Response
    {
        $formFactory = $this->formFactoryBuilder->run();

        $form = $formFactory
            ->createNamedBuilder('', CsvUploaderType::class, new ExportUserListCsvUploaderForm())
            ->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $exportUserListCsvUploaderForm = $form->getData();
            assert($exportUserListCsvUploaderForm instanceof ExportUserListCsvUploaderForm);

            $this->csvUploadUseCase->run($exportUserListCsvUploaderForm->getCsvFile());

            return new Response('', Response::HTTP_OK);
        }

        return new Response('', Response::HTTP_BAD_REQUEST);
    }
}
