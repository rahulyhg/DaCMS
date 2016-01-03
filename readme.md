## [DaCMS](https://dacms.co)

[Demo] CMS build with Laravel and Bootstrap.

**NOT meant for production use!**


### Installation ###

* `git clone https://github.com/DaCMS/DaCMS.git projectname`
* `cd projectname`
* `composer install`
* create a database and edit your *.env* file (remove *.example*)
* `php artisan migrate` to create tables
* `php artisan db:seed` to populate tables
* `php artisan vendor:publish` to publish all vendors assets
* start developing your project on the base of this simple installation
* if you find a bug, please report it (and maybe make a new PR).


## Credits

- [Laravel](https://laravel.com)

- [Composer](https://getcomposer.com) packages:
  - [laravel-assets](https://github.com/RoumenDamianoff/laravel-assets)
  - [laravel-sitemap](https://github.com/RoumenDamianoff/laravel-sitemap)
  - [laravel-feed](https://github.com/RoumenDamianoff/laravel-feed)
  - [laravel-disqus](https://github.com/RoumenDamianoff/laravel-disqus)
  - [laravel-tidyfier](https://github.com/RoumenDamianoff/laravel-tidyfier)
  - [laravel-lang](https://github.com/caouecs/Laravel-lang)
  - [laravelcollective-html](https://github.com/LaravelCollective/html)
  - [mews-purifier](https://github.com/mewebstudio/Purifier)
  - [greggilbert-recaptcha](https://github.com/greggilbert/recaptcha)

- [Bootstrap](https://getbootstrap.com)

- [JQuery](https://jquery.com)
