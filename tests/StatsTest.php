<?php

namespace Graph\Test;

/**
 * Description of StatsTest
 *
 * @author rhodri
 */
class StatsTest  extends \PHPUnit_Framework_TestCase
{
    public function testGetAverageDegree()
    {
        $graph = new \Graph\GraphContainer();
        
        $node0 = new \Graph\Node();
        $graph->addNode($node0);
        
        $node1 = new \Graph\Node();
        $graph->addNode($node1);
        
        $node2 = new \Graph\Node();
        $graph->addNode($node2);
        
        $node3 = new \Graph\Node();
        $graph->addNode($node3);
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(0, 2);
        $graph->addEdgeByIds(0, 3);
        
        $stats = new \Graph\Stats($graph);
        $this->assertEquals(1.5, $stats->getAverageDegree());
        
        //should also work directed:
        
        $graph = new \Graph\GraphContainer(true, true, true);
        
        $node0 = new \Graph\Node();
        $graph->addNode($node0);
        
        $node1 = new \Graph\Node();
        $graph->addNode($node1);
        
        $node2 = new \Graph\Node();
        $graph->addNode($node2);
        
        $node3 = new \Graph\Node();
        $graph->addNode($node3);
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(0, 2);
        $graph->addEdgeByIds(0, 3);
        
        $stats = new \Graph\Stats($graph);
        $this->assertEquals(0.75, $stats->getAverageDegree());
    }
    
    public function testGetNetworkDensity()
    {
        $graph = new \Graph\GraphContainer();
        
        $node0 = new \Graph\Node();
        $graph->addNode($node0);
        
        $node1 = new \Graph\Node();
        $graph->addNode($node1);
        
        $node2 = new \Graph\Node();
        $graph->addNode($node2);
        
        $node3 = new \Graph\Node();
        $graph->addNode($node3);
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(0, 2);
        $graph->addEdgeByIds(0, 3);
        
        $stats = new \Graph\Stats($graph);
        $this->assertEquals(0.5, $stats->getNetworkDensity());
        
        //should also work directed:
        
        $graph = new \Graph\GraphContainer(true, true, true);
        
        $node0 = new \Graph\Node();
        $graph->addNode($node0);
        
        $node1 = new \Graph\Node();
        $graph->addNode($node1);
        
        $node2 = new \Graph\Node();
        $graph->addNode($node2);
        
        $node3 = new \Graph\Node();
        $graph->addNode($node3);
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(0, 2);
        $graph->addEdgeByIds(0, 3);
        
        $stats = new \Graph\Stats($graph);
        $this->assertEquals(0.25, $stats->getNetworkDensity());
    }
}
