<?php

namespace Tests\Unit;

use App\Helpers\HomeOwnerNamesHelper;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeOwnerNamesHelperTest extends TestCase
{
    /**
     * Tests that the getHomeOwnerDetails method returns the expected output when provided with a home owner name.
     */
    public function testGetHomeOwnerDetailsMethodReturnsExpectedOutput()
    {
        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ],
            [
                'title' => 'Mrs',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Smith'
            ]
        ], HomeOwnerNamesHelper::getHomeOwnerDetails('Mr & Mrs Smith'));

        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => 'Tom',
                'initial' => 'L.',
                'last_name' => 'Staff'
            ],
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'J',
                'last_name' => 'Doe'
            ]
        ], HomeOwnerNamesHelper::getHomeOwnerDetails('Mr Tom L. Staff and Mr J Doe'));

        $this->assertEquals([
            [
                'title' => 'Dr',
                'first_name' => null,
                'initial' => null,
                'last_name' => 'Bloggs'
            ],
            [
                'title' => 'Mrs',
                'first_name' => 'Joe',
                'initial' => null,
                'last_name' => 'Bloggs'
            ]
        ], HomeOwnerNamesHelper::getHomeOwnerDetails('Dr and Mrs Joe Bloggs'));

        $this->assertEquals([
            [
                'title' => 'Mr',
                'first_name' => null,
                'initial' => 'A.',
                'last_name' => 'Owen'
            ]
        ], HomeOwnerNamesHelper::getHomeOwnerDetails('Mr A. Owen'));
    }


    /**
     * Tests that the splitHomeOwners method splits out home owner names correctly if there is more than one name
     * present in the string provided.
     */
    public function testSplitHomeOwnersReturnsExpectedResult()
    {
        $this->assertEquals(['Mr', 'Mrs Smith'], HomeOwnerNamesHelper::splitHomeOwners('Mr & Mrs Smith'));
        $this->assertEquals(['Mr Tom Staff', 'Mr John Doe'], HomeOwnerNamesHelper::splitHomeOwners('Mr Tom Staff and Mr John Doe'));
        $this->assertEquals(['Mrs Jane Smith'], HomeOwnerNamesHelper::splitHomeOwners('Mrs Jane Smith'));
    }

    /**
     * Tests that the isInitial method returns true when a valid initial is provided.
     */
    public function testIsInitialMethodRecognisesValidInitial()
    {
        $this->assertTrue(HomeOwnerNamesHelper::isInitial('A'));
        $this->assertTrue(HomeOwnerNamesHelper::isInitial('J.'));
        $this->assertTrue(HomeOwnerNamesHelper::isInitial(' H.'));
    }

    /**
     * Tests that the isInitial method returns false when an invalid initial is provided.
     */
    public function testIsInitialMethodRecognisesInvalidInitial()
    {
        $this->assertFalse(HomeOwnerNamesHelper::isInitial('Alex'));
        $this->assertFalse(HomeOwnerNamesHelper::isInitial('H H'));
        $this->assertFalse(HomeOwnerNamesHelper::isInitial('2.'));
    }

    /**
     * Tests that the getNameComponents method returns the expected output with the name components in the correct places.
     */
    public function testGetNameComponentsReturnsCorrectResult()
    {
        $this->assertEquals([
            'title' => 'Mrs',
            'first_name' => 'Faye',
            'initial' => null,
            'last_name' => 'Hughes-Eastwood'
        ], HomeOwnerNamesHelper::getNameComponents('Mrs Faye Hughes-Eastwood'));

        $this->assertEquals([
            'title' => 'Dr',
            'first_name' => null,
            'initial' => 'P',
            'last_name' => 'Gun'
        ], HomeOwnerNamesHelper::getNameComponents('Dr P Gun'));

        $this->assertEquals([
            'title' => 'Mr',
            'first_name' => 'Alex',
            'initial' => 'M.',
            'last_name' => 'Owen'
        ], HomeOwnerNamesHelper::getNameComponents('Mr Alex M. Owen'));

        $this->assertEquals([
            'title' => 'Mrs',
            'first_name' => null,
            'initial' => null,
            'last_name' => null
        ], HomeOwnerNamesHelper::getNameComponents('Mrs'));
    }
}
