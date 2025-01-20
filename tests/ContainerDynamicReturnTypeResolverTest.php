<?php
declare(strict_types = 1);

namespace PhilNelson\PHPStanContainerExtension;

use PHPStan\Testing\TypeInferenceTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class ContainerDynamicReturnTypeResolverTest extends TypeInferenceTestCase
{
    #[DataProvider('dataFileAsserts')]
    public function testFileAsserts(
        string $assertType,
        string $file,
        ...$args
    ): void
    {
        $this->assertFileAsserts($assertType, $file, ...$args);
    }

    /**
     * @return iterable<mixed>
     */
    public static function dataFileAsserts(): iterable
    {
        yield from self::gatherAssertTypes(__DIR__ . '/data/container-types.php');
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../extension.neon'];
    }
}
