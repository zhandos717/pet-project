<?php

declare(strict_types=1);

namespace App\Di;

use ReflectionClass;
use ReflectionException;

final class Container
{
    private array $objects = [];

    /**
     * @param string $class
     * @return bool
     */
    public function has(string $class): bool
    {
        return isset($this->objects[$class]) || class_exists($class);
    }

    /**
     * @param string $class
     * @param string|null $method
     * @return object|null
     * @throws ReflectionException
     */
    public function get(string $class, ?string $method = null): object|null
    {
        return
            isset($this->objects[$class])
                ? $this->objects[$class]()
                : $this->prepareObject($class,$method);
    }

    /**
     * @param string $class
     * @param string|null $method
     * @return object|null
     * @throws ReflectionException
     */
    private function prepareObject(string $class,?string $method = null): object|null
    {
        $classReflector = new ReflectionClass($class);

        $constructReflector = $classReflector->getConstructor();

        $classInit = empty($constructReflector) ? new $class() :  new $class(...$this->getArguments($constructReflector));

        if($method && $classReflector->hasMethod($method)){
            $methodReflector = $classReflector->getMethod($method);
            return $classInit->$method(...$this->getArguments($methodReflector));
        }

        return $classInit;
    }
    /**
     * @throws ReflectionException
     */
    public function getArguments($methodReflector ): array
    {
        $constructArguments = $methodReflector->getParameters();

        $args = [];

        if (empty($constructArguments)) {
            return $args;
        }

        foreach ($constructArguments as $argument) {
            $argumentType = $argument->getType()->getName();
            $args[$argument->getName()] = $this->get($argumentType);
        }

        return $args;
    }
}
