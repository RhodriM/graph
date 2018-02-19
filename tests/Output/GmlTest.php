<?php

namespace Graph\Output\Test;

class GmlTest extends \PHPUnit_Framework_TestCase
{
    public function testWriteToFile()
    {
        $graphCon = new \Graph\GraphContainer();

        $node1 = new \Graph\Node();
        $node2 = new \Graph\Node();
        $node3 = new \Graph\Node();
        $node3->name = 'testLabel';
        $node4 = new \Graph\Node();

        $graphCon->addNode($node1);
        $graphCon->addNode($node2);
        $graphCon->addNode($node3);
        $graphCon->addNode($node4);

        $graphCon->addEdge($node1, $node2);
        $graphCon->addEdge($node2, $node3);
        $graphCon->addEdge($node3, $node4);
        $graphCon->addEdge($node1, $node4);
        
        $gmlOutput = new \Graph\Output\Gml();
        $gmlOutput->writeToFile('testGraphUnweighted1.gml', $graphCon);
        
        $this->assertFileExists('testGraphUnweighted1.gml');
        $gmlString = file_get_contents('testGraphUnweighted1.gml');
        $this->assertNotFalse(strpos($gmlString, 'testLabel'));
        $this->assertNotFalse(strpos($gmlString, 'directed 0'));
        
        unlink('testGraphUnweighted1.gml');

        // now same but directed graph
        $graphCon = new \Graph\GraphContainer(true, true, true);

        $node1 = new \Graph\Node();
        $node2 = new \Graph\Node();
        $node3 = new \Graph\Node();
        $node3->colour = '#FFFFFF';
        $node4 = new \Graph\Node();

        $graphCon->addNode($node1);
        $graphCon->addNode($node2);
        $graphCon->addNode($node3);
        $graphCon->addNode($node4);

        $graphCon->addEdge($node1, $node2, 1);
        $graphCon->addEdge($node2, $node3, 2);
        $graphCon->addEdge($node3, $node4, 2, 'testEdgeLabel');
        $graphCon->addEdge($node1, $node4, 4);

        $gmlOutput = new \Graph\Output\Gml();
        $gmlOutput->writeToFile('testGraphDirectedWeighted1.gml', $graphCon);
        
        $this->assertFileExists('testGraphDirectedWeighted1.gml');
        $gmlString = file_get_contents('testGraphDirectedWeighted1.gml');
        $this->assertNotFalse(strpos($gmlString, 'directed 1'));
        $this->assertNotFalse(strpos($gmlString, 'value 4'));
        $this->assertNotFalse(strpos($gmlString, 'testEdgeLabel'));
        
        unlink('testGraphDirectedWeighted1.gml');
    }
}
