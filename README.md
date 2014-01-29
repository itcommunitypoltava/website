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
4. If you have PHP 5.4+ installed already ([and you should have, because it's awesome][php-5.4-changelog]), you've just installed all prequisites for community website.
5. Now just clone the community website repo:

        git clone git@github.com:itcommunitypoltava/website.git <yourprojectname>
        
6. Inside cloned directory run and wait for complete:

        vagrant up
        
7. You're done. Open up the [http://localhost:8080/](http://localhost:8080/). It's your future frontend. Open up [http://localhost:8081/](http://localhost:8081/). It's your future backend. You can start working.
    Don't forget to `vagrant halt` the virtual machine before turning off your workstation, virtualbox can fail to shut itself down in time before `kill -9` arrives.

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
