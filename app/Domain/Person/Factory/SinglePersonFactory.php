<?php

declare(strict_types=1);

namespace App\Domain\Person\Factory;

use App\Domain\Person\InvalidPersonException;
use App\Domain\Person\Person;

class SinglePersonFactory implements PersonFactoryInterface
{
    public function supports(array $data): bool
    {
        return count($data) === 1;
    }

    /**
     * @param array $data
     * @return Person[]
     * @throws InvalidPersonException
     */
    public function fromArray(array $data): array
    {
        return [new Person($data[0])];
    }
}
