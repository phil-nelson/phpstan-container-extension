# A PHPStan extension for PSR-11 ContainerInterface

This is an extension for PHPStan when using a PSR-11 ContainerInterface which returns the same type when provided with
a class string.

## Installation

Install with:

```
composer require --dev phil-nelson/phpstan-container-extension
```

Add the `extension.neon` file to your PHPStan config:

```
includes:
  - vendor/phil-nelson/phpstan-container-extension/extension.neon
```

Or use [phpstan/extension-installer](https://github.com/phpstan/extension-installer)
