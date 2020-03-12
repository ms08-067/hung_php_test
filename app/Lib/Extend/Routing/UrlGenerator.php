<?php namespace Extend\Routing;

use Illuminate\Routing\UrlGenerator as IlluminateUrlGenerator;

class UrlGenerator extends IlluminateUrlGenerator
{
	/**
	 * Get the URL to a named route.
	 *
	 * @param  string  $name
	 * @param  mixed   $parameters
	 * @param  bool  $absolute
	 * @param  \Illuminate\Routing\Route  $route
	 * @return string
	 *
	 * @throws \InvalidArgumentException
	 */
	public function route($name, $parameters = array(), $absolute = true, $route = null)
	{
		$fullURL 	= $this->full();
		$parameters = (array) $parameters;

		if(strpos($fullURL, 'popup=1') && !isset($parameters['no-popup']))
		{
			$parameters['popup'] = 1;
		}
		
		if(strpos($fullURL, 'popup=2') && !isset($parameters['no-popup']))
		{
			$parameters['popup'] = 2;
		}
		
		if(strpos($fullURL, 'mobile=1'))
		{
			$parameters['mobile'] = 1;
		}

		return parent::route($name, $parameters, $absolute, $route);
	}
}