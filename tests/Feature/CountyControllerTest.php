<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use app\Models\County;
use app\Models\User;

class CountyControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_index_returns_counties()
    {
        County::factory()->create(['name'=>'Pest']);
        County::factory()->create(['name'=>'Baranya']);
        $response=$this->getJson('/api/counties');
        $response->assertStatus(200)
        ->assertJsonFragment(['name'=>'Pest'])
        ->assertJsonFragment(['name'=>'Baranya']);
    }
    public function test_store_creates_new_county()
    {
        $user=User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $response = $this->withHeaders([
            'Authorization'=> 'Bearer'.$token,
        ])->postJson('/api/counties',[
            'name' =>'Somogy'
        ]);

        $response->assertStatus(201)->assertJsonFragment(['name'=>'Somogy']);
        $this->assertDatabaseHas('counties',['name' =>'Somogy']);
    }
    public function test_update_modifies_existing_county(){
        $county = County::factory()->create(['name'=>'Heves']);
        $response = $this->putJson("/api/counties/{$county->id}",['name'=>'Nógrád']);
        $response->assertStatus(200)->assertJsonFragment(['name'=>'Nógrád']);
        $this->assertDatabaseHas('counties', ['id'=>$county->id, 'name'=>'Nógrád']);
    }
}
