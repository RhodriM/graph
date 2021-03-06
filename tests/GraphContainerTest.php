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
    
    public function testAddNodesWithIds()
    {
        $graphCon = new \Graph\GraphContainer();
        $n = new \Graph\Node();
        $n->id = 2;
        $n->name = 'node 2';
        $graphCon->addNode($n, $n->id);
        
        $this->assertEquals(1, count($graphCon->getNodes()));
        $this->assertEquals(2, $graphCon->getNodes()[2]->id);
        $this->assertFalse(array_key_exists(0, $graphCon->getNodes()));
        
        $n = new \Graph\Node();
        $n->id = 1;
        $n->name = 'node 1';
        $graphCon->addNode($n, $n->id);
        
        $this->assertEquals(2, count($graphCon->getNodes()));
        $this->assertFalse(array_key_exists(0, $graphCon->getNodes()));
        
        $n = new \Graph\Node();
        $n->id = 0;
        $n->name = 'node 0';
        $graphCon->addNode($n, $n->id);
        
        $n = new \Graph\Node();
        $n->name = 'node n';
        $graphCon->addNode($n);
        
        $this->assertEquals('node 0', $graphCon->getNodes()[0]->name);
        $this->assertEquals('node 1', $graphCon->getNodes()[1]->name);
        $this->assertEquals('node 2', $graphCon->getNodes()[2]->name);
        $this->assertEquals('node n', $graphCon->getNodes()[3]->name);
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
        
        $graphCon->addEdge($n1, $n2, 3);
        
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
    
    public function testAddEdgeById()
    {
        // directed graph
        $graphCon = new \Graph\GraphContainer(true, true, true);
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdgeByIds($n1->id, $n2->id, 3);
        
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
    
    public function testFindEdgeInOutList()
    {
        $graphCon = new \Graph\GraphContainer();
        
        $n1 = new \Graph\Node();
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $n3 = new \Graph\Node();
        $graphCon->addNode($n3);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $edge = $graphCon->findEdgeInOutList(0, 1);
        $this->assertEquals(1, $edge->to);
    }
    
    public function testClone()
    {
        $graphCon = new \Graph\GraphContainer();
        
        $n1 = new \Graph\Node();
        $n1->name = 'test123';
        $graphCon->addNode($n1);
        
        $n2 = new \Graph\Node();
        $graphCon->addNode($n2);
        
        $graphCon->addEdge($n1, $n2, 1);
        
        $graphCon2 = clone $graphCon;
        
        $graphCon2->getNodes()[0]->name = 'test321';
        
        $this->assertEquals('test123', $graphCon->getNodes()[0]->name);
        $this->assertEquals('test321', $graphCon2->getNodes()[0]->name);
        
        $this->assertNotEquals(
            spl_object_hash($graphCon->getEdges()[0]),
            spl_object_hash($graphCon2->getEdges()[0])
        );
    }
}
