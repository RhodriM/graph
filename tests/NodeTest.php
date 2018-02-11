<?php

namespace Graph\Test;

class NodeTest extends \PHPUnit_Framework_TestCase
{
    public function testAddEdge()
    {
        $n = new \Graph\Node();
        
        // test add edge out
        $e = new \Graph\Edge(0, 1, 1);
        $n->addEdgeOut($e);
        $this->assertEquals(1, count($n->getNeighboursOut()));
        
        // test comparison of edges - does edge exist in edges out?
        $eSame = new \Graph\Edge(0, 1, 1);
        $this->assertTrue($n->edgeOutExists($eSame));
        $this->assertFalse($n->edgeInExists($eSame));
        
        $e = new \Graph\Edge(1, 0, 1);
        $n->addEdgeOut($e);
        $this->assertEquals(2, count($n->getNeighboursOut()));
        
        // test comparison of edges - does edge exist in edges in?
        $e = new \Graph\Edge(1, 1, 1);
        $n->addEdgeIn($e);
        $this->assertEquals(1, count($n->getNeighboursIn()));
        $eSame = new \Graph\Edge(1, 1, 1);
        $this->assertTrue($n->edgeInExists($eSame));
    }
    
    public function testRemoveEdge()
    {
        $n = new \Graph\Node();
        
        $e = new \Graph\Edge(0, 1, 1);
        $n->addEdgeOut($e);
        $e = new \Graph\Edge(1, 0, 1);
        $n->addEdgeOut($e);
        
        $this->assertEquals(2, count($n->getNeighboursOut()));
        
        $n->removeEdgeOut(new \Graph\Edge(0, 1, 1));
        $this->assertEquals(1, count($n->getNeighboursOut()));
        $this->assertFalse($n->edgeOutExists(new \Graph\Edge(0, 1, 1)));
        $this->assertTrue($n->edgeOutExists(new \Graph\Edge(1, 0, 1)));
        
        // remove edge which doesn't exist
        $n->removeEdgeOut(new \Graph\Edge(2, 1, 1));
        
        // ---- edge in ----
        
        $n = new \Graph\Node();
        
        $e = new \Graph\Edge(0, 1, 1);
        $n->addEdgeIn($e);
        $e = new \Graph\Edge(1, 0, 1);
        $n->addEdgeIn($e);
        
        $this->assertEquals(2, count($n->getNeighboursIn()));
        
        $n->removeEdgeIn(new \Graph\Edge(0, 1, 1));
        $this->assertEquals(1, count($n->getNeighboursIn()));
        $this->assertFalse($n->edgeInExists(new \Graph\Edge(0, 1, 1)));
        $this->assertTrue($n->edgeInExists(new \Graph\Edge(1, 0, 1)));
        
        // remove edge which doesn't exist
        $n->removeEdgeIn(new \Graph\Edge(2, 1, 1));
    }
}
