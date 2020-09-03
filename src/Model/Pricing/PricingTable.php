<?php

namespace Store\Model\Pricing;

use Storee\Model\Exception\PricingException;

/**
 * PricingTable is used to store the prices for all available products
 */
class PricingTable implements PricingTableInterface
{
    /**
     * Product prices table
     *
     * @var PriceableInterface[]
     */
    private $productPrices;

    /**
     * {@inheritDoc}
     */
    public function addProductPrice(PriceableInterface $productPrice): void
    {
        $this->productPrices[$productPrice->getProductCode()] = $productPrice;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotalPrice(string $code, int $count): float
    {
        if (!isset($this->productPrices[$code])) {
            throw PricingException::unsupportedProductPrice();
        }

        return $this->productPrices[$code]->getTotal($count);
    }
}
