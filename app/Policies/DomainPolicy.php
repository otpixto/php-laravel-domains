<?php

namespace App\Policies;

use App\Models\Domain;
use App\Models\User;

class DomainPolicy
{
    public function update(User $user, Domain $domain)
    {
		//dd(111);
        return true;
    }
}
