<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
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
