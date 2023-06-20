<?php

namespace App;

use Illuminate\Http\Response;

class HostingRouter
{
    public function handle(Request $request): Response
    {
        $content = $request->domain()?->name ?? 'no content';

        return new Response($content);
    }
}
