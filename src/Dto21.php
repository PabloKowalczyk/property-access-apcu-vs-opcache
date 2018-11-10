<?php

declare(strict_types=1);

namespace App;

final class Dto21
{
    /** @var string */
    private $prop1;
    /** @var int */
    private $prop2;
    /** @var array */
    private $prop3;
    /** @var \stdClass */
    private $prop4;
    /** @var float|null */
    private $prop5;

    public function prop1(): string
    {
        return $this->prop1;
    }

    public function setProp1(string $prop1): void
    {
        $this->prop1 = $prop1;
    }

    public function prop2(): int
    {
        return $this->prop2;
    }

    public function setProp2(int $prop2): void
    {
        $this->prop2 = $prop2;
    }

    public function prop3(): array
    {
        return $this->prop3;
    }

    public function setProp3(array $prop3): void
    {
        $this->prop3 = $prop3;
    }

    public function prop4(): \stdClass
    {
        return $this->prop4;
    }

    public function setProp4(\stdClass $prop4): void
    {
        $this->prop4 = $prop4;
    }

    public function prop5(): ?float
    {
        return $this->prop5;
    }

    public function setProp5(?float $prop5): void
    {
        $this->prop5 = $prop5;
    }
}