<?php

declare(strict_types=1);

use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Mapping as ORM;

final class PriceType extends Type
{
    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'VARCHAR(255)';
    }

    public function convertToDatabaseValue($price, AbstractPlatform $platform)
    {
        return "{$price->getCurrency()}|{$price->getAmount()}";
    }

    public function convertToPHPValue($price, AbstractPlatform $platform)
    {
        [$currency, $amount] = explode('|', $price);
        return new Price($currency, (float) $amount);
    }

    public function getName()
    {
        return 'price';
    }
}

/** @ORM\Embeddable */
final class Price
{
    /** @ORM\Column(type="string", length=3) */
    private string $currency;

    /** @ORM\Column(type="decimal", precision=8, scale=4) */
    private float $amount;

    public function __construct(string $currency, float $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getAmount(): float
    {
        return $this->float;
    }
}

/** @ORM\Entity */
class Product
{
    /** @ORM\Column(type="string", length=50) */
    private string $name;

    /** @ORM\Embedded(class="Price") */
    private Price $price;

    public function __construct(string $name, Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}
