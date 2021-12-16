<?php
declare(strict_types = 1);

namespace MyTypesTest;

use Psr\Container\ContainerInterface;

use function PHPStan\Testing\assertType;

class Foo
{
    public function doFoo(ContainerInterface $container): void
    {
        assertType(FooService::class, $container->get(FooService::class));
        assertType(\BarService::class, $container->get(\BarService::class));
        assertType('mixed', $container->get('foo'));
        assertType('mixed', $container->get(true));
        assertType('mixed', $container->get(1));
        assertType('mixed', $container->get(new \stdClass()));
    }
}
