# Distance
[![Tests](https://github.com/ldebrouwer/distance/actions/workflows/tests.yml/badge.svg)](https://github.com/ldebrouwer/distance/actions/workflows/tests.yml)
[![Latest Stable Version](https://poser.pugx.org/ldebrouwer/distance/v/stable)](https://packagist.org/packages/ldebrouwer/distance)
[![Total Downloads](https://poser.pugx.org/ldebrouwer/distance/downloads)](https://packagist.org/packages/ldebrouwer/distance)
[![Latest Unstable Version](https://poser.pugx.org/ldebrouwer/distance/v/unstable)](https://packagist.org/packages/ldebrouwer/distance)
[![License](https://poser.pugx.org/ldebrouwer/distance/license)](https://packagist.org/packages/ldebrouwer/distance)

Distance helps you calculate the distance between GPS coordinates, in vanilla PHP. Pure and simple.

## Installation

### Using Composer

When using [Composer](https://getcomposer.org) you can always load in the latest version.

```bash
{
    "require": {
        "ldebrouwer/distance": "^1.0"
    }
}
```
Check it out [on Packagist](https://packagist.org/packages/ldebrouwer/distance).

## Usage

```php
$distance = new Distance()
    ->setFormula(Formula::HAVERSINE)
    ->setUnit(Unit::KILOMETRES)
    ->between(37.331741, -122.030333, 37.422546, -122.084250);
```

## Still to come
- Expanded unit support.
- Documentation.