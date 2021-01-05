<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO;

class ExportUserListCsv
{
    /** @var int */
    private $id;

    /** @var string */
    private $familyName;

    /** @var string */
    private $lastName;

    /**
     * Csv constructor.
     * @param int $id
     * @param string $familyName
     * @param string $lastName
     */
    public function __construct(int $id, string $familyName, string $lastName)
    {
        $this->id = $id;
        $this->familyName = $familyName;
        $this->lastName = $lastName;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }
}
