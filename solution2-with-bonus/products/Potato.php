<?php

class Potato extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Potato', $price, $sellingByKg);
    }
}

?>