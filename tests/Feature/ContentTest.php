<?php

namespace Tests\Feature\Api;

use App\Models\Domain;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function it_shows_no_content_when_there_is_no_domain(): void
    {
        $domain = Domain::factory()->make();

        $response = $this->get("http://{$domain->name}/");

        $response->assertSee('no content');
        $response->assertDontSee($domain->name);
    }

    /**
     * @test
     */
    public function it_shows_domain_name_when_there_is_domain(): void
    {
        $domain = Domain::factory()->create();

        $response = $this->get("http://{$domain->name}/");

        $response->assertSee($domain->name);
        $response->assertDontSee('no content');
    }
}
