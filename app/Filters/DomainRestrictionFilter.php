<?php

namespace App\Filters;

use App\Filters\Strategies\IpRestrictionStrategy;
use App\Filters\Strategies\UserAgentRestrictionStrategy;
use App\Models\Domain;
use App\Request;

class DomainRestrictionFilter
{
	private array $strategies;

	public function __construct()
	{
		$this->strategies = [
			new IpRestrictionStrategy(),
			new UserAgentRestrictionStrategy(),
		];
	}

	public function isRestricted(Request $request, Domain $domain): bool
	{
		foreach ($this->strategies as $strategy) {
			if ($strategy->isRestricted($request, $domain)) {
				return true;
			}
		}
		return false;
	}
}