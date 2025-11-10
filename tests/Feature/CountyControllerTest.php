<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\County;
use App\Models\User;

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
            'Authorization'=> 'Bearer '.$token,
        ])->postJson('/api/counties',[
            'name' =>'Somogy'
        ]);

        $response->assertStatus(201)->assertJsonFragment(['name'=>'Somogy']);
        $this->assertDatabaseHas('counties',['name' =>'Somogy']);
    }
    public function test_update_modifies_existing_county(){
        $user=User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $county = County::factory()->create(['name'=>'Heves']);
        $response = $this->withHeaders([
            'Authorization'=> 'Bearer '.$token,
        ])->putJson("/api/counties/{$county->id}",['name'=>'Nógrád']);
        $response->assertStatus(200)
            ->assertJsonFragment(['name'=>'Nógrád'])
            ->assertJsonFragment(['message' => 'County updated successfully']);
        $this->assertDatabaseHas('counties', ['id'=>$county->id, 'name'=>'Nógrád']);
    }
    public function test_delete_removes_county(){
        
        $user=User::factory()->create();
        $token = $user->createToken('TestToken')->plainTextToken;

        $county = County::factory()->create(['name'=>"Vas"]);
        $response = $this->withHeaders([
            'Authorization'=> 'Bearer '.$token,
        ])->deleteJson("/api/counties/{$county->id}");
        $response->assertStatus(410)->assertJsonFragment(['message'=>"County deleted successfully"]);
        $this->assertDatabaseMissing('counties',['id'=>$county->id]);
    }
}
