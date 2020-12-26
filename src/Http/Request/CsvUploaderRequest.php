<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Http\Controller;

use Symfony\Component\Form\Extension\HttpFoundation\HttpFoundationExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\Request;

use function dd;

/**
 * Class CsvUploaderController
 */
class CsvUploaderRequest
{
    public function index(Request $request): void
    {
        $formFactory = Forms::createFormFactoryBuilder()
            ->addExtension(new HttpFoundationExtension())
            ->getFormFactory();

        dd($request);
    }
}
