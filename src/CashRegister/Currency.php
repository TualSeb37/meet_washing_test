<?php

namespace App\CashRegister;

class Currency
{
    private int $currency;
    private string $name;


    /**
     * Get the value of name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */
    public function setName($name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of currency
     */
    public function getCurrency(): int
    {
        return $this->currency;
    }

    /**
     * Set the value of currency
     *
     * @return  self
     */
    public function setCurrency($currency): static
    {
        $this->currency = $currency;

        return $this;
    }
}