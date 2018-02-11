<?php

/* 
 * The MIT License
 *
 * Copyright 2018 Rhodri Morris.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
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
