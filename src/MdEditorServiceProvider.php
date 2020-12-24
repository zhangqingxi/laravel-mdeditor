<?php
namespace Qasim\LaravelMdEditor;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;


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
        $this->getEmoji();
    }

    /**
     * get emoji by url
     */
    public function getEmoji()
    {

        $emojis = config('mdeditor.emoji');

        $res = [];

        foreach ($emojis as $emoji){

            $html = strtolower(file_get_contents($emoji['url']));

            foreach ($emoji['category'] as $category){

                preg_match_all($category['content_regex'], $html, $matches);

                if($list = $matches[0][0]){

                    preg_match_all($category['list_regex'], $list, $matches);

                    if($matches[1]){

                        if($category['name']) {

                            $res[$emoji['name']][] = ['category' => $category['name'], 'list' => $matches[1]];

                        }else{

                            $res[$emoji['name']] = $matches[1];

                        }

                    }

                }

            }

        }

        $emoji_json = file_get_contents(__DIR__.'/../assets/plugins/emoji-dialog/emoji.json');

        $emoji_json = json_decode($emoji_json, true);

        $emoji_json = $res + $emoji_json;

        file_put_contents(__DIR__.'/../assets/plugins/emoji-dialog/emoji.json', json_encode($emoji_json));

    }

    /**
     * 注册路由
     * @param $router
     */
    protected function registerRoute($router)
    {
        if (!$this->app->routesAreCached()) {
            $router->group(['namespace' => __NAMESPACE__], function ($router) {
                $router->any(config('mdeditor.config.imageUploadURL'), 'MdEditorController@serve');
            });
        }
    }

}
