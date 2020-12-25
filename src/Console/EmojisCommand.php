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

        $emoji_json = file_get_contents(public_path('vendor/mdeditor/plugins/emoji-dialog/emoji.json'));

        $emojis = json_decode($emoji_json, true);

        //github-emoji
        $emojis['github-emoji'] = $this->githubemoji();

        //twitter-emoji
        $emojis['twemoji'] = $this->twitteremoji();

        file_put_contents(public_path('vendor/mdeditor/plugins/emoji-dialog/emoji.json'), json_encode($emojis));

    }

    /**
     * github emoji
     * @return array
     */
    public function githubemoji(): array
    {

        $config = config('mdeditor.emojis.github');

        $res = [];

        $html = file_get_contents($config['url']);

        foreach ($config['category'] as $item){

            preg_match('/<h2>'.$item.'<\/h2>[\s\S]+?<\/ul>/is', $html, $matches);

            preg_match_all('/:<span[\s\S]+?data-alternative-name="[\s\S]+?">(.*)<\/span>:/i', $matches[0] ?? '', $matches);

            $res[] = ['category' => $item, 'list' => $matches[1] ?? []];

        }

        return $res;

    }


    /**
     * twitter emoji
     * @return array
     */
    public function twitteremoji(): array
    {

        $config = config('mdeditor.emojis.twitter');

        $html = file_get_contents($config['url']);

        preg_match('/<ul[\s]class="emoji-list">[\s\S]+?<\/ul>/is', $html, $matches);

        preg_match_all('/<li>(.*?);<\/li>/i', $matches[0] ?? '', $matches);

        $res = [];

        foreach ($matches[1] ?? [] as $item){

            $file = str_replace(['&#x', ';'], ['', '-'], strtolower($item));

            if(stripos($file, 'fe0f') !== false && count(explode('-', $file )) <= 2){

                $file = str_replace('-fe0f', '', $file);

            }

            $res[] = $file;

        }

        return $res;

    }

}
