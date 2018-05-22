<?php

namespace Graph\Search;

/**
 * Class for BreadthFirst searches
 *
 * @author rhodrimorris
 */
class BreadthFirst
{
    /**
     * @var \Graph\GraphContainer
     */
    protected $graph;
    
    /**
     * @param \Graph\GraphContainer $graph
     */
    public function __construct(\Graph\GraphContainer $graph)
    {
        $this->graph = $graph;
    }
    
    /**
     * Returns array of all nodes and their distances from starting node. $node
     * is starting node, $stopAt is a distance to stop searching at, format of
     * return array is key = node id, value = distance.
     *
     * @param \Graph\Node $node starting node
     * @param int $stopAt only return nodes within this distance
     * @return array key = node id, value = distance
     */
    public function returnNodesByHopsFrom(\Graph\Node $node, $stopAt = -1)
    {
        $queue = array();
        $visited = array();
        
        $queue[] = $node->id;
        $visited[$node->id] = 0;
        
        while (! empty($queue)) {
            $nodeId = array_shift($queue);
            
            foreach ($this->graph->getNodes()[$nodeId]->getNeighboursOut() as $neighbour) {
                if (!array_key_exists($neighbour->to, $visited)
                    && ($stopAt == -1 || $visited[$nodeId] < $stopAt)
                ) {
                    $queue[] = $neighbour->to;
                    $visited[$neighbour->to] = $visited[$nodeId] + 1;
                }
            }
        }
        
        return $visited;
    }
}
