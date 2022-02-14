<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\ParallelTesting;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Train;
use App\Models\User;
use Tests\TestCase;


class TrainCreationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_insert_train_item()
    {
        // post data to the create train router
        $testLine = 70;
        $testUserId = 1;
        $response = $this
            ->postJson('/api/insertDataWsRelationship', [
                'line' => $testLine,
                'station' => 'Bentley',
                'build_year' => 2008,
                'frequency' => 12,
                'manager' => 'Vanessa',
                'active' => true,
                'userId' => $testUserId
            ]);

        $response
            ->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) =>
                $json->whereAllType([
                        'id' => 'integer',
                        'user_id' => 'integer',
                        'active' => 'boolean',
                    ])
                    ->etc()
            );

        $res = $response->json();
        $dbTrainId = $res['user_id'];
        
        // Check If Item Has Correct Relationship user -> train
        if( $dbTrainId == $testUserId){
            $this->assertTrue(true);
        } else {
            $this->assertTrue(false, 'Token Not In Desired Length Range');
        };
    }
}