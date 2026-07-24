<?php

namespace Laramin\Utility;

use Closure;

class Utility{

    public function handle($request, Closure $next)
    {
        if (!Helpmate::sysPass()) {
            return redirect()->route(VugiChugi::acRouter());
        }
        abort_if(Helpmate::sysPass() === 99 && request()->isMethod('post'),401);
        return $next($request);
    }
}
