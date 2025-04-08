<?php

namespace App\Http\Middleware;

use App\Filters\DomainRestrictionFilter;
use App\Models\Domain;
use App\Request;
use Closure;

use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class DomainRestrictionMiddleware
{
	public function __construct(
		private readonly DomainRestrictionFilter $filter
	) {}

	public function handle(Request $request, Closure $next): Response
	{
		$domain = $request->domain();

		if (!$domain) {
			abort(404, 'Domain not found');
		}

		if ($this->filter->isRestricted($request, $domain)) {
			$this->logRestrictedAccess($request, $domain);
			abort(403, 'Access restricted');
		}

		return $next($request);
	}

	private function logRestrictedAccess(Request $request, Domain $domain): void
	{
		Log::warning('Access restricted', [
			'domain' => $domain->name,
			'ip' => $request->ip(),
			'user_agent' => $request->userAgent(),
			'time' => now(),
		]);
	}
}