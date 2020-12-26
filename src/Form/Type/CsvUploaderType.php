<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Form\Type;

use Goreboothero\CsvUploader\Entity\File\Csv;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class CsvUploaderType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('csv_file', FileType::class, [
//                'constraints' => [
//                    new Assert\File([
//                        'mimeTypes' => 'text/csv',
//                    ]),
//                ],
            ]);

        //TODO: CSVをアップロードした際、text/plainになる問題があるため、text/csvでバリデートさせる https://polidog.jp/2018/07/19/symfony_validator/
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Csv::class,
        ]);
    }
}
