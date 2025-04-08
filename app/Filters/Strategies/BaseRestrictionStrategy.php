<?php

namespace App\Filters\Strategies;

use App\Enums\DomainRestrictionType;
use App\Models\Domain;
use App\Models\DomainRestrictionRule;
use App\Request;

abstract class BaseRestrictionStrategy implements RestrictionStrategyInterface
{
	abstract protected function getType(): DomainRestrictionType;

	abstract protected function checkRestriction(Request $request, DomainRestrictionRule $rule): bool;

	public function isRestricted(Request $request, Domain $domain): bool
	{
		$rules = DomainRestrictionRule::where('domain_id', $domain->id)
			->where('type', $this->getType()->value)
			->get();

		foreach ($rules as $rule) {
			if ($this->checkRestriction($request, $rule)) {
				return true;
			}
		}

		return false;
	}
}