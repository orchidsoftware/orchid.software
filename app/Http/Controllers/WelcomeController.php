<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $stats = Cache::remember('welcome', 1440, function () {

            try {
                $client = new Client([
                    'base_uri' => 'https://packagist.org/',
                    'timeout'  => 10.0,
                ]);

                $response = $client->get('https://packagist.org/packages/orchid/platform.json');
                $response = $response->getBody()->getContents();
                $response = json_decode($response, true);
                $response = $response['package'];

                $stats = [
                    'github_stars'       => $response['github_stars'],
                    'github_watchers'    => $response['github_watchers'],
                    'github_forks'       => $response['github_forks'],
                    'github_open_issues' => $response['github_open_issues'],
                    'download'           => $response['downloads']['total'],
                ];
            }catch (\Exception $exception){
                $stats = [];
            }

            return $stats;
        });

        return view('pages.welcome',[
            'stats' => $stats
        ]);
    }
}
