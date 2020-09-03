<?php

namespace Store\Model\Pricing;

interface PriceableInterface
{
    /**
     * @return string
     */
    public function getProductCode(): string;

    /**
     * @param float $price
     */
    public function setSinglePrice(float $price): void;

    /**
     * @param float $price
     * @param int $amount
     */
    public function setBulkPrice(float $price, int $amount): void;

    /**
     * Calculate total cost for specified amount of products
     *
     * @param int $count
     * @return float
     */
    public function getTotal(int $count): float;
}
