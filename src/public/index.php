<?php


use DI\Container;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

require dirname (__DIR__, 2) .'/vendor/autoload.php';

$container = new Container();
AppFactory::setContainer($container);


$app = AppFactory::create();
$container = $app->getContainer();

$twig = Twig::create('../views', ['cache' => false]);


$app->add(TwigMiddleware::create($app, $twig));
$app->addRouttingMiddleWare();

$errorMidleware = $app->addErrorMiddleware(true, true ,true);
$app->get('/assets/{file}', function (Request $request , Response $response, $args){
    $response->getBody()->write(file_get_contents(__DIR__ .'/public/views'.$args['file']));
});

$menuItems = array("telegram", "whatsapp", "instagram", "e-mail");

echo "<nav>";
echo "<ul class=\"menu\">";

for ($i = 0; $i < count($menuItems); $i++) {
    echo "<li><a class=\"menu__line\" href=\"\">" . $menuItems[$i] . "</a></li>";
}
echo "</ul>";
echo "</nav>";
$app->run();