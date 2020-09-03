<?php

namespace Store\Model;

use Store\Model\Pricing\PricingTableInterface;

/**
 * Interface TerminalInterface
 * @package Store\Model
 */
interface TerminalInterface
{
    /**
     * Set product price
     *
     * @param PricingTableInterface $pricingTable
     */
    public function setPricing(PricingTableInterface $pricingTable): void;

    /**
     * Add product to the basket
     *
     * @param string $code
     */
    public function scanItem(string $code): void;

    /**
     * Calculate the final price for all products in the basket
     *
     * @return mixed
     */
    public function getTotal(): float;
}
