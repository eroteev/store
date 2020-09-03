<?php

namespace Store\Model\Pricing;

use Storee\Model\Exception\PricingException;

/**
 * ProductPrice represents the price options for single product
 */
class ProductPrice implements PriceableInterface
{
    /**
     * @var string
     */
    private $code;

    /**
     * @var float
     */
    private $singlePrice = 0.0;

    /**
     * @var float
     */
    private $bulkPrice = 0.0;

    /**
     * @var int
     */
    private $bulkAmount = 0;

    /**
     * @param string $code
     * @throws PricingException
     */
    public function __construct(string $code)
    {
        if (empty($code)) {
            throw PricingException::invalidProductCode($code);
        }
        $this->code = $code;
    }

    /**
     * {@inheritDoc}
     */
    public function getProductCode(): string
    {
        return $this->code;
    }

    /**
     * {@inheritDoc}
     */
    public function setSinglePrice(float $price): void
    {
        if ($price < 0) {
            throw PricingException::invalidPrice($price, $this->code);
        }
        $this->singlePrice = $price;
    }

    /**
     * {@inheritDoc}
     */
    public function setBulkPrice(float $price, int $amount): void
    {
        if ($price < 0) {
            throw PricingException::invalidPrice($price, $this->code);
        }

        if ($amount < 0) {
            throw PricingException::invalidAmount($price, $this->code);
        }

        $this->bulkPrice = $price;
        $this->bulkAmount = $amount;
    }

    /**
     * {@inheritDoc}
     */
    public function getTotal(int $count): float
    {
        if (empty($this->singlePrice) && empty($this->bulkPrice)) {
            throw PricingException::noPriceSpecified($this->code);
        }

        if (!empty($this->bulkPrice)) {
            $bulkCount = floor($count / $this->bulkAmount);
            return $bulkCount * $this->bulkPrice + ($count - $bulkCount * $this->bulkAmount) * $this->singlePrice;
        }

        return $this->singlePrice * $count;
    }
}
