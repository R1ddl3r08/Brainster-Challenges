<?php

class Orange extends Product
{
    public function __construct(float $price, bool $sellingByKg)
    {
        parent::__construct('Orange', $price, $sellingByKg);
    }
}

?>