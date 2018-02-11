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
 * Description of Node
 *
 * @author rhodrimorris
 */
class Node
{
    public $id;
    public $name = '';
    protected $edgesOut;
    protected $edgesIn;
    
    public function __construct($name = '') {
        $this->edgesIn = array();
        $this->edgesOut = array();
        $this->name = $name;
    }
    
    public function addEdgeOut(Edge &$e)
    {
        $this->edgesOut[] = $e;
    }
    
    public function addEdgeIn(Edge &$e)
    { 
        $this->edgesIn[] = $e;
    }
    
    public function edgeOutExists(Edge $e)
    {
        foreach ($this->edgesOut as $existingEdge)
        {
            if ($e == $existingEdge) {
                return true;
            }
        }
        
        return false;
    }
    
    public function edgeInExists(Edge $e)
    {
        if (in_array($e, $this->edgesIn)) {
            return true;
        }
        
        return false;
    }
    
    public function getNeighboursOut()
    {
        return $this->edgesOut;
    }
    
    public function getNeighboursIn()
    {
        return $this->edgesIn;
    }
}
