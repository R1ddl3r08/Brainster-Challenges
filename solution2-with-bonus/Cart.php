<?php

class Cart
{
    public $cartItems;

    public function addToCart($getItem)
    {
        if($getItem != false){
            $this->cartItems[] = $getItem;
        }
    }

    public function printReceipt()
    {
        if(empty($this->cartItems)){
            echo 'Your cart is empty';
        } else {
            $totalPrice = 0;
            foreach($this->cartItems as $item){
                $totalItem = $item['item']->getPrice() * $item['amount'];
                if($item['item']->getSellingByKg() == true){
                    echo $item['item']->getName() . ' | ' . $item['amount'] . 'kgs | total: ' . $totalItem . ' denars<br>';
                    $totalPrice += $totalItem;
                } else {
                    echo $item['item']->getName() . ' | ' . $item['amount'] . ' gunny sacks | total: ' . $totalItem . ' denars<br>';
                    $totalPrice += $totalItem;
                }
            }

            echo 'Final price amount: ' . $totalPrice . ' denars<br>';
        }

    }

}

?>