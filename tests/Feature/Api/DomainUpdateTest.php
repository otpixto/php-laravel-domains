<?php

namespace Tests\Feature\Api;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DomainUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_updates_domain_name(): void
    {
        $this->actingAs(User::factory()->create());

        $domain = Domain::factory()->create();

        $response = $this->putJson("/api/domains/{$domain->id}", [
            'name' => Domain::factory()->make()->name,
        ]);

        $response->assertStatus(200);
    }
}
