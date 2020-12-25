{!! editor_css() !!}

{!! editor_js() !!}

<script>
    let mdeditor_config = JSON.parse('{!! json_encode(config('mdeditor.config')) !!}'),
        mdeditor_github_emoji = JSON.parse('{!! json_encode(config('mdeditor.emojis.github')) !!}'),
        mdeditor_twemoji = JSON.parse('{!! json_encode(config('mdeditor.emojis.twitter')) !!}'),
        mdeditor_custom_config = {};

    if (mdeditor_config['imageUploadURL']) {

        mdeditor_config['imageUploadURL'] = mdeditor_config['imageUploadURL'] + "?_token={{ csrf_token() }}"

    }

    mdeditor_config = $.extend(mdeditor_config, mdeditor_custom_config);

    if (mdeditor_github_emoji) {
        editormd.emoji = {
            path: mdeditor_github_emoji['path'],
            ext: mdeditor_github_emoji['ext'],
        };
    }

    if (mdeditor_twemoji) {
        editormd.twemoji = {
            path: mdeditor_twemoji['path'],
            ext: mdeditor_twemoji['ext'],
        };
    }

    // let mdeditor = editormd(\"mdeditor\", mdeditor_config)

    // 设置内容
    // mdeditor.markdownTextarea.val('')

</script>

