<?php

declare(strict_types=1);

final class Price
{
    private string $currency;
    private float $amount;

    public function __construct(string $currency, float $amount)
    {
        if (! in_array($currency, ['BRL', 'USD', 'CAD', 'EUR'])) {
            throw new \InvalidArgumentException(
                "{$currency} isn't a valid currency."
            );
        }

        if ($amount < 0) {
            throw new \InvalidArgumentException(
                "Amount should be great than zero: {$amount}."
            );
        }

        $this->currency = $currency;
        $this->amount = $amount;
    }

    public function __toString(): string
    {
        return "{$this->currency}\${$this->amount}";
    }
}

$first = new Price('JPY', 199.99); // Uncaught InvalidArgumentException: JPY is not a valid currency.
$second = new Price('BRL', -235.50); // Uncaught InvalidArgumentException: Amount should be great than zero: -235.5.
