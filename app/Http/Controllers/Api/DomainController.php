<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Domain::class);
    }

    public function update(Request $request, Domain $domain)
    {
        $domain->update([
            'name' => $request->post('name'),
        ]);

        return $domain;
    }
}
