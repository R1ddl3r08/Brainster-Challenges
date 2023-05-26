<?php

class Kiwi extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Kiwi', $price, $sellingByKg);
    }
}

?>