<?php

namespace Tests\Feature;

use App\Models\Domain;
use App\Models\DomainRestrictionRule;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DomainRestrictionTest extends TestCase
{
	use RefreshDatabase;

	/**
	 * @test
	 */
	public function it_allows_access_when_no_restrictions_exist(): void
	{
		$domain = Domain::factory()->create();

		$response = $this->get("http://{$domain->name}/");

		$response->assertOk();
		$response->assertSee($domain->name);
	}

	/**
	 * @test
	 */
	public function it_restricts_access_by_ip(): void
	{
		$domain = Domain::factory()->create();
		DomainRestrictionRule::factory()
			->ipRestriction()
			->create(['domain_id' => $domain->id, 'value' => '192.168.1.1']);

		$response = $this->withServerVariables(['REMOTE_ADDR' => '192.168.1.1'])
			->get("http://{$domain->name}/");

		$response->assertForbidden();
	}

	/**
	 * @test
	 */
	public function it_allows_access_when_ip_not_restricted(): void
	{
		$domain = Domain::factory()->create();
		DomainRestrictionRule::factory()
			->ipRestriction()
			->create(['domain_id' => $domain->id, 'value' => '192.168.1.1']);

		$response = $this->withServerVariables(['REMOTE_ADDR' => '10.0.0.1'])
			->get("http://{$domain->name}/");

		$response->assertOk();
	}

	/**
	 * @test
	 */
	public function it_restricts_access_by_user_agent(): void
	{
		$domain = Domain::factory()->create();
		DomainRestrictionRule::factory()
			->userAgentRestriction()
			->create(['domain_id' => $domain->id, 'value' => 'BadBot']);

		$response = $this->withHeaders(['User-Agent' => 'BadBot'])
			->get("http://{$domain->name}/");

		$response->assertForbidden();
	}

	/**
	 * @test
	 */
	public function it_allows_access_when_user_agent_not_restricted(): void
	{
		$domain = Domain::factory()->create();
		DomainRestrictionRule::factory()
			->userAgentRestriction()
			->create(['domain_id' => $domain->id, 'value' => 'BadBot']);

		$response = $this->withHeaders(['User-Agent' => 'GoodBot'])
			->get("http://{$domain->name}/");

		$response->assertOk();
	}

	/**
	 * @test
	 */
	public function it_returns_404_for_non_existing_domain(): void
	{
		$response = $this->get("http://nonexistent-domain.test/");

		$response->assertNotFound();
	}
}