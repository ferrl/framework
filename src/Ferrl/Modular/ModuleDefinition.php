<?php

namespace Ferrl\Modular;

use Doctrine\Common\Inflector\Inflector;
use Ferrl\Contracts\Modular\ModuleDefinition as ModuleDefinitionContract;
use Illuminate\Routing\Router;
use Illuminate\View\Factory as View;

abstract class ModuleDefinition implements ModuleDefinitionContract
{
    /**
     * Laravel's container instance.
     *
     * @var \Illuminate\Foundation\Application
     */
    protected $app;

    /**
     * Name of the module.
     *
     * @var string
     */
    protected $name;

    /**
     * Full path of the module.
     *
     * @var string
     */
    protected $path;

    /**
     * Full namespace of the module.
     *
     * @var string
     */
    protected $namespace;

    /**
     * Namespace prefix for the module.
     *
     * @var string
     */
    protected $prefix;

    /**
     * Should create simple {controller}/{action} routes.
     *
     * @var bool
     */
    protected $simpleRouting = false;

    /**
     * ModuleDefinition constructor.
     *
     * @param \Illuminate\Foundation\Application|null $app
     * @param string $name
     */
    public function __construct($app = null, $name = null)
    {
        $this->app = $app ?: app();
        $this->name = $this->name ?: $name;
    }

    /**
     * Bootstrap a new module.
     *
     * @return bool
     */
    public function bootstrap()
    {
        $this->loadHelpers();
        $this->loadRoutes();
        $this->loadViews();
    }

    /**
     * Get module name.
     *
     * @return string
     */
    protected function getName()
    {
        return $this->name;
    }

    /**
     * Get module folder full path.
     *
     * @return string
     */
    protected function getModulesFolder()
    {
        if (! $this->path) {
            $inflector = new Inflector();
            $this->path = realpath(config('modules.path').'/'.$inflector->classify($this->getName()));
        }

        return $this->path;
    }

    /**
     * Get module full namespace.
     *
     * @return string
     */
    protected function getModulesNamespace()
    {
        if (! $this->namespace) {
            $inflector = new Inflector();
            $this->namespace = config('modules.namespace').'\\'.$inflector->classify($this->getName());
        }

        return $this->namespace;
    }

    /**
     * Get module full namespace.
     *
     * @return string
     */
    protected function getModulesPrefix()
    {
        if (! $this->prefix) {
            $inflector = new Inflector();
            $this->prefix = $inflector->tableize($this->getName());
        }

        return $this->prefix;
    }

    /**
     * Load helpers file if exists.
     *
     * @return void
     */
    protected function loadHelpers()
    {
        $helpersFile = $this->getModulesFolder().'/helpers.php';

        if (file_exists($helpersFile)) {
            require_once $helpersFile;
        }
    }

    /**
     * Load routes file if exists.
     *
     * @return void
     */
    protected function loadRoutes()
    {
        /** @var Router $router */
        $router = $this->app->make(Router::class);
        $namespace = $this->getModulesNamespace().'\\Controllers';

        $router->group(compact('namespace'), function () use ($router) {
            $this->bindRoutes($router);
        });
    }

    /**
     * Load views folder if exists.
     *
     * @return void
     */
    protected function loadViews()
    {
        /** @var View $view */
        $view = $this->app->make(View::class);
        $viewsFolder = realpath($this->getModulesFolder().'/Views');

        if (file_exists($viewsFolder)) {
            $view->addNamespace($this->getModulesPrefix(), $viewsFolder);
        }
    }

    /**
     * Bind application routes.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    abstract public function bindRoutes(Router $router);
}
