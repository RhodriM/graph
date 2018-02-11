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
 * GraphContainer manages storing, adding, removing nodes and edges, maintaining
 * consistency, adjacency matrices etc.
 *
 * @author rhodrimorris
 */
class GraphContainer
{
    /**
     * @var array
     */
    protected $nodes;
    
    /**
     * @var array
     */
    protected $edges;
    
    /**
     * Whether to maintain an adjacency matrix as nodes/edges are added.
     * @var bool
     */
    protected $maintainAdjacencyMatrix;
    
    /**
     * 2D array serving as adjacency matrix
     * @var array
     */
    protected $adjacencyMatrix;
    
    /**
     * @var bool
     */
    protected $directed;
    
    /**
     * If graph is not weighted, all edge weights are 1.
     * @var bool
     */
    protected $weighted;
    
    /**
     * Configures graphContainer instance and creates adjacency matrix if
     * required
     * 
     * @param bool $maintainAdjacencyMatrix
     * @param bool $directed
     * @param bool $weighted
     */
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
    
    /**
     * Adds a node, assigning it an incremental ID. Also updates adjacency
     * matrix if required.
     * 
     * @param \Graph\Node $n
     */
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
    
    /**
     * Creates an edge from node to node. Also updates adjacency matrix if
     * required. If graph is undirected, also creates corresponding reverse
     * edge.
     * 
     * @param \Graph\Node $from
     * @param \Graph\Node $to
     * @param int|float $weight
     * @param String $label
     */
    public function addEdge(Node &$from, Node &$to, $weight = 1, $label = '')
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
            // add corresponding reverse edge for unweighted graphs
            $this->addEdge($to, $from, $weight, $label);
        }
    }
    
    /**
     * @return array
     */
    public function getAdjacencyMatrix()
    {
        return $this->adjacencyMatrix;
    }
    
    /**
     * @return array
     */
    public function getNodes()
    {
        return $this->nodes;
    }
    
    /**
     * @return array
     */
    public function getEdges()
    {
        return $this->edges;
    }
    
    /**
     * @return int
     */
    public function isDirected()
    {
        return intval($this->directed);
    }
}
