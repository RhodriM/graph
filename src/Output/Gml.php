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
namespace Graph\Output;

/**
 * Write GraphContainer to gml file.
 *
 * https://en.wikipedia.org/wiki/Graph_Modelling_Language
 *
 * @author rhodrimorris
 */
class Gml implements FileOutput
{
    /**
     * @param String $filename
     * @param \Graph\GraphContainer $graphCon
     */
    public function writeToFile($filename, \Graph\GraphContainer $graphCon)
    {
        file_put_contents(
            $filename,
            "graph\n"
            . "[".
            "\n\tdirected " . intval($graphCon->isDirected())
        );
        
        foreach ($graphCon->getNodes() as $node) {
            file_put_contents(
                $filename,
                "\n\tnode\n\t[\n\t\tid " . $node->id,
                FILE_APPEND
            );
            
            if ($node->name != '') {
                file_put_contents(
                    $filename,
                    "\n\t\tlabel \"" . $node->name . "\"",
                    FILE_APPEND
                );
            }
            
            if ($node->colour != '') {
                file_put_contents(
                    $filename,
                    "\n\t\tgraphics" . "\n\t\t[\n\t\t\tfill \""
                    . '#' . $node->colour . "\"" . "\n\t\t]",
                    FILE_APPEND
                );
            }
            
            file_put_contents(
                $filename,
                "\n\t]",
                FILE_APPEND
            );
        }
        
        foreach ($graphCon->getEdges() as $edge) {
            $weight = $edge->weight;
            if (!$graphCon->isDirected()) {
                $weight = $weight / 2;
            }
            
            file_put_contents(
                $filename,
                "\n\tedge\n\t[\n\t\tsource " . $edge->from
                    . "\n\t\ttarget " . $edge->to
                    . "\n\t\tvalue " . $weight,
                FILE_APPEND
            );
            
            if ($edge->label != '') {
                file_put_contents(
                    $filename,
                    "\n\t\tlabel \"" . $edge->label . "\"",
                    FILE_APPEND
                );
            }
            
            file_put_contents(
                $filename,
                "\n\t]",
                FILE_APPEND
            );
        }
        
        file_put_contents($filename, "\n]", FILE_APPEND);
    }
}
