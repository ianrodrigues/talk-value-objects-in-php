<?php

declare(strict_types=1);

use Doctrine\ORM\Mapping as ORM;

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
