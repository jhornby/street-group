<?php

declare(strict_types=1);

namespace App\Domain\Person;

class PeopleCollection
{
    private array $people = [];

    private PersonMapper $mapper;

    public function __construct(PersonMapper $mapper)
    {
        $this->mapper = $mapper;
    }

    public function fromCsv($csv): self
    {
        if (!is_resource($csv)) {
            throw new \InvalidArgumentException('fromCSV expects a resource');
        }

        $people = [];

        while (($data = fgetcsv($csv, 0, ',')) !== false) {
            $splitPeople = $this->splitPeople($data);
            $csvHeader = 'homeowner';

            if ($data[0] !== $csvHeader) {
                $people[] = $splitPeople;
            }
        }

        $mappedPeople = $this->mapper->map($people);

        foreach ($mappedPeople as $person) {
            $this->people[] = $person;
        }

        return $this;
    }

    /**
     * @return Person[]
     */
    public function toArray(): array
    {
        return $this->people;
    }

    public function flatten(): array
    {
        return array_map(fn (Person $person) => $person->toArray(), $this->toArray());
    }

    private function splitPeople(array $people): array
    {
        return preg_split('/ (and|&) /', $people[0]);
    }
}
