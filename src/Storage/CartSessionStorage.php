<?php

namespace App\Storage;

use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartSessionStorage
{
    const CART_KEY_NAME = 'cart_id';
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly OrderRepository $cartRepository,
    )
    {
    }

    public function getCart(): ?Order
    {
        return $this->cartRepository->findOneBy([
            'id'=> $this->getCartId(),
            'status' => Order::STATUS_CART
        ]);
    }

    public function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

    public function setCart(Order $cart): void
    {
        $this->getSession()->set(self::CART_KEY_NAME, $cart->getId());
    }

    public function getCartId(): ?int
    {
        return $this->getSession()->get(self::CART_KEY_NAME);
    }
}