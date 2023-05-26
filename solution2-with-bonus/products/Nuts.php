<?php

class Nuts extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Nuts', $price, $sellingByKg);
    }
}

?>