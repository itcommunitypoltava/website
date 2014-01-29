# Poltava IT Community public website

# Requirements

-   **PHP 5.4+**.
-   Probably, **enabled support for running PHAR archives from console** (it has to be enabled via `php.ini`).
-   *Optional*: **Java** to be able to run Selenium.
-   *Optional*: **Virtualbox** and **Vagrant** for the easiest local deploy ever.

# Quickstart

1. Install [Git][git]
2. Install [Vagrant][vagrant]
3. Install [Virtualbox][virtualbox]
4. Now just clone the community website repo:

    git clone git@github.com:itcommunitypoltava/website.git <yourprojectname>
    
    or
    
    git clone https://<your username>:<your password>@github.com/itcommunitypoltava/website.git <yourprojectname>
        
5. Inside cloned directory run and wait for complete:

        vagrant up
        
6. You're done. Open up the [http://localhost:8080/](http://localhost:8080/). It's your future front user interface. Open up [http://localhost:8081/](http://localhost:8081/). It's your future admin user interface. You can start working.
    Don't forget to `vagrant halt` the virtual machine before turning off your workstation, virtualbox can fail to shut itself down in time before `kill -9` arrives.

# Manual preparations

Consult the `carcass/vagrant/prepare-precise64.sh` and `carcass/vagrant/setup-app.sh` scripts for example.

# Get a full health report for a project

We integrated almost everything from the [PHP QA Tools project][phpqatools], over the [Phing build system][phing].

To get all possible static code analysis reports for your project and the API documentation, just run:

    bin/phing

It will generate the following reports in the `reports` folder:

* Report of the code style violations in Checkstyle format from [PHP Code Sniffer][phpcs]
* Code coverage report in Clover format from [PHPUnit][phpunit]
* Code duplications report in XML from [PHP Copy-Paste Detector][phpcpd]
* Codebase size report in XML from [PHPLOC][phploc]
* Various problems report in XML from [PHP Mess Detector][phpmd]
* Report in XML from [PDepend][pdepend]
* Two code metrics schematics in SVG from PDepend
* Code coverage report in HTML format from PHPUnit
* HTML pages tree with all of your codebase with all above problems highlighted from [PHP Code Browser][phpcb]
* and, finally, the autogenerated API documentation in HTML from [ApiGen][apigen].

We believe it'll be sufficient for you to get an idea about the state of your codebase.
Of course to generate code coverage reports this reporter has to run all unit tests, too, so you get regression testing as a side effect, assuming that your unit tests are really fast.

# Overview

Now, let's delve into internals.

YiiBoilerplate was designed for medium-sized Yii-based web applications of any kind.
By "meduim-sized" we mean 10 to 100 unique routes.
Again, it has a harness to support two-tier test-first development, with [Behat][behat] for end-to-end acceptance tests and [PHPUnit][phpunit] for both pure unit tests and integration tests.

Basically, YiiBoilerplate is a bunch of files and folders you commit to your VCS repo as your "initial commit", then start working for real.
It consists of a proof-of-concept website, having one-page blank frontend and an admin side with rudimentary UI and a password-based authentication already done.

You can read the whole "table of contents" for the various directories of the YiiBoilerplate in `README.md` files inside that directories.

## Top-level Directories

1.  `backend`

    Backend entry point, expected to be your "admin side" of the application.

2.  `bin`

    Binaries for you to use, including `yiic`, `phing`, `phpunit` and such.
    Note that while most of binaries are Composer-installed, `yiic` and `selenium` launchers are hand-crafted
    and not supposed to be removed/changed.

3.  `carcass`

    Configuration for various 3rd-party tools used in project harness,
    including Vagrant stuff and code style definition for CodeSniffer.

4.  `common`

    This folder is structured similarly to the traditional `protected` folder in autogenerated Yii application.
    You are expected to place the code global to all entry points in `common`.
    Backend-, frontend-, and console-specific stuff should go to `backend`, `frontend` and `console` dirs, respectively.

5.  `console`

    Console entry point, reachable by `yiic` console runner.
    Most important stuff here is your migrations, inside `console/migrations` subfolder.

6.  `frontend`

    Frontend entry point, expected to be public side of your application.

7.  `reports`

    All project status reports from various code quality tools will be placed in here. Documentation from APIGen, too.
    You will not see this directory initially, it's auto-generated when needed.

8.  `tests`

    Your test harness is here. See details in the `README.md` there.

9.  `vendor`

    All third-party dependencies are installed by Composer in here, even Selenium.
    You will not see this directory initially, it's auto-generated when needed.

## Configuration tree

Most complex part of the YiiBoilerplate application is the configuration, built from set of different parts.

Basically, configuration for backend, console and frontend entry points is being constructed from the following parts, later ones overriding previous ones:

1. Base common config.
2. Environment-specific common config.
3. Local overrides for common config.
4. Base entry point-specific config.
5. Environment-specific entry point-specific config.
6. Local overrides for entry-point-specific config.

For frontend entry point the corresponding files would be:

1. `common/config/overrides/base.php`
2. `common/config/overrides/environment.php`
3. `common/config/overrides/local.php`
4. `frontend/config/overrides/base.php`
5. `frontend/config/overrides/environment.php`
6. `frontend/config/overrides/local.php`

Local overrides and environment overrides can be absent.

You can trace the resulting tree of `require` calls starting from `frontend/config/main.php` file.
That's the file you really use as the configuration file for application.
In reality it's just a four-line builder constructing the resulting configuration tree from six different parts specified above.

### Local overrides

Local overrides are simple. That's the snippets of configuration containing the non-portable parts like database access credentials.

`config/overrides` subdirectory in all of `common`, `frontend`, `console` and `backend` directories contains the `local-example.php` file which you can copy as `local.php` and immediately use.

These overrides are not to be committed to the repository as they contain the settings specific to each developer's machine.

### Environment overrides

Configuration snippets for different environments are placed inside `config/environments` directories.
You can specify things there like the different database paths, caching mechanisms, some OS-specific parameters, or anything you want.
To activate the desired environment, you are expected to copy needed configuration snippet from inside `config/environments` subdir and place it into `config/overrides/` under the name `environment.php`. As it's an obviously mundane and boring to hell task it's automated for you by invoking the following command:

    bin/yiic environment set --id=<environmentname>

Of course, each `config/environments` subdirectory in all of entry points should have a configuration snippet named `<environmentname>`.

Environment overrides are to be committed to the repository as they contain the proven set of settings intended to adapt the application to different working conditions.

Nothing forces you to really use this system of environment-specific settings. Configuration builder will happily live without these files.

## Vagrant

YiiBoilerplate includes [Vagrant][vagrant] harness which you can use as you wish.
`Vagrantfile` is set up to use the default `precise64` box, which is Virtualbox image loaded with blank [Ubuntu 12.04][ubuntu1204].

As YiiBoilerplate is a rudimentary web application, we prepared a set of scripts to deploy it to Vagrant virtual machine.
They are located at `carcass/vagrant` subdirectory.
Two scripts, which are used as provisioning scripts for Vagrant, can be used as an examples of automatic deploy of the YiiBoilerplate application to any *nix-based system:

* `prepare-precise64.sh` is a script to install the required tech stack for common database-backed web application to Ubuntu 12.04: PHP 5.4, apache, mysql, git etc. and create the database.
* `setup-app.sh` is a script to install the application to prepared system: generate configs, required runtime directories, install dependencies.

You are encouraged to read through them yourself, they're not so hard to comprehend.

## Composer

All 3rd-party components of YiiBoilerplate, including Yii itself, are managed by the [Composer][composer].
You get [Behat][behat]+[Mink][mink]+[MinkExtension][mink-extension], [PHPUnit][phpunit], full stack of [PHP Quality Assurance toolchain][phpqatools], [Phing][phing], [ApiGen][apigen], [Yii][yii] and [YiiBooster][yii-booster] as your dependencies. Even [Selenium][selenium] was packaged into Composer so it's being installed, too.

Using Composer greatly reduces the size of your application codebase checked into the repository.
To ensure that everyone in your team gets exactly the same versions of the 3rd-party software,
Composer generates a special file called [`composer.lock`][composer.lock], which you commit to the repository instead of the whole `vendor` folder, and the presense of this file will indicate to Composer what exact versions of software to maintain in a given codebase.
YiiBoilerplate repo contains such a file so you can be reasonably sure that at least its developers managed to run boilerplate application using the set of dependencies specified in there.

`composer.json` was tweaked so you will get all executables inside `bin` subdirectory.

## Phing

Most possibly you'll need the build system for your application, so we included the PHP-based one, namely, [Phing][phing].

Build file included in YiiBoilerplate contains the targets allowing you to generate the comprehensive set of reports about the health of your application.

Results of running the default target by issuing `bin/phing` from root of codebase was already described before.

Please note that the set of source directories for each different tool being run by Phing is specified in separate build file `carcass/filesets.xml`.
We're sorry, but various directories excluded from analysis you have to hack inside the main build file, in case you'll change the structure of a project.

## Yiic

[Usual console runner from Yii][yiic] was moved to `bin` subdirectory. As Composer is configured to install executables into the same directory, it was done to prevent you from using the default console runner instead of the one built-in to YiiBoilerplate, which you have total control over.

Whole `console` subdirectory is for this console entry point to the application.

So, to run any console command built-in to Yii or defined by you in `console/commands`, you have to run `bin/yiic <command>` from root of codebase (instead of more short `./yiic`).

We have found this an acceptable trade-off.

## Behat

As an acceptance tests driver we included [Behat][behat]+[Mink][mink]+[MinkExtension][mink-extension] combo over the [Selenium2][selenium-driver] driver.

This gives you arguably the best PHP-based acceptance testing solution out there.
Gherkin syntax allows you and your QA team and perhaps even your client to specify the desired behavior of the application in human language, which is the clear win.
Selenium uses real browser to manipulate the web GUI of your application, and does this *insanely* fast, so you will not need to cope with any of shortcomings of the headless browsers like [phantomJS][phantomjs] or [Zombie][zombie].

All required configuration was already done.
`behat.yml` config file is placed into the root of codebase for your convenience, so you'll be able to run Behat without the hassle of specifying the path to config file in command line arguments.
You need to do only one thing: place a config called `behat-local.yml` into the root of codebase, in which you specify the only non-portable setting: base URL for Mink to be able to connect to your web application.
If you run Vagrant virtual machine, provisioning script will place the `behat-local.yml` pointing to its URLs automatically. So you can look at `carcass/vagrant/behat-local.yml` file to understand what is needed from you.

If you use the default setup based on Selenium, you have to run the `bin/selenium` helper script
which just launches Selenium, taking up one console terminal.

All of your specs related to frontend are expected to be placed into `tests/specs/frontend`.
You run them all using the simple invocation `bin/behat -p frontend`.

All of your specs related to backend are expected to be placed into `tests/specs/backend`.
You run them all using the simple invocation `bin/behat -p backend`.

Both sets of the specs use the same context class located in the `tests/specs/contexts/FeatureContext.php`. All of your test steps definitions should be placed there.
Please note that a single `FeatureContext` class is just a starting point, nothing prevents you from structuring your acceptance test harness as you see fit.

## PHPUnit

For unit testing we included the [PHPUnit][phpunit] library as the Composer dependency.
Its executable is in `bin`, along with all other executables,
and by default you run all unit tests at once, as they have to be crazy fast anyway.
Its `phpunit.xml` config file is placed in the root of codebase for your convenience, so you'll be able to run PHPUnit as `bin/phpunit` and be freed from specifying the path to config file.

Config file we included in YiiBoilerplate does not have any code coverage setup definitions.
To get a code coverage you are expected to use Phing target named `coverage` as follows: `bin/phing coverage`, which specifies code coverage settings using command line switches.

Our intention was to make a harness to support *only pure isolated unit tests*, so you get totally clean environment inside test cases.
In case where you need the integration test, we prepared the bootstrap script for PHPUnit which does the common initialization of YiiBoilerplate application as defined in `common/bootstrap.php` and does some tricks the same way `yiit.php` script does. This bootstrap script is essentially the fourth entry point to your application.

So when you run:

    bin/phpunit --bootstrap carcass/phpunit.bootstrap.php

You run your test cases in the environment where the Yii class is defined and all usual setup is done so you can freely instantiate WebApplication instances as you see fit and using any configuration you want in your tests.

## YiiBooster

For backend side of the application, we included our other library, [YiiBooster][yii-booster] as a Composer dependency, and made the configuration required to attach it.

So, in effect, you'll get the total power of YiiBooster to make the UI of your backend.
You are expected to skim through the [YiiBooster documentation][yii-booster-docs] to learn what widgets you get from this toolkit.

Frontend, in contrast, is completely blank [HTML5Boilerplate][html5-boilerplate], because judging from our own experience, public side of the application is unique for every project anyway, so default styles from [Twitter Bootstrap][bootstrap] will not find any place there.


# License

All of the code by default is licensed by [BSD license][bsd-license], as all opensource work from Clevertech.

However, as you most possibly will change everything inside the codebase over time, you can probably treat the code as being in public domain. Our terms and intention is that you can adapt anything inside YiiBoilerplate to your needs.

# phpStorm tweaks

To fully utilize phpStorm's autocompletion feature we have to do some tweaks to instruct it to ignore some files
from 3rd-party libraries.

1.  We use our custom `Yii` class, to utilize the F4 button over the `Yii::app()` invocation
    and to regain control over this singleton in general.
    However, this leads to duplicate definitions as far as phpStorm is concerned.

    1.  In `File -> Settings -> PHP` under *Include Path* section find the entry ending in `yiisoft/yii` entry
        and change it so it will end in `yiisoft/yii/framework`.
    2.  Similarly change the entry ending in `clevertech/yii-booster` so that it ends in `clevertech/yii-booster/src`.
    3.  In `File -> Settings -> File Types` under *Ignore files and folders* section
        append the string `;framework/Yii.php;tests/fakes/Yii.php` verbatim.

2.  Also, Behat distribution shipped with Composer includes the `FeatureContext` class which conflicts with our own.
    In `File -> Settings -> PHP` under *Include Path* section find the entry ending in `behat/behat` and append `src` to it.
    This will exclude the tests code from Behat library index.

Please note that due to the indexing mechanism of phpStorm you will either need to change the PHP include paths each time
you make changes in `composer.json` or to disable the auto-reindexing of Composer-installed libraries altogether.

Side note regarding phpStorm usage with Yii-based applications: if you want Yii application components to be accessible
by hitting F4 over the component name in expressions like `Yii::app()->request`, you have to write `@property` doc blocks
for your WebApplication class assigning proper class names to the component IDs. It increases human-readability, too.

====
[apigen]: http://apigen.org/
[atdd]: http://guide.agilealliance.org/guide/atdd.html
[behat]: http://behat.org/
[bootstrap]: http://getbootstrap.com/
[bsd-license]: http://opensource.org/licenses/BSD-2-Clause
[composer]: http://getcomposer.org/
[composer.lock]: http://getcomposer.org/doc/01-basic-usage.md#composer-lock-the-lock-file
[git]: http://git-scm.com/downloads/
[goos]: http://www.growing-object-oriented-software.com/
[gherkin]: http://docs.behat.org/guides/1.gherkin.html
[html5-boilerplate]: http://html5boilerplate.com/
[mink]: http://mink.behat.org/
[mink-extension]: http://extensions.behat.org/mink/
[phpqatools]: http://phpqatools.org/
[phing]: http://www.phing.info/
[phpcs]: http://pear.php.net/PHP_CodeSniffer
[phpcpd]: http://github.com/sebastianbergmann/phpcpd
[phploc]: http://github.com/sebastianbergmann/phploc
[phpmd]: http://phpmd.org/
[phpunit]: http://phpunit.de/
[pdepend]: http://pdepend.org/
[phpcb]: https://github.com/Mayflower/PHP_CodeBrowser
[phantomjs]: http://phantomjs.org/
[php-5.4-changelog]: http://www.php.net/manual/en/migration54.new-features.php
[selenium]: http://docs.seleniumhq.org/
[selenium-driver]: https://github.com/Behat/MinkSelenium2Driver
[ubuntu1204]: http://releases.ubuntu.com/precise/
[uncle-bob-the-screaming-architecture]: http://blog.8thlight.com/uncle-bob/2011/09/30/Screaming-Architecture.html
[vagrant]: http://docs.vagrantup.com/v2/getting-started/
[virtualbox]: https://www.virtualbox.org/
[yii]: http://www.yiiframework.com/
[yiiboilerplate]: https://github.com/clevertech/YiiBoilerplate
[yiic]: http://www.yiiframework.com/doc/guide/1.1/en/topics.console
[yii-booster]: http://yii-booster.clevertech.biz/
[yii-booster-docs]: http://yii-booster.clevertech.biz/widgets/
[yii-boilerplate-issues]: https://github.com/clevertech/YiiBoilerplate/issues
[yii-default-structure]: http://www.yiiframework.com/doc/guide/1.1/en/basics.convention#directory
[zombie]: http://zombie.labnotes.org/
