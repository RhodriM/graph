<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Graph\Output;
/**
 * Description of FileOutput
 *
 * @author rhodrimorris
 */
interface FileOutput
{
    public function writeToFile($filename, \Graph\GraphContainer $graphCon);
}
