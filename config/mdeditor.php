<?php
/**
 * @author Qasim <15750783791@163.com>
 * @since https://github.com/zhangqing/laravel-md-editor
 */
return [
    'disk' => 'public',

    'emojis' => [
        'github' => [
            'name' => 'github-emoji',
            'url' => 'https://www.webfx.com/tools/emoji-cheat-sheet/',
            'category' => ['People', 'Nature', 'Objects', 'Places', 'Symbols'],
            'path' => 'https://www.webfx.com/tools/emoji-cheat-sheet/graphics/emojis/',
            'ext' => '.png',
        ],
        'twitter' => [
            'name' => 'twemoji',
            'url' => 'https://twemoji.maxcdn.com/2/test/preview.html',
            'category' => [],
            'path' => 'https://twemoji.maxcdn.com/v/13.0.1/72x72/',
            'ext' => '.png'
        ],
    ],

    // 配置
    'config' => [
        'width' => "100%", //可以是百分比也可以是具体数值
        'height' => '100%',
        'path'  => '/vendor/mdeditor/lib/',
        'theme' => '',
        'editorTheme' => 'default', //编辑器区域内主题
        'previewTheme' => '', //预览区域主题
        'markdown' => '', //编辑器内显示的内容
        'watch' => false, //是否开启实时预览
        'previewCodeHighlight' => true, //预览代码高亮显示
        'delay' => 300, //延迟解析到预览区域 单位ms
        'placeholder' => "Enjoy Markdown! coding now...",
        'gotoLine' => true, //是否开启跳转行
        'codeFold' => true, //是否开启代码折叠
        'autoHeight' => false,
        'autoFocus' => true,
        'autoCloseTags' => true,
        'searchReplace' => true, //是否开启搜索和替换功能
        'syncScrolling' => true, //同步滚动  值true/false/"single"
        'readOnly' => false,
        'tabSize' => 4,
        'indentUnit' => 4,
        'indentWithTabs' => true,
        'lineNumbers' => true, //是否开启行号
        'lineWrapping' => true, //是否开启自动换行
        'autoCloseBrackets' => true,
        'showTrailingSpace' => true,
        'matchBrackets' => true, //是否开启括号匹配提示
        'matchWordHighlight' => true,//匹配词高亮显示
        'styleSelectedText' => true,
        'styleActiveLine' => true,//当前行高亮显示
        'dialogLockScreen' => true, //对话框锁屏
        'dialogShowMask' => true, //对话框遮罩
        'dialogMaskBgColor' => '#fff',//遮罩颜色
        'dialogDraggable' => true,//对话框可拖动
        'dialogMaskOpacity' => 0.1,//遮罩透明度
        'fontSize' => "14px",
        'saveHTMLToTextarea' => true,//保存 HTML 到 Textarea
        'disabledKeyMaps' => [],
        'imageUpload' => true, //是否开启图片上传
        'imageFormats' => ["jpg", "jpeg", "gif", "png", "bmp"],//图片上传格式
        'imageUploadURL' => '/MdEditor/uploadImage',
        'crossDomainUpload' => false, //跨域上传
        'uploadCallbackURL' => "", //跨域上传的url
        'toc' => true,//是否开启目录
        'tocm' => false, //目录下拉菜单
        'tocTitle' => "", //下拉菜单按钮
        'tocDropdown' => false, //是否启用下拉列表按钮
        'tocContainer' => "", //自定义目录容器
        'tocStartLevel' => 1, //从H1开启创建
        'htmlDecode' => false, //解析标签
        'pageBreak' => true, //分页
        'atLink' => true,
        'emailLink' => true,
        'taskList' => false,
        'emoji' => true,
        'flowChart' => 'false',  //流程图
        'tex' => 'false',  //开启科学公式TeX语言支持，默认关闭
        'sequenceDiagram' => 'false',  //开启时序/序列图支持，默认关闭
        'toolbar' => true,
        'toolbarAutoFixed' => true,
        'toolbarIcons' => "full", //工具栏图标模式 full, simple, mini
    ],

    'upload' => [
        'imageFieldName' => 'editormd-image-file', //提交的图片表单名称
        'imageMaxSize' =>  5 * 1024 * 1024, // 上传大小限制，单位B
        'imageAllowFiles' => ['.png', '.jpg', '.jpeg', '.gif', '.bmp'], //上传图片格式显示
        'imagePathFormat' => '/uploads/image/{yyyy}/{mm}/{dd}/', //上传保存路径,可以自定义保存路径和文件名格式
    ]

];
