<?php

namespace Graph\Test;

class GraphContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testConstruct()
    {
        $graphCon = new \Graph\GraphContainer();
        $this->assertInstanceOf(\Graph\GraphContainer::class, $graphCon);
        $graphCon = new \Graph\GraphContainer(true);
        $this->assertInstanceOf(\Graph\GraphContainer::class, $graphCon);
        $graphCon = new \Graph\GraphContainer(true, true);
        $this->assertInstanceOf(\Graph\GraphContainer::class, $graphCon);
        $graphCon = new \Graph\GraphContainer(true, true, true);
    }
    
    public function testAddNode()
    {
        $graphCon = new \Graph\GraphContainer();
        $n = new \Graph\Node();
        $graphCon->addNode($n);
        
        $this->assertEquals(1, count($graphCon->getNodes()));
        $this->assertEquals(0, $n->id);
        
        $n = new \Graph\Node();
        $graphCon->addNode($n);
        
        $this->assertEquals(2, count($graphCon->getNodes()));
        $this->assertEquals(1, $n->id);
    }
    
    public function testGetNewAdjacencyMatrix()
    {
        $graphCon = new \Graph\GraphContainer(true);
        
        $n = new \Graph\Node();
        $graphCon->addNode($n);
        
        $n = new \Graph\Node();
        $graphCon->addNode($n);
        
        $n = new \Graph\Node();
        $graphCon->addNode($n);
        
        $this->assertEquals(
            array(
                0 => array(0 => null, 1 => null, 2 => null),
                1 => array(0 => null, 1 => null, 2 => null),
                2 => array(0 => null, 1 => null, 2 => null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
    }
    
    public function testAddEdgeDirected()
    {
        // directed graph
        $graphCon = new \Graph\GraphContainer(true, true);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(0, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 1, null),
                array(null, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(1, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
    }
    
    public function testAddEdgeUnDirected()
    {        
        // undirected graph
        $graphCon = new \Graph\GraphContainer(true, false);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(1, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 1, null),
                array(1, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(2, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
    }
    
    public function testAddEdgeDirectedWeighted()
    {
        // directed graph
        $graphCon = new \Graph\GraphContainer(true, true, true);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2,3);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(0, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 3, null),
                array(null, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(1, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
    }
    
    public function testAddEdgeUnDirectedWeighted()
    {        
        // undirected graph
        $graphCon = new \Graph\GraphContainer(true, false, true);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 2);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(1, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 2, null),
                array(2, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(2, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
    }
    
    public function testIsDirected()
    {
        $graphCon = new \Graph\GraphContainer();
        // use assertNotTrue as assertFalse does a strict comparison on type
        $this->assertNotTrue($graphCon->isDirected());
        $this->assertEquals(0, $graphCon->isDirected());
        $this->assertEquals(false, $graphCon->isDirected());
        
        $graphCon = new \Graph\GraphContainer(true);
        // use assertNotTrue as assertFalse does a strict comparison on type
        $this->assertNotTrue($graphCon->isDirected());
        $this->assertEquals(0, $graphCon->isDirected());
        $this->assertEquals(false, $graphCon->isDirected());
        
        $graphCon = new \Graph\GraphContainer(true, true);
        // use assertNotFalse as assertTrue does a strict comparison on type
        $this->assertNotFalse($graphCon->isDirected());
        $this->assertEquals(1, $graphCon->isDirected());
        $this->assertEquals(true, $graphCon->isDirected());
        
        $graphCon = new \Graph\GraphContainer(true, true, true);
        // use assertNotFalse as assertTrue does a strict comparison on type
        $this->assertNotFalse($graphCon->isDirected());
        $this->assertEquals(1, $graphCon->isDirected());
        $this->assertEquals(true, $graphCon->isDirected());
    }
    
    public function testRemoveEdgeDirected()
    {
        // directed graph
        $graphCon = new \Graph\GraphContainer(true, true);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(0, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 1, null),
                array(null, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(1, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
        
        // remove edge which doesn't exist
        $graphCon->removeEdge(new \Graph\Edge(11, 12, 1));
        
        // remove edge
        $graphCon->removeEdge(new \Graph\Edge($n1->id, $n2->id, 1));
        $this->assertEquals(0, count($graphCon->getEdges()));
        $this->assertFalse($n1->edgeOutExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        $this->assertFalse($n2->edgeInExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        
        $this->assertEquals(
            array(
                array(null, null, null),
                array(null, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
    }
    
    public function testRemoveEdgeUnDirected()
    {        
        // undirected graph
        $graphCon = new \Graph\GraphContainer(true, false);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $this->assertEquals(1, count($n1->getNeighboursOut()));
        $this->assertEquals(1, count($n1->getNeighboursIn()));
        $this->assertEquals(
            array(
                array(null, 1, null),
                array(1, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
        
        $this->assertEquals(2, count($graphCon->getEdges()));
        $this->assertInstanceOf(\Graph\Edge::class, $graphCon->getEdges()[0]);
        
        $graphCon->removeEdge(new \Graph\Edge($n1->id, $n2->id, 1));
        $this->assertEquals(0, count($graphCon->getEdges()));
        $this->assertFalse($n1->edgeOutExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        $this->assertFalse($n2->edgeInExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        $this->assertFalse($n2->edgeOutExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        $this->assertFalse($n1->edgeInExists(new \Graph\Edge($n1->id, $n2->id, 1)));
        
        $this->assertEquals(
            array(
                array(null, null, null),
                array(null, null, null),
                array(null, null, null)
            ),
            $graphCon->getAdjacencyMatrix()
        );
    }
}
