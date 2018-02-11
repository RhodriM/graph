<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph;

/**
 * Description of GraphContainer
 *
 * @author rhodrimorris
 */
class GraphContainer
{
    protected $nodes;
    protected $edges;
    protected $maintainAdjacencyMatrix;
    protected $adjacencyMatrix;
    protected $directed;
    protected $weighted;
    
    public function __construct(
        $maintainAdjacencyMatrix = false,
        $directed = false,
        $weighted = false
    ) {
        $this->maintainAdjacencyMatrix = $maintainAdjacencyMatrix;
        $this->directed = $directed;
        $this->weighted = $weighted;
        
        if ($maintainAdjacencyMatrix) {
            $this->adjacencyMatrix = array(array());
        }
    }
    
    public function addNode(Node $n)
    {
        $n->id = count($this->nodes);
        $this->nodes[] = $n;
        
        if ($this->maintainAdjacencyMatrix) {
            $this->adjacencyMatrix[$n->id] = array();
            for ($i = 0; $i < count($this->adjacencyMatrix); $i++) {
                $this->adjacencyMatrix[$n->id][$i] = null;
                $this->adjacencyMatrix[$i][$n->id] = null;
            }
        }
    }
    
    public function addEdge(Node &$from, Node &$to, $weight = 1, $label = 0)
    {
        $edge = new Edge($from->id, $to->id, $weight);
        if ($label != '') {
            $edge->label = $label;
        }
        
        $from->addEdgeOut($edge);
        $to->addEdgeIn($edge);
        
        $this->edges[] = $edge;
        
        if ($this->maintainAdjacencyMatrix) {
            $this->adjacencyMatrix[$from->id][$to->id] = $weight;
        }
        
        $reversedEdge = new Edge($to->id, $from->id, $weight, $label);
        
        if (!$this->directed && !$to->edgeOutExists($reversedEdge)) {
            $this->addEdge($to, $from, $weight);
        }
    }
    
    public function getAdjacencyMatrix()
    {
        return $this->adjacencyMatrix;
    }
    
    public function getNodes()
    {
        return $this->nodes;
    }
    
    public function getEdges()
    {
        return $this->edges;
    }
    
    public function isDirected()
    {
        return intval($this->directed);
    }
}
