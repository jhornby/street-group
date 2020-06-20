<?php

declare(strict_types=1);

namespace App\Domain\Person\Factory;

interface PersonFactoryInterface
{
    public function supports(array $data): bool;

    public function fromArray(array $data): array;
}
