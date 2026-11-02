<?php

use App\Documentation;

return [

    'name'        => 'Orchid - Laravel Admin Panel',
    'description' => 'Free open-source Laravel admin panel for rapid development of back-office applications, dashboards and CRUD systems. Code-driven, beautiful and powerful.',
    'navigation'  => json_decode(file_get_contents(base_path('docs/'.Documentation::latest().'/navigation.json')), true, 512, JSON_THROW_ON_ERROR),

    'hig' => [
        'en' => [
            'Get Started' => [
                'Introduction'      => '/en/hig',
                'Design Philosophy' => '/en/hig/philosophy',
                'User Workflow'     => '/en/hig/workflow',
            ],

            'Guidelines' => [
                'Naming Elements'       => '/en/hig/naming',
                'Navigation'            => '/en/hig/navigation',
                'Presentation Table'    => '/en/hig/table',
                'Providing Feedback'    => '/en/hig/providing-feedback',
                'Modal Dialogs'         => '/en/hig/modals',
                'Quick Response Time'   => '/en/hig/performance',
            ],

            'Reference' => [
                'Writing Style' => '/en/hig/text',
                'Iconography'   => '/en/hig/icon',
            ],
        ],
    ],

    'community' => [
        'en' => [
            'Community' => [
                'Code of Conduct'   => '/en/community/code-of-conduct',
                'Reporting Bugs'    => '/en/community/bug-report',
                'Contribution'      => '/en/community/contributors',
                'Project Promotion' => '/en/community/promote',
                'License Agreement' => '/en/community/license',
            ],

            'About' => [
                'Under the Hood'    => '/en/community/background',
            ],

            /*
            'Discussions' => [
                'GitHub'   => 'https://github.com/orgs/orchidsoftware/discussions',
                'Telegram' => 'https://t.me/orchid_community',
                'Twitter'  => 'https://twitter.com/orchid_platform',
                'Discord'  => 'https://discord.gg/aEVdGMyRt4',
            ],

            'Other' => [
                'Donation'   => 'https://opencollective.com/orchid',
                'Change Log' => 'https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md',
            ],

            'Navigation' => [
                'Back to Documentation' => '/en/documentation',
                'Design Guidelines'     => '/en/hig',
                'Community Forums'      => '/en/discussions',
                'Change Log'            => 'https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md',
            ],
            */
        ],
    ],

];
