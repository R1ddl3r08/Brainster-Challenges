<?php

class Pepper extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Pepper', $price, $sellingByKg);
    }
}

?>