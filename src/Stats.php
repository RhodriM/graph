<?php

/**
 * The MIT License
 *
 * Copyright 2019 Rhodri Morris.
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
 * Returns some stats about the graph
 *
 * @author rhodri
 */
class Stats
{
    public $graph;

    /**
     * Clones graph so can calculate stats at that point, regardless
     * of later changes to graph
     *
     * @param GraphContainer $agents
     */
    public function __construct(GraphContainer $graph)
    {
        $this->graph = clone $graph;
    }
    
    /**
     * Returns average degree of graph
     *
     * @return float
     */
    public function getAverageDegree()
    {
        return count($this->graph->getEdges()) / count($this->graph->getNodes());
    }
    
    /**
     * Returns network density
     * (https://www.ibm.com/support/knowledgecenter/en/SS3RA7_15.0.0/com.ibm.spss.sna.doc/sna_overview_statistics_density.htm)
     *
     * @return float
     */
    public function getNetworkDensity()
    {
        $edgeCount = count($this->graph->getEdges());
        $nodeCount = count($this->graph->getNodes());
        return $edgeCount / ($nodeCount * ($nodeCount - 1));
    }
}
