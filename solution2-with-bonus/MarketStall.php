<?php

class MarketStall
{
    public $products;

    public function __construct(array $products = [])
    {
        $this->products = $products;
    }

    public function addProductToMarket(object $product)
    {
        $this->products[$product->getName()] = $product;
    }

    public function getItem(string $item, float $amount)
    {
        if(array_key_exists($item, $this->products)){
            return ['amount' => $amount, 'item' => $this->products[$item]];
        }

        return false;
    }
}

?>