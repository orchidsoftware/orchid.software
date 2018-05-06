<?php

namespace App\Console\Commands;

use Composer\Semver\Semver;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Orchid\Platform\Core\Models\Post;

class PackagistPlugins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'packagist:load';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Packagist Load Plugins';

    /**
     * @var Client
     */
    public $client;

    /**
     * PackagistPlugins constructor.
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://packagist.org/',
            'timeout'  => 4.0,
        ]);

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handle()
    {
        $this->loadPage();
    }

    /**
     * @param int $page
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function loadPage($page = 10)
    {
        $response = $this->client->request('GET', 'search.json', [
            'query' => [
                'tags' => 'laravel', //orchid-package,
                'page' => $page,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), true);

        foreach ($content['results'] as $package) {
            try {
                $this->loadPackage($package);
            } catch (\Exception $exception) {
                echo $exception->getMessage();
            }
        }

        if (key_exists('next', $content)) {
            $this->loadPage(($page + 1));
        }

    }

    /**
     * @param array $package
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function loadPackage(array $package)
    {

        if(strpos($package['repository'], 'github') === false){
            return;
        }

        $post = Post::firstOrNew([
            'user_id' => 1,
            'type'    => 'package',
            'status'  => 'publish',
            'slug'    => $package['name'],
            'publish_at' => time(),
        ]);

        $response = $this->client->request('GET', $package['url'] . ".json");
        $content = json_decode($response->getBody()->getContents(), true);

        $package = $content['package'];

        $lastVersion = $this->howVersion($package['versions']);

        $package['info'] = $package['versions'][$lastVersion];
        unset($package['versions']);

        try{
            $pageDescriptions = $this->client->request('GET',
                "https://api.github.com/repos/" . $package['name'] . "/readme", [
                    'query' => [
                        'client_id'     => env('GITHUB_CLIENT_ID'),
                        'client_secret' => env('GITHUB_CLIENT_SECRET'),
                    ],
                ]);
        }catch (\Exception $exception){
            $post->forceDelete();
            return;
        }

        $pageDescriptions = json_decode($pageDescriptions->getBody()->getContents(), true);
        $package['content'] = base64_decode($pageDescriptions['content']);

        $post->content = $package;
        $post->options = [];

        // remove laravel key
        if (($key = array_search('laravel', $package['info']['keywords'])) !== false) {
            unset($package['info']['keywords'][$key]);
        }

        $post->save();
        $post->setTags($package['info']['keywords']);
        $post->save();
    }


    /**
     * @param $versions
     *
     * @return mixed
     */
    private function howVersion($versions)
    {
        $versions = array_keys($versions);
        $versions = Semver::sort($versions);

        if (count($versions) > 1) {
            return $versions[count($versions) - 2];
        }

        return array_pop($versions);
    }

}
