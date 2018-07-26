<?php

namespace Graph\Input\Test;

class GmlTest extends \PHPUnit_Framework_TestCase
{
    protected $gmlGood = 'gmlGood.gml';
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
    
    public function testReadFromFileBad2()
    {
        $gml = new \Graph\Input\Gml();
        
        $this->expectException(\Exception::class);
        
        $graph = $gml->readFromFile($this->gmlBad2);
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
        
        $gmlStringBad2 = 
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
        file_put_contents($this->gmlBad1, $gmlStringBad1);
        file_put_contents($this->gmlBad2, $gmlStringBad2);
        file_put_contents($this->gmlIds, $gmlStringIDs);
    }
    
    public function tearDown() {
        parent::tearDown();
        
        unlink($this->gmlGood);
        unlink($this->gmlBad1);
        unlink($this->gmlBad2);
        unlink($this->gmlIds);
    }
}
