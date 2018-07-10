<?php

namespace Graph\Search;

/**
 * @author rhodri
 */
class Dijkstra
{
    protected $graph;
    
    const ROUTE_LOWEST_EDGES = 'LE';
    const ROUTE_LOWEST_WEIGHT = 'LW';
    const ROUTE_HIGHEST_WEIGHT = 'HW';
    
    public function __construct(\Graph\GraphContainer $graph)
    {
        $this->graph = $graph;
    }
    
    /**
     * dijkstra algorithm, returns array(distances, previous)
     *
     * @param \Graph\Node $startNode
     * @return array
     */
    public function dijkstra($startNode)
    {
        $dist = array();
        $dist[$startNode->id] = 0;
        $prev = array();
        $queue = array($startNode->id);
        
        foreach ($this->graph->getNodes() as $node) {
            if ($node->id != $startNode->id) {
                $dist[$node->id] = INF;
                $queue[] = $node->id;
                $prev[$node->id] = null;
            }
        }
        
        while (! empty($queue)) {
            asort($dist);

            reset($dist);
            $v = key($dist);

            while (($key = array_search($v, $queue)) === false) {
                next($dist);
                $v = key($dist);
            }
            
            //remove from queue
            if (($key = array_search($v, $queue)) !== false) {
                unset($queue[$key]);
            }
            
            foreach ($this->graph->getNodes()[$v]->getNeighboursOut() as $edge) {
                if (! in_array($edge->to, $queue)) {
                    continue;
                }
                
                $alt = $dist[$v] + $edge->weight;
                
                if ($alt < $dist[$edge->to]) {
                    $dist[$edge->to] = $alt;
                    $prev[$edge->to] = $v;
                }
            }
        }
        
        return array($dist, $prev);
    }

    /**
     * Returns (shortest) list of edges between two nodes
     *
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getEdgesBetween($start, $end)
    {
        list($dist, $prev) = $this->dijkstra($this->graph->getNodes()[$start]);
        
        $edges = array();
        $nextId = $prev[$end];
        
        $edges[] = $this->graph->findEdgeInOutList($end, $prev[$end]);
        
        while ($nextId != $start) {
            $edges[] = $this->graph->findEdgeInOutList($nextId, $prev[$nextId]);
            $nextId = $prev[$nextId];
        }
        
        return $edges;
    }
}
