<?php

namespace Qasim\LaravelMdEditor\Console;

use Illuminate\Console\Command;

class EmojisCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mdeditor:emojis';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Emojis.';

    public function handle()
    {
        $this->emojis();
    }

    public function emojis()
    {

        $emojis = config('mdeditor.emoji');

        $res = [];

        foreach ($emojis as $emoji) {

            $html = strtolower(file_get_contents($emoji['url']));

            foreach ($emoji['category'] as $category) {

                preg_match_all($category['content_regex'], $html, $matches);

                if ($list = $matches[0][0]) {

                    preg_match_all($category['list_regex'], $list, $matches);

                    if ($matches[1]) {

                        if ($category['name']) {

                            $res[$emoji['name']][] = ['category' => $category['name'], 'list' => $matches[1]];

                        } else {

                            $res[$emoji['name']] = $matches[1];

                        }

                    }

                }

            }

        }

        $emoji_json = file_get_contents(__DIR__ . '/../assets/plugins/emoji-dialog/emoji.json');

        $emoji_json = json_decode($emoji_json, true);

        $emoji_json = $res + $emoji_json;

        file_put_contents(__DIR__ . '/../assets/plugins/emoji-dialog/emoji.json', json_encode($emoji_json));

    }

}
