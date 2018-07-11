<?php

namespace Graph\Search\Test;

class AllSimplePathsFromNodeTest extends \PHPUnit_Framework_TestCase
{
    public function setupGraph()
    {
        $graph = new \Graph\GraphContainer();
        
        for ($i = 0; $i < 9; $i++) {
            $node = new \Graph\Node();
            $graph->addNode($node);
        }
        
        $graph->addEdgeByIds(0, 1, 3);
        $graph->addEdgeByIds(0, 2, 5);
        $graph->addEdgeByIds(0, 3, 7);
        $graph->addEdgeByIds(1, 3, 1);
        $graph->addEdgeByIds(1, 4, 7);
        $graph->addEdgeByIds(2, 3, 3);
        $graph->addEdgeByIds(2, 5, 2);
        $graph->addEdgeByIds(3, 4, 2);
        $graph->addEdgeByIds(3, 5, 3);
        $graph->addEdgeByIds(3, 6, 1);
        $graph->addEdgeByIds(4, 6, 2);
        $graph->addEdgeByIds(4, 7, 1);
        $graph->addEdgeByIds(5, 6, 3);
        $graph->addEdgeByIds(5, 8, 4);
        $graph->addEdgeByIds(6, 7, 3);
        $graph->addEdgeByIds(6, 8, 2);
        $graph->addEdgeByIds(7, 8, 5);
        
        return $graph;
    }
    
    public function testGetSimplePathsFromNode()
    {
        $graph = $this->setupGraph();
        
        $aspfn = new \Graph\Search\AllSimplePathsFromNode($graph, $graph->getNodes()[0], 2);
        $paths = $aspfn->getSimplePathsFromNode();

        $this->assertEquals(12, count($paths));
        $this->assertTrue(in_array(array(0, 1), $paths));
        $this->assertTrue(in_array(array(0, 1, 3), $paths));
        $this->assertFalse(in_array(array(0, 1, 3, 2), $paths));
        
        $aspfn = new \Graph\Search\AllSimplePathsFromNode($graph, $graph->getNodes()[0], 3);
        $paths = $aspfn->getSimplePathsFromNode();

        $this->assertEquals(38, count($paths));
        $this->assertTrue(in_array(array(0, 1), $paths));
        $this->assertTrue(in_array(array(0, 1, 3), $paths));
        $this->assertTrue(in_array(array(0, 1, 3, 2), $paths));
    }
}
