<?php

namespace Storee\Model\Exception;

class PricingException extends \Exception
{
    const UNSUPPORTED_PRODUCT_PRICE = 1;
    const INVALID_PRICE = 2;
    const NO_PRICE_SPECIFIED = 3;
    const INVALID_CODE = 4;

    public static function unsupportedProductPrice(string $productCode)
    {
        return new self(
            'There is no price defined for product: ' . $productCode,
            self::UNSUPPORTED_PRODUCT_PRICE
        );
    }

    public static function invalidPrice(float $price, string $code)
    {
        return new self(
            "The specified price of {$price} for product {$code} is invalid",
            self::INVALID_PRICE
        );
    }

    public static function invalidAmount(int $amount, string $code)
    {
        return new self(
            "The specified amount of {$amount} for product {$code} is invalid",
            self::INVALID_PRICE
        );
    }

    public static function noPriceSpecified(string $code)
    {
        return new self(
            "There is no price specified for product {$code}",
            self::NO_PRICE_SPECIFIED
        );
    }

    public static function invalidProductCode(string $code)
    {
        return new self(
            "The following product code is invalid: {$code}",
            self::INVALID_CODE
        );
    }
}
