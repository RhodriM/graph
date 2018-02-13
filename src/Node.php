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
 * Simple representation of node class. Intended to be extended by, or contained
 * within, any object you wish to represent as a graph node.
 *
 * @author rhodrimorris
 */
class Node
{
    /**
     * Unique identifier. Usually set by GraphContainer.
     * @var int
     */
    public $id;
    
    /**
     * Optional label - may be used by external software (ie Gephi) that graph
     * is exported to.
     * @var String
     */
    public $name = '';
    
    /**
     * Array of out edges. In undirected graph each edge out will have a
     * corresponding entry in edgesIn. Recommended to only add edges through
     * GraphContainer for this reason.
     * @var array
     */
    protected $edgesOut;
    
    /**
     * Array of in edges. In undirected graph each edge in will have a
     * corresponding entry in edgesOut. Recommended to only add edges through
     * GraphContainer for this reason.
     * @var array
     */
    protected $edgesIn;
    
    /**
     * Optional colour for displaying in some graphing software
     * @var String
     */
    public $colour;
    
    /**
     * Initialises edges arrays and sets optional name if passed.
     *
     * @param String $name
     */
    public function __construct($name = '')
    {
        $this->edgesIn = array();
        $this->edgesOut = array();
        $this->name = $name;
        $this->colour = '';
    }
    
    /**
     * Adds edge to edgesOut - note pass by reference
     * @param \Graph\Edge $e
     */
    public function addEdgeOut(Edge &$e)
    {
        $this->edgesOut[] = $e;
    }
    
    /**
     * Adds edge to edgesIn - note pass by reference
     * @param \Graph\Edge $e
     */
    public function addEdgeIn(Edge &$e)
    {
        $this->edgesIn[] = $e;
    }
    
    public function removeEdgeOut(Edge $edge)
    {
        for ($i = 0; $i < count($this->edgesOut); $i++) {
            if ($this->edgesOut[$i] == $edge) {
                unset($this->edgesOut[$i]);
                break;
            }
        }
        
        //reindex array from 0
        $this->edgesOut = array_values($this->edgesOut);
    }
    
    public function removeEdgeIn(Edge $edge)
    {
        for ($i = 0; $i < count($this->edgesIn); $i++) {
            if ($this->edgesIn[$i] == $edge) {
                unset($this->edgesIn[$i]);
                break;
            }
        }
        
        //reindex array from 0
        $this->edgesIn = array_values($this->edgesIn);
    }
    
    /**
     * Compares an edge to those existing in edgesOut to see if already exists.
     * (Note weight sensitive - an existing edge between the same notes with a
     * different weight will cause this to return false).
     *
     * @param \Graph\Edge $e
     * @return boolean
     */
    public function edgeOutExists(Edge $e)
    {
        foreach ($this->edgesOut as $existingEdge) {
            if ($e == $existingEdge) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Compares an edge to those existing in edgesIn to see if already exists.
     * (Note weight sensitive - an existing edge between the same notes with a
     * different weight will cause this to return false).
     *
     * @param \Graph\Edge $e
     * @return boolean
     */
    public function edgeInExists(Edge $e)
    {
        if (in_array($e, $this->edgesIn)) {
            return true;
        }
        
        return false;
    }
    
    /**
     * @return array
     */
    public function getNeighboursOut()
    {
        return $this->edgesOut;
    }
    
    /**
     * @return array
     */
    public function getNeighboursIn()
    {
        return $this->edgesIn;
    }
}
