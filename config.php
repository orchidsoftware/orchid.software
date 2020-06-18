<?php

use Illuminate\Support\Str;

return [
    'baseUrl'         => 'http://localhost:3000',
    'production'      => false,
    'siteName'        => 'Orchid - Laravel Admin Panel',
    'siteDescription' => 'RAD platform for building a business application using the Laravel framework. Can act as the basis for web applications or perform the functions of CMS, CMF or admin panel for your site.',

    // Algolia DocSearch credentials
    'docsearchApiKey'    => '',
    'docsearchIndexName' => '',

    // navigation menu
    'navigation' => require_once('navigation.php'),

    // helpers
    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },
    'isActiveParent' => function ($page, $menuItem) {
        if (is_object($menuItem) && $menuItem->children) {
            return $menuItem->children->contains(function ($child) use ($page) {
                return trimPath($page->getPath()) == trimPath($child);
            });
        }
    },
    'url' => function ($page, $path) {
        return Str::startsWith($path, 'http') ? $path : '/'.trimPath($path);
    },

    'editGitHub' => function($page) {

        $path = trimPath($page->getPath());

        if (is_dir(__DIR__ . '/source/' . $path)) {
            $path .= '/index.md';
        }else{
            $path .= '.md';
        }

        return "https://github.com/orchidsoftware/orchid.software/edit/master/source/$path";
    },


    // collections
    'collections' => [
        'posts' => [
            'author' => 'Alexandr Chernyaev', // Default author, if not provided in a post
            'sort' => '-date',
            'path' => 'blog/{filename}',
        ],
        'categories' => [
            'path' => '/blog/categories/{filename}',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return $post->categories ? in_array($page->getFilename(), $post->categories, true) : false;
                });
            },
        ],
    ],

    // helpers
    'getDate' => function ($page) {
        return Datetime::createFromFormat('U', $page->date);
    },
    'getExcerpt' => function ($page, $length = 255) {
        if ($page->excerpt) {
            return $page->excerpt;
        }

        $content = preg_split('/<!-- more -->/m', $page->getContent(), 2);
        $cleaned = trim(
            strip_tags(
                preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $content[0]),
                '<code>'
            )
        );

        if (count($content) > 1) {
            return $content[0];
        }

        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated) . '...'
            : $cleaned;
    },

    'icons' => [
        'action-redo',
        'action-undo',
        'actual-size',
        'anchor',
        'android',
        'arrow-down-circle',
        'arrow-down',
        'arrow-left-circle',
        'arrow-left',
        'arrow-right-circle',
        'arrow-right',
        'arrow-up-circle',
        'arrow-up',
        'badge',
        'bag',
        'ban',
        'bar-chart',
        'barcode',
        'basket-loaded',
        'basket',
        'bell',
        'bitcoin',
        'bold',
        'book-open',
        'briefcase',
        'browser',
        'brush',
        'bubble',
        'bubbles',
        'bug',
        'building',
        'bulb',
        'calculator-alt',
        'calculator',
        'calendar',
        'call-end',
        'call-in',
        'call-out',
        'camera',
        'camrecorder',
        'chart',
        'check',
        'chemistry',
        'circle',
        'circle_thin',
        'clock',
        'close',
        'cloud-download',
        'cloud-upload',
        'code',
        'compass',
        'config',
        'control-end',
        'control-forward',
        'control-pause',
        'control-play',
        'control-rewind',
        'control-start',
        'controller',
        'copyright',
        'credit-card',
        'crome',
        'crop',
        'cross',
        'cup',
        'cursor-move',
        'cursor',
        'cut',
        'database',
        'diamond',
        'direction',
        'directions',
        'disc',
        'dislike',
        'doc',
        'docs',
        'dollar',
        'drawer',
        'dribbble',
        'drop',
        'dropbox',
        'earphones-alt',
        'earphones',
        'edge',
        'emotsmile',
        'energy',
        'envelope-letter',
        'envelope-open',
        'envelope',
        'equalizer',
        'euro',
        'event',
        'exclamation',
        'eye',
        'eyeglasses',
        'facebook',
        'feed',
        'female-user',
        'film',
        'filter',
        'fingerprint',
        'fire',
        'firefox',
        'flag',
        'folder-alt',
        'folder',
        'font',
        'frame',
        'friends',
        'full-screen',
        'game-controller',
        'ghost',
        'globe-alt',
        'globe',
        'graduation',
        'graph',
        'grid',
        'handbag',
        'headphones-microphone',
        'headphones',
        'heart',
        'help',
        'history',
        'home',
        'hourglass',
        'ie',
        'info',
        'italic',
        'key',
        'layers',
        'left',
        'like',
        'link',
        'linux',
        'lira',
        'list',
        'loading',
        'location-pin',
        'lock-open',
        'lock',
        'login',
        'logout',
        'loop',
        'mac',
        'macos',
        'magic-wand',
        'magnet',
        'magnifier-add',
        'magnifier-remove',
        'magnifier',
        'map',
        'menu',
        'microphone',
        'minus',
        'module',
        'modules',
        'money',
        'monitor',
        'mouse',
        'moustache',
        'move',
        'music-tone-alt',
        'music-tone',
        'mustache',
        'new-doc',
        'note',
        'notebook',
        'number-list',
        'open',
        'options-vertical',
        'options',
        'orchid',
        'organization',
        'os',
        'paper-clip',
        'paper-plane',
        'paste',
        'paypal',
        'pencil',
        'people',
        'phone',
        'photo',
        'picture',
        'pie-chart',
        'pin',
        'plane',
        'playlist',
        'plus-alt',
        'plus',
        'pointer',
        'pound',
        'power',
        'present',
        'printer',
        'puzzle',
        'question',
        'quote',
        'refresh',
        'reload',
        'right',
        'rocket',
        'rub',
        'rupi',
        'safari',
        'save',
        'save-alt',
        'screen-desktop',
        'screen-smartphone',
        'screen-tablet',
        'server',
        'settings',
        'share-alt',
        'share',
        'shekel',
        'shield',
        'shuffle',
        'size-actual',
        'size-fullscreen',
        'social-behance',
        'social-dribbble',
        'social-dropbox',
        'social-facebook',
        'social-foursqare',
        'social-github',
        'social-google',
        'social-instagram',
        'social-linkedin',
        'social-pintarest',
        'social-reddit',
        'social-skype',
        'social-soundcloud',
        'social-spotify',
        'social-steam',
        'social-stumbleupon',
        'social-tumblr',
        'social-twitter',
        'social-vkontakte',
        'social-youtube',
        'sort-alpha-asc',
        'sort-alpha-desc',
        'sort-amount-asc',
        'sort-amount-desc',
        'sort-numeric-asc',
        'sort-numeric-desc',
        'speech',
        'speedometer',
        'star',
        'start',
        'support',
        'symble-female',
        'symbol-male',
        'table',
        'tablet',
        'tag',
        'target',
        'task',
        'text-center',
        'text-left',
        'text-middle',
        'text-right',
        'trash',
        'trophy',
        'tumblr',
        'twitter',
        'umbrella',
        'unfollow',
        'unlock',
        'user-female',
        'user-follow',
        'user-following',
        'user-unfollow',
        'user',
        'vector',
        'video',
        'volume-1',
        'volume-2',
        'volume-off',
        'wallet',
        'windows',
        'wrench',
        'yen',
        'youtube',
    ],
];
