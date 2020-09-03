<?php

namespace Store\Model;

use Store\Model\Pricing\PricingTableInterface;

/**
 * Terminal represents the checkout line in the store
 */
class Terminal implements TerminalInterface
{
    /**
     * Product prices table
     *
     * @var PricingTableInterface
     */
    private $pricingTable;

    /**
     * List of products scanned by the terminal
     *
     * @var array
     */
    private $basket = [];

    /**
     * @param PricingTableInterface $pricingTable
     */
    public function __construct(PricingTableInterface $pricingTable)
    {
        $this->setPricing($pricingTable);
    }

    /**
     * {@inheritDoc}
     */
    public function setPricing(PricingTableInterface $pricingTable): void
    {
        $this->pricingTable = $pricingTable;
    }

    /**
     * {@inheritDoc}
     */
    public function scanItem(string $code): void
    {
        $this->basket[$code] = isset($this->basket[$code]) ? $this->basket[$code] + 1 : 1;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotal(): float
    {
        $total = 0.00;
        foreach ($this->basket as $code => $count) {
            $total += $this->pricingTable->getTotalPrice($code, $count);
        }

        return $total;
    }
}
