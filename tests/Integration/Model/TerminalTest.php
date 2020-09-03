<?php
declare(strict_types=1);

namespace Integration\Model;

use Store\Model\Pricing\PricingTable;
use Store\Model\Pricing\ProductPrice;
use Store\Model\Terminal;
use PHPUnit\Framework\TestCase;

class TerminalTest extends TestCase
{
    /**
     * @dataProvider scannedItems
     */
    public function testGetTotal(string $scannedItems, float $expected)
    {
        $terminal = new Terminal($this->getPricingTable());
        foreach (explode(',', $scannedItems) as $code) {
            $terminal->scanItem($code);
        }

        $this->assertEquals($terminal->getTotal(), $expected);
    }

    public function getPricingTable(): PricingTable
    {
        $prices = [
            ['code' => 'ZA', 'single' => 2.0, 'bulk' => 7.0, 'bulkAmount' => 4],
            ['code' => 'YB', 'single' => 12.0, 'bulk' => 0.0, 'bulkAmount' => 0],
            ['code' => 'FC', 'single' => 1.25, 'bulk' => 6.0, 'bulkAmount' => 6],
            ['code' => 'GD', 'single' => 0.15, 'bulk' => 0.0, 'bulkAmount' => 0],
        ];

        $pricingTable = new PricingTable();
        foreach ($prices as $price) {
            $productPrice = new ProductPrice($price['code']);
            if ($price['single']) {
                $productPrice->setSinglePrice($price['single']);
            }
            if ($price['bulk']) {
                $productPrice->setBulkPrice($price['bulk'], $price['bulkAmount']);
            }
            $pricingTable->addProductPrice($productPrice);
        }

        return $pricingTable;
    }

    public function scannedItems()
    {
        return [
            ['ZA,YB,FC,GD,ZA,YB,ZA,ZA', 32.40],
            ['FC,FC,FC,FC,FC,FC,FC', 7.25],
            ['ZA,YB,FC,GD', 15.40],
        ];
    }
}
