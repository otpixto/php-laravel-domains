<?php

namespace Database\Factories;

use App\Enums\DomainRestrictionType;
use App\Models\Domain;
use App\Models\DomainRestrictionRule;
use Illuminate\Database\Eloquent\Factories\Factory;

class DomainRestrictionRuleFactory extends Factory
{
	protected $model = DomainRestrictionRule::class;

	public function definition(): array
	{
		return [
			'domain_id' => Domain::factory(),
			'type' => $this->faker->randomElement(DomainRestrictionType::values()),
			'value' => $this->faker->word,
			'description' => $this->faker->sentence,
		];
	}

	public function ipRestriction(): self
	{
		return $this->state([
			'type' => DomainRestrictionType::IP->value,
			'value' => $this->faker->ipv4,
		]);
	}

	public function userAgentRestriction(): self
	{
		return $this->state([
			'type' => DomainRestrictionType::USER_AGENT->value,
			'value' => $this->faker->userAgent,
		]);
	}
}
