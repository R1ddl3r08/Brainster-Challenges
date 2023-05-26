<?php

require_once('Product.php');
require_once('products/Orange.php');
require_once('products/Kiwi.php');
require_once('products/Nuts.php');
require_once('products/Pepper.php');
require_once('products/Potato.php');
require_once('products/Raspberry.php');
require_once('MarketStall.php');
require_once('Cart.php');


// Creating product objects
$orange = new Orange(35, true);
$potato = new Potato(240, false);
$nuts = new Nuts(850, true);
$kiwi = new Kiwi(670, false);
$pepper = new Pepper(330, true);
$raspberry = new Raspberry(555, false);

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