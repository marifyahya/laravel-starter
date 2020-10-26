<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Menu;
use Auth;

class PageAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $page)
    {
        $menu = Menu::whereHas('menuRole', function($query){
            $query->where('role_id', Auth::user()->role_id);
        })
        ->where('menu_name', $page)
        ->where('state', '1')
        ->count();
        
        return $menu > 0 ? $next($request) : abort(403);
    }
}
