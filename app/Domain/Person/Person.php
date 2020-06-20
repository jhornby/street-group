<?php

declare(strict_types=1);

namespace App\Domain\Person;

class Person
{
    private array $titles = [
        'Dr',
        'Mr',
        'Ms',
        'Mrs',
        'Miss',
        'Mister',
        'Prof',
    ];

    private string $title;

    private ?string $firstName = null;

    private ?string $initial = null;

    private string $lastName;

    public function __construct(string $data)
    {
        $data = explode(' ', $data);

        if (!$this->hasRequiredFields($data)) {
            throw new InvalidPersonException('Missing title');
        }

        if (!$this->isTitleValid($data)) {
            throw new InvalidPersonException(sprintf('Invalid title of %s given', $data[0]));
        }

        if ($this->hasInitial($data)) {
            $this->initial = $this->getFirstLetterOfString($data[1]);
        }

        if ($this->hasFirstName($data)) {
            $this->firstName = $data[1];
        }

        $this->title = $data[0];
        $this->lastName = end($data);
    }

    private function hasFirstName(array $data): bool
    {
        return count($data) > 2 && $data[1] !== $this->getFirstLetterOfString($data[1]);
    }

    private function hasInitial(array $data): bool
    {
        return count($data) > 2 && $data[1] === $this->getFirstLetterOfString($data[1]);
    }

    private function isTitleValid(array $data): bool
    {
        return in_array($data[0], $this->titles, true);
    }

    private function hasRequiredFields(array $data): bool
    {
        return count($data) > 1;
    }

    private function getFirstLetterOfString(string $string): string
    {
        return $string[0] . '.';
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'first_name' => $this->firstName,
            'initial' => $this->initial,
            'last_name' => $this->lastName,
        ];
    }
}
