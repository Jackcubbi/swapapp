<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HandleCors
{
  public function handle(Request $request, Closure $next)
  {
    if ($request->isMethod('OPTIONS')) {
      return response()->json([], 200, [
        'Access-Control-Allow-Origin' => 'http://localhost:5173',
        'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
        'Access-Control-Allow-Headers' => 'Content-Type, Authorization, X-Requested-With, Accept, Origin',
        'Access-Control-Allow-Credentials' => 'true',
        'Access-Control-Max-Age' => '86400',
      ]);
    }

    $response = $next($request);

    return $response
      ->header('Access-Control-Allow-Origin', 'http://localhost:5173')
      ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
      ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With, Accept, Origin')
      ->header('Access-Control-Allow-Credentials', 'true');
  }
}
