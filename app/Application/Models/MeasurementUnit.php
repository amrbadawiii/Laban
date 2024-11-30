<?php

namespace App\Application\Models;

class MeasurementUnit
{
    private int $id;
    private string $nameEn;
    private string $nameAr;
    private ?string $abbreviation;

    public function __construct(int $id, string $nameEn, string $nameAr, ?string $abbreviation = null)
    {
        $this->id = $id;
        $this->nameEn = $nameEn;
        $this->nameAr = $nameAr;
        $this->abbreviation = $abbreviation;
    }

    // Magic methods
    public function __get(string $property)
    {
        if (property_exists($this, $property)) {
            return $this->{$property};
        }

        throw new \Exception("Property '{$property}' does not exist on " . static::class);
    }

    public function __isset(string $property): bool
    {
        return property_exists($this, $property);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    public function getNameAr(): string
    {
        return $this->nameAr;
    }

    public function getAbbreviation(): ?string
    {
        return $this->abbreviation;
    }

    /**
     * Get the name based on the provided locale.
     *
     * @param string $locale
     * @return string
     */
    public function getNameByLocale(string $locale): string
    {
        return $locale === 'ar' ? $this->nameAr : $this->nameEn;
    }
}
