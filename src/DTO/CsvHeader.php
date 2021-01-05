<?php

declare(strict_types=1);

namespace Goreboothero\CsvUploader\DTO;

class CsvHeader
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $familyName;

    /**
     * @var string
     */
    private $lastName;

    /**
     * Csv constructor.
     * @param string $id
     * @param string $familyName
     * @param string $lastName
     */
    public function __construct(string $id, string $familyName, string $lastName)
    {
        $this->id = $id;
        $this->familyName = $familyName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFamilyName(): string
    {
        return $this->familyName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
}