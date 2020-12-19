<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\App;

use Goreboothero\CsvUploader\Http\Controller\CsvUploaderController;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;

/**
 * Class Kernel
 * @package Goreboothero\CsvUploader\App
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        return [
            new FrameworkBundle(),
        ];
    }

    protected function configureContainer(ContainerConfigurator $containerConfigurator): void
    {
        $containerConfigurator->extension('framework', [
            'secret' => 'S0ME_SECRET',
            'test' => true,
        ]);
    }

    protected function configureRoutes(RoutingConfigurator $routingConfigurator): void
    {
        $routingConfigurator
            ->add('csv_uploader_index','/')
            ->controller([CsvUploaderController::class, 'index'])
            ->methods(['GET']);
    }
}