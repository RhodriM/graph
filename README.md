# RhodriM/graph
A very simple implementation of a Graph data structure.

## Installation

### Composer

It is highly recommended that you use composer to install this library.

[Get Composer](https://getcomposer.org/doc/00-intro.md)

Add the following to the repositories and require sections of your composer.json : 
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/RhodriM/graph"
    }
],
"require": {
    "RhodriM/graph": "v0.6"
}
```

run ```composer update``` and use the supplied autoloader
(usually by adding ```require __DIR__ . '/vendor/autoload.php';``` at the top of your script).
