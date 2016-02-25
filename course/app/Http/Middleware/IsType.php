<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

abstract class IsType {

	/**
	 * @var Guard
	 */

	private $auth;

	public function __construct(Guard $auth){
		$this->auth = $auth;
	}

	abstract public function getType();

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		
		if ( ! $this->auth->user()->is($this->getType())) {
			
			if ($request->ajax())
			{
				return response('Unauthorized.', 401);
			}
			else
			{
				return redirect()->to('home');
			}
		}

		return $next($request);
	}

}
