<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph\Test;
/**
 * Description of GraphContainerTest
 *
 * @author rhodrimorris
 */
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
    }
}
