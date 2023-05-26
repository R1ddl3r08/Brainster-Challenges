<?php

require_once('Product.php');
require_once('MarketStall.php');
require_once('Cart.php');

// Creating product objects
$orange = new Product('Orange', 35, true);
$potato = new Product('Potato', 240, false);
$nuts = new Product('Nuts', 850, true);
$kiwi = new Product('Kiwi', 670, false);
$pepper = new Product('Pepper', 330, true);
$raspberry = new Product('Raspberry', 555, false);

// Creating market stall objects
$stall_1 = new MarketStall;
$stall_2 = new MarketStall;

// Adding products to stall 1
$stall_1->addProductToMarket($orange);
$stall_1->addProductToMarket($potato);
$stall_1->addProductToMarket($nuts);

// Adding products to stall 2
$stall_2->addProductToMarket($kiwi);
$stall_2->addProductToMarket($pepper);
$stall_2->addProductToMarket($raspberry);

// Creating new cart
$cart = new Cart;

// Adding items to cart
$cart->addToCart($stall_1->getItem('Orange', 3));
$cart->addToCart($stall_1->getItem('Nuts', 1.5));
$cart->addToCart($stall_2->getItem('Raspberry', 2));

// Printing receipt
$cart->printReceipt();


?>