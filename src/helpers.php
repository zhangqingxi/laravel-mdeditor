<?php

if (!function_exists('format_json_message')) {
    /**
     * 格式化表单校验消息，并进行json数组化预处理
     *
     * @param array $messages 未格式化之前数组
     * @param array $json 原始json数组数据
     * @return array
     */
    function format_json_message(array $messages, array $json): array
    {
        $reasons = '';
        foreach ($messages->all(':message') as $message) {
            $reasons .= $message . ' ';
        }
        $info = '失败原因为：' . $reasons;
        $json = array_replace($json, ['info' => $info]);
        return $json;
    }


}

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

if (!function_exists('editor_config')) {

    /**
     * 初始化配置js代码
     * @param string $editor_id
     * @return string
     */
    function editor_config($editor_id = 'mdeditor'): string
    {

//        config('mdeditor.config')
//
//        return '<!--editor.md config-->
//                <script type="text/javascript">
//                let _' . $editor_id . ';
//                $(function() {
//                    //修正emoji图片错误
//                    editormd.emoji     = {
//                        path  : "//staticfile.qnssl.com/emoji-cheat-sheet/1.0.0/",
//                        ext   : ".png"
//                    };
//                    _' . $editor_id . ' = editormd({
//                            id : "' . $editor_id . '",
//                            width : "90%",
//                            height : 640,
//                            saveHTMLToTextarea : ' . config('editor.saveHTMLToTextarea') . ',
//                            emoji : ' . config('editor.emoji') . ',
//                            taskList : ' . config('editor.taskList') . ',
//                            tex : ' . config('editor.tex') . ',
//                            toc : ' . config('editor.toc') . ',
//                            tocm : ' . config('editor.tocm') . ',
//                            codeFold : ' . config('editor.codeFold') . ',
//                            flowChart: ' . config('editor.flowChart') . ',
//                            sequenceDiagram: ' . config('editor.sequenceDiagram') . ',
//                            path : "/vendor/editor.md/lib/",
//                            imageUpload : ' . config('editor.imageUpload') . ',
//                            imageFormats : ["jpg", "gif", "png"],
//                            imageUploadURL : "/laravel-editor-md/upload/picture?_token=' . csrf_token() . '&from=laravel-editor-md"
//                    });
//                });
//                </script>';

    }
}
