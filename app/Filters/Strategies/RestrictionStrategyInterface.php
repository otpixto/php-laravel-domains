<?php

namespace App\Filters\Strategies;

use App\Models\Domain;
use App\Request;

interface RestrictionStrategyInterface
{
	public function isRestricted(Request $request, Domain $domain): bool;
}