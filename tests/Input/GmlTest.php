<?php

namespace Graph\Input\Test;

class GmlTest extends \PHPUnit_Framework_TestCase
{
    protected $gmlGood = 'gmlGood.gml';
    protected $gmlGood2 = 'gmlGood2.gml';
    protected $gmlGood3 = 'gmlGood3.gml';
    protected $gmlBad1 = 'gmlBad1.gml';
    protected $gmlBad2 = 'gmlBad2.gml';
    protected $gmlIds = 'gmlIds.gml';
    
    public function testReadFromFileGood()
    {
        $gml = new \Graph\Input\Gml();
        
        $graph = $gml->readFromFile($this->gmlGood);
        
        $this->assertTrue(is_a($graph, \Graph\GraphContainer::class));
        $this->assertFalse($graph->isDirected());
        
        $this->assertEquals(3, count($graph->getNodes()));
        // 4 edges in undirected graph
        $this->assertEquals(4, count($graph->getEdges()));
    }
    
    public function testReadFromFileGood2()
    {
        $gml = new \Graph\Input\Gml();
        
        $graph = $gml->readFromFile($this->gmlGood2);
        
        $this->assertTrue(is_a($graph, \Graph\GraphContainer::class));
        $this->assertFalse($graph->isDirected());
        
        $this->assertEquals(3, count($graph->getNodes()));
        // 4 edges in undirected graph
        $this->assertEquals(4, count($graph->getEdges()));
    }
    
    public function testReadFromFileGood3()
    {
        $gml = new \Graph\Input\Gml();
        
        $graph = $gml->readFromFile($this->gmlGood3);
        
        $this->assertTrue(is_a($graph, \Graph\GraphContainer::class));
        $this->assertFalse($graph->isDirected());
        
        $this->assertEquals(2, count($graph->getNodes()));
        // 2 edges in undirected graph, 1 each way
        $this->assertEquals(2, count($graph->getEdges()));

        $this->assertEquals("4,5,0,5,0", $graph->getNodes()[0]->label);
    }

    public function testReadFromFileIdsOrder()
    {
        $gml = new \Graph\Input\Gml();
        
        $graph = $gml->readFromFile($this->gmlIds);
        
        $this->assertTrue(is_a($graph, \Graph\GraphContainer::class));
        $this->assertFalse($graph->isDirected());
        
        $this->assertEquals(3, count($graph->getNodes()));
        // 4 edges in undirected graph
        $this->assertEquals(4, count($graph->getEdges()));
    }
    
    public function setUp() {
        parent::setUp();
        
        $gmlStringGood = 
            "graph [\n" .
            "\tcomment \"This is a sample graph\"\n" .
            "\tdirected 0\n" .
            "\tnode [\n" .
            "\t\tid 0\n" .
            "\t\tlabel \"node 0\"\n" . 
            "\t\tsampleAttr 42\n" .
            "\t]\n" .
            "\tnode [\n" .
            "\t\tid 1\n" .
            "\t\tlabel \"node 1\"\n" . 
            "\t]\n" .
            "\tnode [\n" .
            "\t\tid 2\n" .
            "\t]\n" .
            "\tedge [\n" .
            "\t\tsource 0\n" .
            "\t\ttarget 1\n" .
            "\t\tlabel \"edge 0 to 1\"\n" .
            "\t]\n" .
            "\tedge [\n" .
            "\t\tsource 1\n" .
            "\t\ttarget 2\n" .
            "\t]\n";
        
        $gmlStringGood2 = 
            "graph\n[\n" .
            "\tcomment \"This is a sample graph\"\n" .
            "\tdirected 0\n" .
            "\tnode\n\t[\n" .
            "\t\tid 0\n" .
            "\t\tlabel \"node 0\"\n" . 
            "\t\tsampleAttr 42\n" .
            "\t]\n" .
            "\tnode\n\t[\n" .
            "\t\tid 1\n" .
            "\t\tlabel \"node 1\"\n" . 
            "\t]\n" .
            "\tnode\n\t[\n" .
            "\t\tid 2\n" .
            "\t]\n" .
            "\tedge\n\t[\n" .
            "\t\tsource 0\n" .
            "\t\ttarget 1\n" .
            "\t\tlabel \"edge 0 to 1\"\n" .
            "\t]\n" .
            "\tedge\n\t[\n" .
            "\t\tsource 1\n" .
            "\t\ttarget 2\n" .
            "\t]\n";
        
        $gmlStringGood3 = 
            "graph [\n" .
            "  node [\n" .
            "    id 0\n" .
            "    label \"4,5,0,5,0\"\n" .
            "  ]\n" .
            "  node [\n" .
            "    id 1\n" .
            "    label \"4,5,0,5,0\"\n" .
            "  ]\n" .
            "  edge [\n" .
            "    source 0\n" .
            "    target 1\n" .
            "  ]\n" .
            "]";
        
        $gmlStringIDs = 
            "graph [\n" .
            "\tcomment \"This is a sample graph\"\n" .
            "\tdirected 0\n" .
            "\tnode [\n" .
            "\t\tid 2\n" .
            "\t\tlabel \"node 2\"\n" . 
            "\t\tsampleAttr 42\n" .
            "\t]\n" .
            "\tnode [\n" .
            "\t\tid 1\n" .
            "\t\tlabel \"node 1\"\n" . 
            "\t]\n" .
            "\tnode [\n" .
            "\t\tid 0\n" .
            "\t]\n" .
            "\tedge [\n" .
            "\t\tsource 0\n" .
            "\t\ttarget 1\n" .
            "\t\tlabel \"edge 0 to 1\"\n" .
            "\t]\n" .
            "\tedge [\n" .
            "\t\tsource 1\n" .
            "\t\ttarget 2\n" .
            "\t]\n";
        
        $gmlStringBad1 = 
            "graph [\n" .
            "\tcomment \"This is a sample graph\"\n" .
            "\tdirected 0\n" .
            "\tnode [\n" .
            "\t\tid 0\n" .
            "\t\tlabel \"node 0\"\n" . 
            "\t\tsampleAttr 42\n" .
            "\tnode [\n" .
            "\t\tid 1\n" .
            "\t\tlabel \"node 1\"\n" . 
            "\t]\n";
        
        file_put_contents($this->gmlGood, $gmlStringGood);
        file_put_contents($this->gmlGood2, $gmlStringGood2);
        file_put_contents($this->gmlGood3, $gmlStringGood3);
        file_put_contents($this->gmlBad1, $gmlStringBad1);
        file_put_contents($this->gmlIds, $gmlStringIDs);
    }
    
    public function tearDown() {
        parent::tearDown();
        
        unlink($this->gmlGood);
        unlink($this->gmlGood2);
        unlink($this->gmlGood3);
        unlink($this->gmlBad1);
        unlink($this->gmlIds);
    }
}
