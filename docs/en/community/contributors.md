---
title: Contributors
description: I urge everyone to contribute to the project.
section: site.community.
---

## Contribute and Collaborate

The Orchid project thrives on community collaboration. We invite you to participate in open discussions, ask questions, and propose ideas in our [GitHub discussions](https://github.com/orchidsoftware/platform/discussions). Your input can shape the future of Orchid!

If you encounter any bugs or have specific feature requests, please check our [issues tracker](https://github.com/orchidsoftware/platform/issues). You can find unresolved issues and indicate your intention to work on a specific problem by leaving a comment on the relevant task.

For active development, we encourage you to use `pull requests` instead of solely reporting bugs. This collaborative approach helps us work together efficiently to resolve issues and enhance Orchid.

[![Users who have made significant contributions to Orchid. Alone we can do so little, together we can do so much.](https://opencollective.com/orchid/contributors.svg?width=800&button=false)](https://github.com/orchidsoftware/platform)



## Writing Effective Bug Reports

When submitting a bug report, it is crucial to provide concise yet comprehensive details. To ensure your report is helpful for developers, make sure they can easily reproduce the issue. Be sure to include step-by-step instructions to replicate the problem. We kindly ask you to report bugs in English, while keeping an eye on your grammar and language usage.

Remember, bug reports are meant to encourage collaboration and allow other users with similar issues to participate in finding solutions. While we appreciate your enthusiasm, it's important to note that others may not be able to immediately drop their work and address your specific problem. Bug reports serve as a starting point for cooperative problem-solving.

## Security Concerns

If you discover any security vulnerabilities within the platform, please promptly send an email to `bliz48rus@gmail.com`. We take all security concerns seriously and will promptly address them.

## Debugging and Submitting Change Requests

When contributing to the project, you might encounter issues related to debugging and installation. This section aims to assist you in submitting your first change request.

### Development Installation

To install the Laravel Orchid package as a developer, you'll need to have a Laravel framework installation.

> Before making changes, fork the [GitHub repository](https://github.com/orchidsoftware/platform) and create a clone of it.

Navigate to the root directory of your fresh Laravel installation and execute the following command:

```bash
git clone https://github.com/yourname/platform.git
```

Next, add a local repository to the `composer.json` file of your Laravel project to point the Orchid platform to your locally cloned fork:

```json
"repositories": [
    {
        "type": "path",
        "url": "./platform"
    }
]
```

Lastly, include our package by executing the following command:

```bash
composer require orchid/platform:@dev
```

Composer will add the package from the repository you specified. Follow the rest of the installation instructions in the "Installation" section.

To collect JavaScript and CSS resources and apply them immediately, use the following command:

```bash
npm run dev --prefix platform && php artisan orchid:publish
```

### Preparing code for submitting

First you need to check the code style ([Laravel Pint](https://laravel.com/docs/10.x/pint) is used for this)

Run check and fix: 

```bash
./vendor/bin/pint
```

Run on specific files or directories:

```bash
./vendor/bin/pint src/Platform
 
./vendor/bin/pint src/Platform/Dashboard.php
```

Next you need to check the execution of unit tests:

```bash
./vendor/bin/phpunit
```

### Submitting a Change Request

Create a new branch that indicates the added functionality or fixes the issue. Use the following command:

```bash
git checkout -b feature/issue_001
```

This branch name will signify that you're addressing a specific functionality related to message number 001.

Make your changes and commit them:

```bash
git commit -am 'ref #001 [Docs] Fix typo'
```

To submit your branch for review, execute the following command:

```bash
git push origin feature/issue_001
```

## Help Translate Orchid into Different Languages!

We appreciate your contributions in translating Orchid into multiple languages. Visit the [Make Orchid (more) International](https://github.com/orchidsoftware/platform/discussions/1545) conversation on the Discussion tab for more details. Translation files can be found in the [resources/lang](https://github.com/orchidsoftware/platform/tree/master/resources/lang) directory.

To begin translating, follow the steps outlined in the "Development Installation" section to create a development installation. Create a new branch for your translation:

```bash
git checkout -b feature/translation_nl
```

Copy one of the existing JSON files from the [resources/lang](https://github.com/orchidsoftware/platform/tree/master/resources/lang) directory and name your file according to the codes mentioned in the [List of ISO_639-1 codes](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes) page.

Once you've completed the translation, submit it as a change request following the instructions mentioned earlier.

We appreciate your dedication to making Orchid accessible to a broader audience. Your translations will help us reach more users around the world.

We hope this detailed documentation helps you contribute effectively and participate in the growth of Orchid. We value your time and effort in making Orchid better and more user-friendly. Thank you for being part of our community!
