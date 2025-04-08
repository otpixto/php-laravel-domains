<?php

namespace Database\Seeders;

use App\Enums\DomainRestrictionType;
use App\Models\Domain;
use App\Models\DomainRestrictionRule;
use Illuminate\Database\Seeder;

class DomainRestrictionsRulesSeeder extends Seeder
{
	public function run(): void
	{
		$domain = Domain::firstOrCreate(['name' => 'localhost']);

		DomainRestrictionRule::create([
			'domain_id' => $domain->id,
			'type' => DomainRestrictionType::IP->value,
			'value' => '192.168.1.1',
			'description' => 'Block specific IP'
		]);

		DomainRestrictionRule::create([
			'domain_id' => $domain->id,
			'type' => DomainRestrictionType::USER_AGENT->value,
			'value' => 'Chrome',
			'description' => 'Block Chrome'
		]);
	}
}