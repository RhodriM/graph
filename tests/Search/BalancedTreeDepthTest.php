<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph\Search\Test;

/**
 * Description of BalancedTreeDepthTest
 *
 * @author rhodri
 */
class BalancedTreeDepthTest extends \PHPUnit_Framework_TestCase
{
    public function testGetDistanceToRoot()
    {
        $graph = new \Graph\GraphContainer();
        
        // create binary tree, depth 3
        for ($i = 0; $i < 15; $i++) {
            $node = new \Graph\Node();
            $graph->addNode($node);
        }
        
        $graph->addEdgeByIds(0, 1);
        $graph->addEdgeByIds(0, 2);
        $graph->addEdgeByIds(1, 3);
        $graph->addEdgeByIds(1, 4);
        $graph->addEdgeByIds(2, 5);
        $graph->addEdgeByIds(2, 6);
        $graph->addEdgeByIds(3, 7);
        $graph->addEdgeByIds(3, 8);
        $graph->addEdgeByIds(4, 9);
        $graph->addEdgeByIds(4, 10);
        $graph->addEdgeByIds(5, 11);
        $graph->addEdgeByIds(5, 12);
        $graph->addEdgeByIds(6, 13);
        $graph->addEdgeByIds(6, 14);
        
        $balancedTreeDepth = new \Graph\Search\BalancedTreeDepth($graph, $graph->getNodes()[14]);
        
        $this->assertEquals(3, $balancedTreeDepth->getDistanceToRoot());
        
        $balancedTreeDepth = new \Graph\Search\BalancedTreeDepth($graph, $graph->getNodes()[4]);
        
        $this->assertEquals(2, $balancedTreeDepth->getDistanceToRoot());
    }
}
