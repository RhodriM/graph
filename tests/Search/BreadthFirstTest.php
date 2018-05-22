<?php

namespace Graph\Search\Test;

class BreadthFirstTest extends \PHPUnit_Framework_TestCase
{
    public function testReturnNodesByHopsFrom()
    {
        $graph = new \Graph\GraphContainer();
        
        // create a lattice where links are manhatten distance 1
        // 0-1-2-3
        // | | | |
        // 4-5-6-7
        // | | | |
        // ... etc ...
        for ($i = 0; $i < 16; $i++) {
            $node = new \Graph\Node();
            $graph->addNode($node);
        }
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(1, 2);
        $graph->addEdgeByIds(2, 3);
        $graph->addEdgeByIds(4, 5);
        $graph->addEdgeByIds(5, 6);
        $graph->addEdgeByIds(6, 7);
        $graph->addEdgeByIds(8, 9);
        $graph->addEdgeByIds(9, 10);
        $graph->addEdgeByIds(10, 11);
        $graph->addEdgeByIds(12, 13);
        $graph->addEdgeByIds(13, 14);
        $graph->addEdgeByIds(14, 15);
        $graph->addEdgeByIds(0, 4);
        $graph->addEdgeByIds(4, 8);
        $graph->addEdgeByIds(8, 12);
        $graph->addEdgeByIds(1, 5);
        $graph->addEdgeByIds(5, 9);
        $graph->addEdgeByIds(9, 13);
        $graph->addEdgeByIds(2, 6);
        $graph->addEdgeByIds(6, 10);
        $graph->addEdgeByIds(10, 14);
        $graph->addEdgeByIds(3, 7);
        $graph->addEdgeByIds(7, 11);
        $graph->addEdgeByIds(11, 15);
        
        
        $bfs = new \Graph\Search\BreadthFirst($graph);
        
        $distances = $bfs->returnNodesByHopsFrom($graph->getNodes()[5]);
        
        // distances from node 5
        $this->assertEquals(0, $distances[5]);
        $this->assertEquals(1, $distances[1]);
        $this->assertEquals(2, $distances[8]);
        $this->assertEquals(3, $distances[11]);
        $this->assertEquals(4, $distances[15]);
        
        // only return nodes within 2 hops
        $limitedDistances = $bfs->returnNodesByHopsFrom($graph->getNodes()[5], 2);
        
        $this->assertEquals(11, count($limitedDistances));
        $this->assertEquals(2, $distances[8]);
    }
}
