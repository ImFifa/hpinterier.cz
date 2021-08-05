<?php declare(strict_types = 1);

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;

class RouterFactory
{

	use Nette\StaticClass;

	public static function createRouter(): Nette\Routing\Router
	{
		$router = new RouteList();

		$router->withModule('Admin')
			->addRoute('admin/<presenter>/<action>[/<id>]', 'Homepage:default');

		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]', 'Homepage:default');
		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]kontakt', 'Homepage:contact');

		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]nabizime', 'Offer:default');
		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]nabizime/kancelarsky-nabytek-a-zidle', 'Offer:office');
		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]nabizime/prodej-a-pokladka-podlah', 'Offer:floor');
		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]nabizime/prodej-a-montaz-stinici-techniky', 'Offer:louver');

		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]realizace', 'Realization:default');
		$router->withModule('Front')->addRoute('[<lang=cs (cs)>/]realizace/<slug>', 'Realization:show');

		$router->withModule('Front')->addRoute('[<lang=cs [a-z]{2}>/]<presenter>/<action>', 'Error:404');
		return $router;
	}

}
