# Laravel-Mdeditor
[editor.md](https://github.com/barryvdh/laravel-ide-helper) for laravel markdown editor

# 版本
laravel 版本7.x以上 （7.x以下没有测试过）

PHP 版本7.x以上

# 安装
    ```shell
    $ composer require qasim/laravel-mdeditor:~1.0
    ```

# 配置
1. 发布配置文件和资源
    ```shell
    $ php artisan vendor:publish --provider='Qasim\LaravelMdEditor\MdEditorServiceProvider'
    ```
2. 模板引入编辑器
    ```php
    @include('vendor.mdeditor.assets')
    ```

3. 编辑器使用
    ```html
    <div id="编辑器ID"></div>

    <script>
        let mdeditor = editormd("编辑器ID", mdeditor_config)
        <!-- 编辑器内容赋值 -->
        mdeditor.markdownTextarea.val('')
    </script>
   ```

# 其他
1. 更新emoji
   ```shell
   $ php artisan mdeditor:emojis
   ```
2. 创建软连接
   ```shell
   $ php artisan storage:link
   ```


