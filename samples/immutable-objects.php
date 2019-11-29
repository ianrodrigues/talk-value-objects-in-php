<?php

declare(strict_types=1);

final class Price
{
    private string $currency;
    private float $amount;

    public function __construct(string $currency, float $amount)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function aggregate(float $amount): self
    {
        $amount += $this->amount;
        return new self($this->currency, $amount);
    }

    public function __toString(): string
    {
        return "{$this->currency}\${$this->amount}";
    }
}

class Product
{
    public string $name;
    public Price $price;

    public function __construct(string $name, Price $price)
    {
        $this->name = $name;
        $this->price = $price;
    }
}

$pepper = new Product('Dr. Pepper 21oz', new Price('USD', 1.46));
$coke = new Product('Coca-Cola 21oz', $pepper->price);

// Coke costs $1.25 more than Dr. Pepper soda
$coke->price = $coke->price->aggregate(1.25);

var_dump(
    "Dr. Pepper: {$pepper->price}", // Dr. Pepper: USD$1.46
    "Coke: {$coke->price}", // Dr. Pepper: USD$2.71
);
