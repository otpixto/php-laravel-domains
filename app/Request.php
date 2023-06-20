<?php

namespace App;

use App\Models\Domain;
use Illuminate\Http\Request as HttpRequest;

class Request extends HttpRequest
{
    public function domain(): ?Domain
    {
        return Domain::firstWhere('name', $this->getHost());
    }
}
