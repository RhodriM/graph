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
(usually by adding
```require __DIR__ . '/vendor/autoload.php';```
at the top of your script).

### Basic Usage

The ```Node``` and ```Edge``` classes are designed to be extended by your own if required, so you can use your own entities as nodes or edges within a graph structure. eg:

```php
class Person extends \Graph\Node
{
    [...]
}
```

```GraphContainer``` is the recommended way of storing, adding, removing nodes and edges to ensure consistency.

```php
$maintainAdjacencyMatrix = false;
$directed = true;
$weighted = false;

$graphCon = new \Graph\GraphContainer(
    $maintainAdjacencyMatrix,
    $directed,
    $weighted
);
```
