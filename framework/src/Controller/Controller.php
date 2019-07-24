<?php
/**
 * Copyright (c) 2019. Adrian Schubek.
 */

namespace Framework\Controller;

use BadMethodCallException;
use DI\Annotation\Inject;
use DI\Container;
use Framework\Http\RequestInterface;
use Framework\Http\ResponseInterface;
use Framework\Logger\Logger;
use Framework\Middleware\Middleware;
use Twig\Environment;

abstract class Controller
{
    /** @var Middleware[] */
    protected $beforeMiddleware = [];

    /** @var Middleware[] */
    protected $afterMiddleware = [];

    /** @var Middleware[] */
    protected $finallyMiddleware = [];

    /**
     * @Inject
     * @var Logger
     */
    protected $logger;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @Inject
     * @var Container
     */
    protected $container;

    /**
     * @Inject
     * @var Environment
     */
    private $view;

    public function __construct()
    {
    }

    final public function render(string $template, array $data = [])
    {
//        $this->logger->debug(sprintf("-> %s(\"%s\", %s)", __METHOD__, $template, json_encode($data)));
        return $this->view->render($template . ".twig", $data);
    }

    /**
     * @param Middleware $middleware
     */
    final public function registerMiddleware(Middleware $middleware)
    {
        $type = $middleware->type;
        switch (strtolower($type)) {
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
            if ($m->process($this->request, $this->response) === false) {
                $this->sendResponse();
                die;
            }
        }
    }

    final public function sendResponse()
    {
        $this->runAfter();
        $this->response->send();
    }

    final public function runAfter()
    {
        foreach ($this->afterMiddleware as $m) {
            if ($m->process($this->request, $this->response) === false) {
                $this->sendResponse();
                die;
            }
        }
    }

    final public function finally()
    {
        foreach ($this->finallyMiddleware as $m) {
            if ($m->process($this->request, $this->response) === false) {
                $this->sendResponse();
                die;
            }
        }
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