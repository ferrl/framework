<?php

namespace Ferrl\Modular;

use Doctrine\Common\Inflector\Inflector;
use Ferrl\Contracts\Modular\ModuleDefinition as ModuleDefinitionContract;
use Illuminate\Routing\Router;
use Illuminate\View\Factory as View;

class ModuleDefinition implements ModuleDefinitionContract
{
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
     * ModuleDefinition constructor.
     *
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * Get module folder full path.
     *
     * @return string
     */
    protected function getModulesFolder()
    {
        if (! $this->path) {
            $inflector = new Inflector();
            $this->path = realpath(config('modules.path').'/'.$inflector->classify($this->name));
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
            $this->namespace = config('modules.namespace').'\\'.$inflector->classify($this->name);
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
            $this->prefix = $inflector->tableize($this->name);
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
        $router = app(Router::class);
        $routesFile = realpath($this->getModulesFolder().'/routes.php');

        if (file_exists($routesFile)) {
            $namespace = $this->getModulesNamespace().'\\Controllers';

            $router->group(compact('namespace'), function () use ($routesFile) {
                require_once $routesFile;
            });
        }
    }

    /**
     * Load views folder if exists.
     *
     * @return void
     */
    protected function loadViews()
    {
        /** @var View $view */
        $view = app(View::class);
        $viewsFolder = realpath($this->getModulesFolder().'/Views');

        if (file_exists($viewsFolder)) {
            $view->addNamespace($this->getModulesPrefix(), $viewsFolder);
        }
    }
}
