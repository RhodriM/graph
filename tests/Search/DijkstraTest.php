<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph\Search\Test;

/**
 * Description of DijkstraTest
 *
 * @author rhodri
 */
class DijkstraTest extends \PHPUnit_Framework_TestCase
{
    public function testDijkstra()
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
        
        $dijkstra = new \Graph\Search\Dijkstra($graph);
        
        list($dist, $prev) = ($dijkstra->dijkstra($graph->getNodes()[0]));
        
        $this->assertEquals(6, $dist[4]);
        $this->assertEquals(7, $dist[7]);
        $this->assertEquals(6, $prev[8]);
        $this->assertEquals(3, $prev[6]);
        $this->assertEquals(1, $prev[3]);
        $this->assertEquals(0, $prev[1]);
    }
    
    public function testGetEdgesBetween()
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
        
        $dijkstra = new \Graph\Search\Dijkstra($graph);
        
        $edges = $dijkstra->getEdgesBetween(0, 8);

        $this->assertEquals(4, count($edges));
        $this->assertEquals(3, $edges[1]->to);
        $this->assertEquals(3, $edges[3]->weight);
    }
}
