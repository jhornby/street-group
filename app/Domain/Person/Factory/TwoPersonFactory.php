<?php

declare(strict_types=1);

namespace App\Domain\Person\Factory;

use App\Domain\Person\InvalidPersonException;
use App\Domain\Person\Person;
use App\Enum\TitleEnum;

class TwoPersonFactory implements PersonFactoryInterface
{
    public function supports(array $data): bool
    {
        return count($data) === 2;
    }

    /**
     * @param array $data
     * @return Person[]
     * @throws InvalidPersonException
     */
    public function fromArray(array $data): array
    {
        $results = [];

        // Given an array of ['Dr', 'Mr John Smith'] we want to replace Mr with Dr and in the end return ['Dr John Smith', 'Mr John Smith']
        if ($this->isJustATitle($data)) {
            $personWithReplacedTitle = $this->replaceTitle($data);
            $results[] = new Person($personWithReplacedTitle);
        } else {
            $results[] = new Person($data[0]);
        }

        $results[] = new Person($data[1]);

        return $results;
    }

    private function replaceTitle(array $data): string
    {
        $name = explode(' ', $data[1]);

        foreach (TitleEnum::getAll() as $title) {
            if ($title === $name[0]) {
                return str_replace($title, $data[0], $data[1]);
            }
        }

        throw new \InvalidArgumentException();
    }

    private function isJustATitle(array $data): bool
    {
        return in_array($data[0], TitleEnum::getAll(), true);
    }
}
