<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Controller;

use BadMethodCallException;
use DI\Container;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use Framework\Middleware\MiddlewareInterface;
use Twig\Environment;

abstract class Controller
{
    protected $logger;
    /** @var MiddlewareInterface[] */
    protected $beforeMiddleware = [];
    /** @var MiddlewareInterface[] */
    protected $afterMiddleware = [];
    /** @var MiddlewareInterface[] */
    protected $finallyMiddleware = [];
    protected $request;
    protected $response;
    protected $container;
    private $view;

    public function __construct(RequestInterface $request, ResponseInterface $response, Logger $logger, Environment $twig, Container $container)
    {
        $this->logger = $logger;
        $this->view = $twig;
        $this->response = $response;
        $this->request = $request;
        $this->container = $container;
        $this->logger->info("Request: --> " . ($request->getUrl() !== "") ?: "(cli)");
    }

    final public function render(string $template, array $data = [])
    {
//        $this->logger->debug(sprintf("-> %s(\"%s\", %s)", __METHOD__, $template, json_encode($data)));
        $this->runAfter();
        return $this->view->render($template . ".twig", $data);
    }

    final public function runAfter()
    {
        foreach ($this->afterMiddleware as $m) {
            $this->response = $m->process($this->request, $this->response);
        }
//        var_dump("After");
    }

    final public function registerMiddleware(MiddlewareInterface $middleware, string $type)
    {
        switch ($type) {
            default:
            case "before":
                $this->beforeMiddleware[] = $middleware;
                break;
            case "after":
                $this->afterMiddleware[] = $middleware;
                break;
            case "finally":
                $this->finallyMiddleware[] = $middleware;
                break;
        }
    }

    final public function runBefore()
    {
        foreach ($this->beforeMiddleware as $m) {
            $this->response = $m->process($this->request, $this->response);
        }
//        var_dump("runBefore");
    }

    final public function finally()
    {
        foreach ($this->finallyMiddleware as $m) {
            $this->response = $m->process($this->request, $this->response);
        }
//        var_dump("Finally");
    }

    final public function __call($name, $arguments)
    {
        $msg = sprintf(
            'Method %s::%s does not exist.', self::class, $name
        );
        $this->logger->error($msg);
        throw new BadMethodCallException($msg);
    }
}