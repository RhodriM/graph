<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph\Test;

/**
 * Description of NodeTest
 *
 * @author rhodrimorris
 */
class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testAddEdge()
    {
        $n = new \Graph\Node();
        $e = new \Graph\Edge(0, 1, 1);
        $n->addEdgeOut($e);
        
        $this->assertEquals(1, count($n->getNeighboursOut()));
        
        $e = new \Graph\Edge(1, 0, 1);
        $n->addEdgeOut($e);
        
        $this->assertEquals(2, count($n->getNeighboursOut()));
        
        $e = new \Graph\Edge(1, 1, 1);
        $n->addEdgeIn($e);
        
        $this->assertEquals(1, count($n->getNeighboursIn()));
    }
}
