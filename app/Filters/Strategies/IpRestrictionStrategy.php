<?php

namespace App\Filters\Strategies;

use App\Enums\DomainRestrictionType;
use App\Models\DomainRestrictionRule;
use App\Request;

class IpRestrictionStrategy extends BaseRestrictionStrategy
{
	protected function getType(): DomainRestrictionType
	{
		return DomainRestrictionType::IP;
	}

	protected function checkRestriction(Request $request, DomainRestrictionRule $rule): bool
	{
		$requestIp = $request->ip();
		$ruleIp = $rule->value;

		if (str_contains($ruleIp, '/')) {
			return $this->checkIpInRange($requestIp, $ruleIp);
		}

		return $requestIp === $ruleIp;
	}

	private function checkIpInRange(string $ip, string $range): bool
	{
		[$subnet, $bits] = explode('/', $range);
		$ipLong = ip2long($ip);
		$subnetLong = ip2long($subnet);
		$mask = -1 << (32 - (int)$bits);

		return ($ipLong & $mask) === ($subnetLong & $mask);
	}
}