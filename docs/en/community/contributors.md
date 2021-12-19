---
title: Contributors
description: I urge everyone to contribute to the project.
---


[![Contributors](https://opencollective.com/orchid/contributors.svg?width=800&button=false)](https://github.com/orchidsoftware/platform)

I urge everyone to contribute to the project. You can find the latest version of the code on GitHub at <https://github.com/orchidsoftware/platform>.

Open discussions, questions, proposals are being held in [GitHub discussions](https://github.com/orchidsoftware/platform/discussions)

If you are having specific bugs or specific feature requests, take a look at [issues](https://github.com/orchidsoftware/platform/issues)

## Problem tracking

You can find unresolved issues on [GitHub Issues Tracker](https://github.com/orchidsoftware/platform/issues).
 If you intend to work on a specific issue, leave a comment on the relevant task to inform other project participants.

For active development, it is strongly recommended that you use only `pull request` requests, not just bug reports.

If you created a bug report, then it should contain a title and a clear description of the problem. You should also include as complete information and sample code as possible to help reproduce the problem. The main goal of the bug report is to simplify the localization, reproduction of the problem and search for its solution.

Also remember that error reports are created in the hope that other users with the same problems will be able to participate in solving them together with you. But do not expect others to quit and start fixing your problem. The bug report is designed to help you and others start working together to resolve a problem.

## Participate in discussions

You can offer new features and enhancements to your existing Laravel Orchid behavior. If you are proposing a new function, please be prepared to execute at least the code examples that will be needed to call / use this function.

Informal discussion about bugs/problems and new features:

 1. [Telegram group @orchid_community](https://t.me/orchid_community)
 2. [Telegram group @orchid_russian_community](https://t.me/orchid_russian_community)
 3. [Discord forum invite](https://discord.gg/aEVdGMyRt4)
 4. [Discord forum invite Russian](https://discord.gg/CNYwzWVnjX)
 

## Security

If you find a security vulnerability inside the platform, please send an e-mail message to `bliz48rus@gmail.com`.
All appeals will be immediately considered.


## Coding style

Laravel Orchid follows [PSR-2](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide-meta.md) and [PSR-4](Https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader.md) standards.

You can use [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer) to fix your code style before publishing.

To get started, install the tool on a global level and check the code style by executing the following command from the terminal of the root directory of your project:

````bash
php-cs-fixer fix
````


## Debug and submit change request


At the stage of helping the project, questions may arise related to debugging and installation,
This section is designed for those who want to send a request for the first time.

### Development Installation
    
To install the Laravel Orchid package as a developer, you will need an installation of the Laravel framework.
    

> First you have to make a fork [github repository](https://github.com/orchidsoftware/platform/fork) to post changes.


Go to the directory of your fresh Laravel installation and execute:

```bash
git clone https://github.com/yourname/platform.git
```

Add a local repository to the `composer.json` of the Laravel project, so the Orchid platform points to your locally cloned fork:

```php
"repositories": [
    {
        "type": "path",
        "url": "./platform"
    }
]
```

And add our package depending:

```bash
composer require orchid/platform:@dev
```

Composer adds the package from the repository that you specified.
The remaining actions correspond to the section `Installations`.

### Submit change request
    
Create a new branch like this:

```bash
git checkout -b feature/issue_001
```

This will allow you to almost immediately understand that the created branch adds new functionality from the message number 001.

Make changes and commit them:

```bash
git commit -am 'ref #001 [Docs] Fix misprint'
```

To send your branch you need to do:
```bash
git push origin feature/issue_001
```

## Help translate Orchid in different languages!

Take a look at the conversation [Make Orchid (more) International](https://github.com/orchidsoftware/platform/discussions/1545) on the Discussion-tab.
Translation files can be found in https://github.com/orchidsoftware/platform/tree/master/resources/lang

To start translating, create a dev install as mentioned in "Development Installation" and create your own branch. 

```bash
git checkout -b feature/translation_nl
```

Copy one of the existing json-files in https://github.com/orchidsoftware/platform/tree/master/resources/lang to your new language-file. Name your file according to the codes mentioned in [List of ISO_639-1 codes](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes).

You can then start translating all the entries.

Finally, submit your translation using the instructions found in "Submit change request"
