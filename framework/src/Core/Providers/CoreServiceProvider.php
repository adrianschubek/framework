<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 * https://framework.adriansoftware.de
 */

namespace Framework\Core\Providers;


use Framework\Core\ServiceProvider;
use Framework\Database\Database;
use Framework\Http\Request;
use Framework\Http\RequestInterface;
use Framework\Http\Response;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use Framework\Router\Router;
use Framework\Session\Session;
use Phpfastcache\CacheManager;
use Phpfastcache\Config\ConfigurationOption;
use Phpfastcache\Helper\Psr16Adapter;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\create;
use function DI\get;

class CoreServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->registerArray([
            Logger::class => function () {
                $loggerFactory = cfg("debug.logger");
                return (new $loggerFactory)->createLogger();
            },
            Environment::class => function () {
                $loader = new FilesystemLoader(ROOT . "/app/Views");
                return new Environment($loader, [
                    "cache" => cfg("cache") ? ROOT . cfg("cache.templates") : false
                ]);
            },
            CacheManager::class => function () {
                CacheManager::setDefaultConfig(new ConfigurationOption([
                    "path" => ROOT . cfg("cache.default")
                ]));
                return CacheManager::getInstance("files");
            },
            RequestInterface::class => autowire(Request::class),
            ResponseInterface::class => autowire(Response::class),
            Session::class => create(Session::class)->constructor(
                cfg("session.name"), cfg("session.lifetime")
            ),
            Database::class => create(Database::class)->constructor(get(Logger::class)),
            Psr16Adapter::class => function () {
                return new Psr16Adapter("Files", new ConfigurationOption([
                    "path" => "cache",
                    "itemDetailedDate" => false
                ]));
            },
            Router::class => autowire(),
        ]);
    }
}