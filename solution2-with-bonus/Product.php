<?php

abstract class Product
{
    private $name;
    private $price;
    private $sellingByKg;

    public function __construct(string $name, float $price, bool $sellingByKg)
    {
        $this->name = $name;
        $this->price = $price;
        $this->sellingByKg = $sellingByKg;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSellingByKg()
    {
        return $this->sellingByKg;
    }
}

?>