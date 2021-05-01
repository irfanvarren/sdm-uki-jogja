<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$scopes)
    {
        if (! $request->user() || ! $request->user()->token()) {
            throw new AuthenticationException;
        }

        $scopes = [
            'admin',
            'admin-hrd',
            'kepala-unit',
            'user'
        ];

        foreach ($scopes as $scope) {
            if($scope != "user"){
            $scope_guard=$scope;
        }else{
            $scope_guard = 'api';
        }
        $user = $request->user($scope_guard);
            if($user != ""){
            if ($user->tokenCan($scope)) {
              $request->request->add([
                'scope' => $scope
            ]);
              return $next($request);
          }
          }
      }
      return response( array( "message" => "Not Authorized." ), 403 );

        /*if(auth('api')->check()){
            $request->request->add([
                'scope' => 'user'
            ]);
        }else if(auth('admin')->check()){
            $request->request->add([
                 'scope' => 'admin'
             ]);
        }else if(auth('admin-hrd')->check()){
            $request->request->add([
                 'scope' => 'admin-hrd'
             ]);
        }else if(auth('kepala-unit')->check()){
            $request->request->add([
                 'scope' => 'kepala-unit'
             ]);
         }*/

         return $next($request);
     }
 }
