<?php

/**
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
namespace Graph\Input;

/**
 * Creates a GraphContainer from GML file. This is possibly a little naive and
 * simplistic as a GML parser for the time being; makes assumptions on the
 * structure of the GML file and so may not work for all valid GML.
 *
 * Some assumptions: sections indented by tabs; graph attributes come before
 * nodes and edges.
 *
 * @author rhodrimorris
 */
class Gml implements FileInput
{
    protected $graph = null;
    
    /**
     * Reads file, returns GraphContainer
     *
     * @param String $filename
     * @return \Graph\GraphContainer
     */
    public function readFromFile($filename)
    {
        $gmlString = file_get_contents($filename);
        $linesArray = explode("\n", $gmlString);
        $graphAttributes = $this->parseGraphAttributes($linesArray);
        
        $maintainAdjacencyMatrix = false;
        $directed = false;
        $weighted = false;
        
        if (array_key_exists('directed', $graphAttributes)) {
            $directed = boolval($graphAttributes['directed']);
        }
        
        if (array_key_exists('maintainAdjacencyMatrix', $graphAttributes)) {
            $maintainAdjacencyMatrix = boolval($graphAttributes['maintainAdjacencyMatrix']);
        }
        
        if (array_key_exists('weighted', $graphAttributes)) {
            $weighted = boolval($graphAttributes['weighted']);
        }
        
        $this->graph = new \Graph\GraphContainer($maintainAdjacencyMatrix, $directed, $weighted);
        
        $this->parseNodes($linesArray);
        $this->parseEdges($linesArray);
        
        return $this->graph;
    }
    
    /**
     *
     * @param array $linesArray
     * @return array
     * @throws \Exception
     */
    protected function parseGraphAttributes($linesArray)
    {
        if (strpos($linesArray[0], 'graph [') === false) {
            throw new \Exception('does not start with graph [');
        }
        
        $graphAttributes = array();
        
        for ($i = 1; $i < count($linesArray); $i++) {
            if ($linesArray[$i] == "\tnode [") {
                break;
            }
            $key = trim(substr($linesArray[$i], 0, strpos($linesArray[$i], ' ')));
            $value = trim(substr($linesArray[$i], strpos($linesArray[$i], ' ') + 1));

            $graphAttributes[$key] = $value;
        }
        
        return $graphAttributes;
    }
    
    /**
     *
     * @param array $linesArray
     */
    protected function parseNodes($linesArray)
    {
        foreach ($linesArray as $lineCount => $lineValue) {
            if ($lineValue == "\tnode [") {
                $this->parseNode($lineCount, $linesArray);
            }
        }
    }
    
    /**
     *
     * @param int $lineCount
     * @param array $linesArray
     */
    protected function parseNode($lineCount, $linesArray)
    {
        $node = new \Graph\Node();
        
        for ($i = $lineCount; $i < count($linesArray); $i++) {
            if ($linesArray[$i] == "\t]") {
                break;
            }
            
            $key = trim(substr($linesArray[$i], 0, strpos($linesArray[$i], ' ')));
            $value = trim(substr($linesArray[$i], strpos($linesArray[$i], ' ') + 1));
            
            if (is_numeric($value)) {
                $value = (int)$value;
            }
            
            $node->$key = $value;
            
            if ($key == 'label' || $node->name = '') {
                $node->name = $value;
            }
        }
        
        $id = ($node->id === null) ? '' : $node->id;
        
        $this->graph->addNode($node, $id);
    }
    
    /**
     *
     * @param array $linesArray
     */
    protected function parseEdges($linesArray)
    {
        foreach ($linesArray as $lineCount => $lineValue) {
            if ($lineValue == "\tedge [") {
                $this->parseEdge($lineCount, $linesArray);
            }
        }
    }
    
    /**
     *
     * @param int $lineCount
     * @param array $linesArray
     * @throws \Exception
     */
    protected function parseEdge($lineCount, $linesArray)
    {
        $edgeAttributes = array();
        
        for ($i = $lineCount; $i < count($linesArray); $i++) {
            if ($linesArray[$i] == "\t]") {
                break;
            }

            $key = trim(substr($linesArray[$i], 0, strpos($linesArray[$i], ' ')));
            $value = trim(substr($linesArray[$i], strpos($linesArray[$i], ' ') + 1));
            
            if (is_numeric($value)) {
                $value = (int)$value;
            }
            
            $edgeAttributes[$key] = $value;
        }
        
        if (!array_key_exists('source', $edgeAttributes)
            || !array_key_exists('target', $edgeAttributes)) {
            throw new \Exception('missing either source or target for edge');
        }
        
        $weight = 1;
        if (array_key_exists('weight', $edgeAttributes)) {
            $weight = $edgeAttributes['weight'];
        }
        
        $label = '';
        if (array_key_exists('label', $edgeAttributes)) {
            $label = $edgeAttributes['label'];
        }

        $this->graph->addEdgeByIds($edgeAttributes['source'], $edgeAttributes['target'], $weight, $label);
    }
}
