<?php

if (!function_exists('editor_css')) {
    /**
     * css文件
     * @return string
     */
    function editor_css(): string
    {

        return '<!--editor.md css-->
            <link rel="stylesheet" href="/vendor/mdeditor/css/editormd.preview.min.css" />
            <link rel="stylesheet" href="/vendor/mdeditor/css/editormd.min.css" />
            <style type="text/css">
            .editormd-fullscreen {
                z-index: 2147483647;
            }
            </style>';

    }

}

if (!function_exists('editor_js')) {

    /**
     * js 文件
     * @return string
     */
    function editor_js(): string
    {

        $lang_js = '';

        if (strtolower(app()->getLocale()) == 'en') {
            $lang_js = '<script src="/vendor/mdeditor/languages/en.js"></script>';
        } elseif (strtolower(app()->getLocale()) == 'zh-tw') {
            $lang_js = '<script src="/vendor/mdeditor/languages/zh-tw.js"></script>';
        }

        return '<!--editor.md js-->
                <script src="//cdn.bootcdn.net/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <script src="/vendor/mdeditor/js/editormd.js"></script>
                ' . $lang_js;

    }

}
