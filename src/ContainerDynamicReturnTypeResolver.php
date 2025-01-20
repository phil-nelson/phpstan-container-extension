<?php
declare(strict_types = 1);

namespace PhilNelson\PHPStanContainerExtension;

use PhpParser\Node\Expr\MethodCall;
use Psr\Container\ContainerInterface;
use PHPStan\Analyser\Scope;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptorSelector;
use PHPStan\Type\DynamicMethodReturnTypeExtension;
use PHPStan\Type\ObjectType;
use PHPStan\Type\Type;

final class ContainerDynamicReturnTypeResolver implements DynamicMethodReturnTypeExtension
{
    public function getClass(): string
    {
        return ContainerInterface::class;
    }

    public function isMethodSupported(MethodReflection $reflection): bool
    {
        return $reflection->getName() === 'get';
    }

    public function getTypeFromMethodCall(
        MethodReflection $methodReflection,
        MethodCall $methodCall,
        Scope $scope
    ): Type {
        $args = $methodCall->getArgs();
        if (count($args) !== 1) {
            return ParametersAcceptorSelector::selectFromArgs($scope, $methodCall->getArgs(), $methodReflection->getVariants())->getReturnType();
        }

        $argType = $scope->getType($args[0]->value);
        if (count($argType->getConstantStrings()) === 0) {
            return ParametersAcceptorSelector::selectFromArgs($scope, $methodCall->getArgs(), $methodReflection->getVariants())->getReturnType();
        }

        if ($argType->isClassString()->no()) {
            return ParametersAcceptorSelector::selectFromArgs($scope, $methodCall->getArgs(), $methodReflection->getVariants())->getReturnType();
        }

        return new ObjectType($argType->getValue());
    }
}
