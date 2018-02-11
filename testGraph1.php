<?php

require __DIR__ . '/vendor/autoload.php';

$graphCon = new \Graph\GraphContainer();

$node1 = new \Graph\Node();
$node2 = new \Graph\Node();
$node3 = new \Graph\Node();
$node4 = new \Graph\Node();

$graphCon->addNode($node1);
$graphCon->addNode($node2);
$graphCon->addNode($node3);
$graphCon->addNode($node4);

$graphCon->addEdge($node1, $node2);
$graphCon->addEdge($node2, $node3);
$graphCon->addEdge($node3, $node4);
$graphCon->addEdge($node1, $node4);

$gmlOutput = new \Graph\Output\Gml();
$gmlOutput->writeToFile('testGraphUnweighted1.gml', $graphCon);

$graphCon = new \Graph\GraphContainer(true, true, true);

$node1 = new \Graph\Node();
$node2 = new \Graph\Node();
$node3 = new \Graph\Node();
$node4 = new \Graph\Node();

$graphCon->addNode($node1);
$graphCon->addNode($node2);
$graphCon->addNode($node3);
$graphCon->addNode($node4);

$graphCon->addEdge($node1, $node2, 1);
$graphCon->addEdge($node2, $node3, 2);
$graphCon->addEdge($node3, $node4, 2);
$graphCon->addEdge($node1, $node4, 4);

$gmlOutput = new \Graph\Output\Gml();
$gmlOutput->writeToFile('testGraphDirectedWeighted1.gml', $graphCon);