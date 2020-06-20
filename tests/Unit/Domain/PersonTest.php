<?php

namespace Tests\Domain;

use App\Domain\Person\InvalidPersonException;
use App\Domain\Person\Person;
use Tests\TestCase;

class PersonTest extends TestCase
{
    public function testPerson_givenPersonWithTitleFirstNameAndLastName_titleFirstNameAndLastNameSet()
    {
        $person = new Person('Mr John Smith');

        $expected = [
            'title' => 'Mr',
            'initial' => null,
            'first_name' => 'John',
            'last_name' => 'Smith',
        ];

        $this->assertEquals($person->toArray(), $expected);
    }

    public function testPerson_givenPersonWithTitleAndLastName_titleAndLastNameSet()
    {
        $person = new Person('Mr Smith');

        $expected = [
            'title' => 'Mr',
            'initial' => null,
            'first_name' => null,
            'last_name' => 'Smith',
        ];

        $this->assertEquals($person->toArray(), $expected);
    }

    public function testPerson_givenPersonWithTitleInitialAndLastName_titleInitialLastNameSet()
    {
        $person = new Person('Dr P. Smith');

        $expected = [
            'title' => 'Dr',
            'initial' => 'P.',
            'first_name' => null,
            'last_name' => 'Smith',
        ];

        $this->assertEquals($person->toArray(), $expected);
    }

    public function testPerson_givenPersonWithInvalidTitle_invalidPersonException()
    {
        $this->expectException(InvalidPersonException::class);

        new Person('Fake P. Smith');
    }

    public function testPerson_givenPersonJustATitle_invalidPersonException()
    {
        $this->expectException(InvalidPersonException::class);

        new Person('Mr');
    }
}
