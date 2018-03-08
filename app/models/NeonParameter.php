<?php

declare(strict_types=1);

namespace App\Models;

use Nette;


/**
 * Class NeonParameter
 * @package App\Models
 */
class NeonParameter
{

	/**
	 * @param Nette\DI\Container $container
	 * @param string|null        $parameterPath
	 * @return mixed
	 * @throws \Exception
	 */
	public static function get(Nette\DI\Container $container, string $parameterPath = null)
	{
		try {
			$parameters = $container->getParameters();

			if ($parameterPath) {
				$parameterPathArray = explode(':', $parameterPath);

				foreach ($parameterPathArray as $parameter) {
					if (!isset($parameters[$parameter])) {
						return null;
					}
					$parameters = $parameters[$parameter];
				}

				$parameterValue = $parameters;
			} else {
				$parameterValue = $parameters;
			}

			return $parameterValue;
		} catch (\Exception $e) {
			throw $e;
		}
	}

}
