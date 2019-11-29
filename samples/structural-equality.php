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

    public function equals(Price $price): bool
    {
        return $this->hash() === $price->hash();
    }

    private function hash(): string
    {
        return md5("{$this->currency}{$this->amount}");
    }

    public function __toString(): string
    {
        return "{$this->currency}\${$this->amount}";
    }
}

$first = new Price('USD', 249.95);
$second = new Price('USD', 249.95);

var_dump(
    $first == $second, // true
    $first === $second, // false
);

var_dump(
    $first->equals($second), // true
);
