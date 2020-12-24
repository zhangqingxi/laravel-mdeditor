{!! editor_css() !!}

{!! editor_js() !!}

{{--{!! editor_config() !!}--}}

<script>
    let mdeditor_config = '{!! json_encode(config('mdeditor.config')) !!} ',
        mdeditor_emoji = '{!! json_encode(config('mdeditor.emoji')) !!} ',
        mdeditor_custom_config = {};

    mdeditor_config = JSON.parse(mdeditor_config)

    // mdeditor_emoji = JSON.parse(mdeditor_emoji)

    mdeditor_config = $.extend(mdeditor_config,  mdeditor_custom_config);

    // console.log(mdeditor_config, mdeditor_emoji)

    // let mdeditor = editormd("mdeditor", mdeditor_config)

    // 设置内容
    // mdeditor.markdownTextarea.val('')

</script>
