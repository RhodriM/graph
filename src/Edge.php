<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph;

/**
 * Description of Edge
 *
 * @author rhodrimorris
 */
class Edge
{
    public $from;
    public $to;
    public $weight;
    
    public function __construct($f, $t, $w)
    {
        $this->from = $f;
        $this->to = $t;
        $this->weight = $w;
    }
}
