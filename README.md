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

## Basic Usage

The ```Node``` and ```Edge``` classes are designed to be extended by your own if required, so you can use your own entities as nodes or edges within a graph structure. eg:

```php
class Person extends \Graph\Node
{
    [...]
}
```

```GraphContainer``` is the recommended way of storing, adding, removing nodes and edges to ensure consistency.

### Example

```php
$maintainAdjacencyMatrix = true;
$directed = true;
$weighted = false;

$graphCon = new \Graph\GraphContainer(
    $maintainAdjacencyMatrix,
    $directed,
    $weighted
);

$node1 = new \Graph\Node();
$graphCon->addNode($node1);
$node2 = new \Graph\Node();
$graphCon->addNode($node2);
$node3 = new \Graph\Node();
$graphCon->addNode($node3);

// add Edges by Node references
$graphCon->addEdge($node2, $node3);
$graphCon->addEdge($node3, $node1);
$graphCon->addEdge($node2, $node1);

// add Edge from node1 to node2 by (zero-indexed) ids
$graphCon->addEdgeByIds(0, 1);

echo "\nNumber of Nodes: " . count($graphCon->getNodes());
echo "\nNumber of Edges: " . count($graphCon->getEdges());
echo "\nAdjacency Matrix:\n";
print_r($adjacencyMatrix = $graphCon->getAdjacencyMatrix());
```
will output:

```
Number of Nodes: 3
Number of Edges: 4
Adjacency Matrix:
Array
(
    [0] => Array
        (
            [0] => 
            [1] => 1
            [2] => 
        )

    [1] => Array
        (
            [0] => 1
            [1] => 
            [2] => 1
        )

    [2] => Array
        (
            [0] => 1
            [1] => 
            [2] => 
        )

)
```

### Outputting to graph file formats for use by other applications

We can export our graphs to data formats such as GML for use by other applications, such as Gephi:

```php
$gmlOutput = new \Graph\Output\Gml();
$gmlOutput->writeToFile('testGraph.gml', $graphCon);
```
Exporting the very basic graph example above to Gephi:

![alt text](http://rhodrimorris.co.uk/basic-graph.png "basic graph")

