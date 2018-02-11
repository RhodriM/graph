<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Graph\Output;

/**
 * Description of Gml
 *
 * @author rhodrimorris
 */
class Gml implements FileOutput
{
    public function writeToFile($filename, \Graph\GraphContainer $graphCon) {
        file_put_contents(
            $filename,
            "graph\n"
            . "[".
            "\n  directed " . $graphCon->isDirected()
        );
        
        foreach($graphCon->getNodes() as $node) {
            file_put_contents(
                $filename,
                "\n  node\n  [\n    id " . $node->id,
                FILE_APPEND);
            
            if ($node->name != '') {
                file_put_contents(
                    $filename,
                    "\n    label \"" . $node->name . "\"",
                    FILE_APPEND
                );
            }
            
            file_put_contents(
                $filename,
                "\n  ]",
                FILE_APPEND
            );
        }
        
        foreach($graphCon->getEdges() as $edge) {
            $weight = $edge->weight;
            if (!$graphCon->isDirected()) {
                $weight = $weight / 2;
            }
            
            file_put_contents(
                $filename,
                "\n  edge\n  [\n    source " . $edge->from
                    . "\n    target " . $edge->to
                    . "\n    value " . $weight,
                FILE_APPEND
            );
            
            if ($edge->label != '') {
                file_put_contents(
                    $filename,
                    "\n    label \"" . $edge->label . "\"",
                    FILE_APPEND
                );
            }
            
            file_put_contents(
                $filename,
                "\n  ]",
                FILE_APPEND
            );
        }
        
        file_put_contents($filename, "\n]", FILE_APPEND);
    }
}
