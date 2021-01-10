<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\Validator;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Context\ExecutionContextInterface;
use Symfony\Component\Validator\Violation\ConstraintViolationBuilderInterface;

use function dirname;
use function mb_convert_encoding;

class FileContentTextCharsetValidatorTest extends WebTestCase
{
    public function test_UTF8は許可(): void
    {
        $utf8Content =  mb_convert_encoding('ダミーテキスト_test', 'UTF-8');

        $filePath = dirname(__FILE__) . '/../TestFile/dummy.txt';
        $uploadedFileP = $this->prophesize(UploadedFile::class);
        $uploadedFileP->willBeConstructedWith([$filePath, '', '', null, false]);
        $uploadedFileP->getContent()->willReturn($utf8Content)->shouldBeCalledTimes(1);
        $uploadedFile = $uploadedFileP->reveal();

        $fileContentTextCharsetP = $this->prophesize(FileContentTextCharset::class);
        $fileContentTextCharset = $fileContentTextCharsetP->reveal();

        $executionContextP = $this->prophesize(ExecutionContextInterface::class);
        $executionContext = $executionContextP->reveal();

        $SUT = $this->getSUT($executionContext);
        $SUT->validate($uploadedFile, $fileContentTextCharset);
    }

    public function test_EUCJPは禁止(): void
    {
        $eucContent =  mb_convert_encoding('ダミーテキスト_test', 'EUC-JP');

        $filePath = dirname(__FILE__) . '/../TestFile/dummy.txt';
        $uploadedFileP = $this->prophesize(UploadedFile::class);
        $uploadedFileP->willBeConstructedWith([$filePath, '', '', null, false]);
        $uploadedFileP->getContent()->willReturn($eucContent)->shouldBeCalledTimes(2);
        $uploadedFile = $uploadedFileP->reveal();

        $fileContentTextCharsetP = $this->prophesize(FileContentTextCharset::class);
        $fileContentTextCharset = $fileContentTextCharsetP->reveal();

        $constraintViolationBuilderP = $this->prophesize(ConstraintViolationBuilderInterface::class);
        $constraintViolationBuilderP->setParameter('{{ charset-name }}', 'EUC-JP')
            ->willReturn($constraintViolationBuilderP)
            ->shouldBeCalled();
        $constraintViolationBuilderP->addViolation()->willReturn($constraintViolationBuilderP)->shouldBeCalled();
        $constraintViolationBuilder = $constraintViolationBuilderP->reveal();

        $executionContextP = $this->prophesize(ExecutionContextInterface::class);
        $executionContextP->buildViolation(FileContentTextCharset::DEFAULT_ERROR_MESSAGE)
            ->willReturn($constraintViolationBuilder)
            ->shouldBeCalled();
        $executionContext = $executionContextP->reveal();

        $SUT = $this->getSUT($executionContext);
        $SUT->validate($uploadedFile, $fileContentTextCharset);
    }

    private function getSUT(ExecutionContextInterface $executionContext)
    {
        $SUT = new FileContentTextCharsetValidator();
        $SUT->initialize($executionContext);

        return $SUT;
    }
}
