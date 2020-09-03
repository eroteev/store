<?php

namespace Store\Model\Pricing;

interface PricingTableInterface
{
    /**
     * @param PriceableInterface $productPrice
     */
    public function addProductPrice(PriceableInterface $productPrice): void;

    /**
     * Get the total price for specific product by given product count
     *
     * @param string $code
     * @param int $count
     * @return float
     */
    public function getTotalPrice(string $code, int $count): float;
}
