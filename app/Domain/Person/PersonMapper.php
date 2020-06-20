<?php

declare(strict_types=1);

namespace App\Domain\Person;

use App\Domain\Person\Factory\PersonFactoryInterface;

class PersonMapper
{
    /** @var PersonFactoryInterface[] */
    private array $people;

    public function __construct(array $people)
    {
        $this->people = $people;
    }

    public function map(array $data): array
    {
        $people = [];

        foreach ($data as $datum) {
            foreach ($this->people as $person) {
                if ($person->supports($datum)) {
                    $result = $person->fromArray($datum);

                    foreach ($result as $item) {
                        $people[] = $item;
                    }
                }
            }
        }

        return $people;
    }
}
