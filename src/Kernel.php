<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader;

use Goreboothero\CsvUploader\Http\Controller\CsvUploaderController;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/**
 * Class Kernel
 */
class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): array
    {
        return [new FrameworkBundle()];
    }

    protected function configureContainer(ContainerConfigurator $containerConfigurator): void
    {
        $containerConfigurator->extension('framework', [
            'test' => true,
            'validation' => [
                'enabled' => true,
                'enable_annotations' => true,
            ],
        ]);

        $services = $containerConfigurator->services();

        $services->defaults()
            ->autowire()
            ->autoconfigure();

        $services
            ->load('Goreboothero\CsvUploader\\', '../src/*')
            ->exclude('../src/Form/{Form,UseCase,Validator,Kernel.php}')
            ->autowire();

        $services
            ->load('Goreboothero\CsvUploader\Http\Controller\\', '../src/http/Controller')
            ->tag('controller.service_arguments')
            ->autowire();
    }

    protected function configureRoutes(RoutingConfigurator $routingConfigurator): void
    {
        $routingConfigurator
            ->add('csv_uploader_index', '/')
            ->controller([CsvUploaderController::class, 'index'])
            ->methods(['POST']);
    }
}
