# Contributing

This guide based on the php league's own guide.

## Pull Requests

- **[PSR-2 Coding Standard](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md)** - After cloning and running composer install, phpcs ('codesniffer') can be run by simply ```vendor/bin/phpcs src --standard=PSR2```

- **[PHPMD](https://phpmd.org/)** - After coding Run ```vendor/bin/phpmd src text cleancode,codesize,controversial,design,naming,unusedcode```. Please try to keep these violations to a minimum; some will be tolerated (eg short/long variable names if they make sense).

- **Add tests!** - Your patch (probably) won't be accepted if it doesn't have tests.

- **Document any change in behaviour** - Make sure the `README.md` and any other relevant documentation are kept up-to-date, if applicable.

- **One pull request per feature** - And please try to submit an issue first, to tie the pull request to.


## Running Tests

``` bash
$ vendor/bin/phpunit
```
