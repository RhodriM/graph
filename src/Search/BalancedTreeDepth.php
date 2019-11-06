<?php

namespace Graph\Search;

/**
 * BalancedTreeDepth
 *
 * Assuming graph is a balanced tree of r branches, h height and nodes are
 * numbered from root 0, then children, and so on:
 * Given a node, will return distance to root node 0 by traversing parents.
 *
 * @author rhodri
 */
class BalancedTreeDepth
{
    /**
     * @var \Graph\GraphContainer
     */
    protected $graph;
    
    /**
     * Starting Node
     *
     * @var \Graph\Node
     */
    protected $startNode;
    
    /**
     *
     * @param \Graph\GraphContainer $graph
     * @param \Graph\Node $node
     */
    public function __construct(
        \Graph\GraphContainer $graph,
        \Graph\Node $node
    ) {
        $this->graph = $graph;
        $this->startNode = $node;
    }
    
    /**
     * Distance from start node to top of tree
     *
     * @return int
     */
    public function getDistanceToRoot()
    {
        if ($this->startNode->id == 0) {
            return 0;
        }
        
        return $this->traverse($this->startNode, 1);
    }
    
    /**
     *
     * @param \Graph\Node $node
     * @param type $distance
     * @return type
     */
    protected function traverse(\Graph\Node $node, $distance)
    {
        $lowestId = $node->id;
        foreach ($node->getNeighboursOut() as $edgeOut) {
            if ($edgeOut->to < $lowestId) {
                $lowestId = $edgeOut->to;
            }
        }
        
        if ($lowestId == 0) {
            return $distance;
        }
        
        $distance++;
        return $this->traverse($this->graph->getNodes()[$lowestId], $distance);
    }
}
