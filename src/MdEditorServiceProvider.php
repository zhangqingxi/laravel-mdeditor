<?php
namespace Qasim\LaravelMdEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Qasim\LaravelMdEditor\Console\EmojisCommand;

class MdEditorServiceProvider extends ServiceProvider
{

    public function boot(Router $router)
    {
        //视图
        $this->loadViewsFrom(__DIR__ . '/../views', 'mdeditor');
        $this->loadTranslationsFrom(__DIR__ . '/../translations', 'mdeditor');

        $this->publishes([
            __DIR__.'/../views' => base_path('resources/views/vendor/mdeditor'),
            __DIR__.'/../translations' => base_path('resources/lang/vendor/mdeditor'),
        ], 'resources');


        $this->publishes([
            __DIR__.'/../config/mdeditor.php' => config_path('mdeditor.php'),
        ], 'config');

        //公共资源
        $this->publishes([
            __DIR__.'/../assets' => public_path('vendor/mdeditor'),
        ], 'assets');

        //路由
        $this->registerRoute($router);

    }

    /**
     * Register any application services.
     */
    public function register()
    {

        $this->mergeConfigFrom(__DIR__.'/../config/mdeditor.php', 'mdeditor');

        $this->app->singleton(
            'command.mdeditor.emojis',
            function () {
                return new EmojisCommand();
            }
        );
        $this->commands(
            'command.mdeditor.emojis'
        );

    }

    /**
     * 注册路由
     * @param $router
     */
    protected function registerRoute($router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group(['namespace' => __NAMESPACE__], function ($router) {
                $router->any(config('mdeditor.config.imageUploadURL'), 'MdEditorController@upload');
            });
        }
    }

}
