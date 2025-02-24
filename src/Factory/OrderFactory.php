<?php

namespace App\Factory;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;

class OrderFactory
{
    public function create(): Order
    {
        $order = new Order();
        $order
            ->setStatus(Order::STATUS_CART)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime())
        ;

        return $order;
    }

    public function createItem(Product $product): OrderItem
    {
        return (new OrderItem())
            ->setProduct($product)
            ->setQuantity(1)
        ;
    }
}