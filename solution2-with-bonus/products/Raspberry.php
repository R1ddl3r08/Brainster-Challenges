<?php

class Raspberry extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Raspberry', $price, $sellingByKg);
    }
}

?>