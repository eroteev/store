# Store checkout line

Imagine a store where products have prices per unit but also volume prices. E.g., bananas may be £1.00 each or 5 for £3.00.

The component takes products in arbitrary order (similar to a checkout line) and then returns the correct final price for the entire shopping basket based on the prices as applicable.

## Example
To see an example checkout the project and run the following commands:
```bash
composer install
php example
```

## Tests
To execute the tests run the following commands:
```bash
vendor/bin/phpunit tests
```

## Demo data
The demo data can be found in file data/sample.php
