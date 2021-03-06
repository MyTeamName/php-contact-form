# Dealer Inspire PHP Code Challenge

Thanks for reviewing my submission.

I have implemented the code challenge using Laravel 5.5

[![Build Status][travis-badge]][travis] [![Codecov][codecov-badge]][codecov]

There are some new build steps to test:

```bash
composer install

cp .env.example .env

php artisan key:generate

./vendor/bin/phpunit
```

**NOTE** that the unit tests require sqlite installed.

Now if you'd like to fully preview the functionality,
there are a few environment variables to set in the `.env` file:

* `DB_DATABASE`
* `DB_USERNAME`
* `DB_PASSWORD`
* `MAIL_USERNAME`
* `MAIL_PASSWORD`

I recommend using MySQL and mailtrap.io

Finally, serve with artisan:

```bash
php artisan serve
```

[travis-badge]:https://travis-ci.org/MyTeamName/php-contact-form.svg?branch=master
[travis]:https://travis-ci.org/MyTeamName/php-contact-form
[codecov-badge]:https://img.shields.io/codecov/c/github/MyTeamName/php-contact-form/master.svg
[codecov]:https://codecov.io/gh/MyTeamName/php-contact-form/branch/master
