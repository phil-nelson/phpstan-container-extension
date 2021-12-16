<?php
declare(strict_types = 1);

namespace PhilNelson\PHPStanContainerExtension;

use PHPStan\Testing\TypeInferenceTestCase;

class ContainerDynamicReturnTypeResolverTest extends TypeInferenceTestCase
{
    /**
     * @dataProvider dataFileAsserts
     */
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
    public function dataFileAsserts(): iterable
    {
        yield from $this->gatherAssertTypes(__DIR__ . '/data/container-types.php');
    }

    public static function getAdditionalConfigFiles(): array
    {
        return [__DIR__ . '/../extension.neon'];
    }
}
