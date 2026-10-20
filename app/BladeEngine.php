<?php

namespace App;

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Factory;
use Illuminate\View\FileViewFinder;

class BladeEngine
{
    protected Factory $factory;
    protected BladeCompiler $compiler;

    public function __construct(string $viewsPath, string $cachePath)
    {
        if (!is_dir($cachePath)) {
            mkdir($cachePath, 0777, true);
        }

        $container = new Container();
        $filesystem = new Filesystem();
        $dispatcher = new Dispatcher($container);

        $viewFinder = new FileViewFinder($filesystem, [$viewsPath]);
        $this->compiler = new BladeCompiler($filesystem, $cachePath);
        
        $engineResolver = new EngineResolver();
        $engineResolver->register('blade', function () {
            return new CompilerEngine($this->compiler);
        });

        $this->factory = new Factory($engineResolver, $viewFinder, $dispatcher);
        $this->factory->setContainer($container);

        // Container bindings
        $container->instance('view', $this->factory);
        $container->instance('blade.compiler', $this->compiler);
        $container->instance(\Illuminate\Contracts\View\Factory::class, $this->factory);
    }

    public function render(string $view, array $data = []): string
    {
        return $this->factory->make($view, $data)->render();
    }

    public function getCompiler(): BladeCompiler
    {
        return $this->compiler;
    }
}
