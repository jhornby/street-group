<?php

namespace Tests\Domain;

use App\Domain\Person\Factory\SinglePersonFactory;
use App\Domain\Person\Factory\TwoPersonFactory;
use App\Domain\Person\PeopleCollection;
use App\Domain\Person\PersonMapper;
use Tests\TestCase;

class PeopleCollectionTest extends TestCase
{
    public function testFromCsv_givenAValidCsv_peopleReturnedInCorrectFormat()
    {
        $fp = fopen(__DIR__ . '/../../stubs/people.csv', 'rb+');

        $peopleCollection = $this->getPeopleCollection();

        $collection = $peopleCollection->fromCsv($fp);

        fclose($fp);

        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Smith',
            ],
            [
                'title' => 'Mr',
                'first_name' => 'Tom',
                'initial' => null,
                'last_name' => 'Staff',
            ],
            [
                'title' => 'Mr',
                'first_name' => 'John',
                'initial' => null,
                'last_name' => 'Doe',
            ],
            [
                'title' => 'Dr',
                'first_name' => 'Joe',
                'initial' => null,
                'last_name' => 'Bloggs',
            ],
            [
                'title' => 'Mrs',
                'first_name' => 'Joe',
                'initial' => null,
                'last_name' => 'Bloggs',
            ],
        ], $collection->flatten());
    }

    public function testFromCsv_givenANonResoruceType_invalidArgumentException()
    {
        $this->expectException(\InvalidArgumentException::class);

        $peopleCollection = $this->getPeopleCollection();
        $peopleCollection->fromCsv('not a resource');
    }

    private function getPeopleCollection()
    {
        return new PeopleCollection(
            new PersonMapper(
                [
                    new SinglePersonFactory(),
                    new TwoPersonFactory(),
                ]
            )
        );
    }
}
