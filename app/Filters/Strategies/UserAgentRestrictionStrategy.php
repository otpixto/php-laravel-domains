<?php

namespace App\Filters\Strategies;

use App\Enums\DomainRestrictionType;
use App\Models\DomainRestrictionRule;
use App\Request;

class UserAgentRestrictionStrategy extends BaseRestrictionStrategy
{
	protected function getType(): DomainRestrictionType
	{
		return DomainRestrictionType::USER_AGENT;
	}

	protected function checkRestriction(Request $request, DomainRestrictionRule $rule): bool
	{
		$userAgent = $request->header('User-Agent', '');
		return stripos($userAgent, $rule->value) !== false;
	}
}