<?php

namespace Graph\Search;

/**
 * AllSimplePathsFromNode
 *
 * Given a graph, starting node and limit (all specified in constructor) will
 * calculate all simple non-cycling paths from starting node within specified
 * limit. Very similar to depth-first search.
 * Usage:
 * $pathsSearch = new \Graph\Search\AllSimplePathsFromNode(
 *     $graph,
 *     $startNode,
 *     2
 * );
 * $paths = $pathsSearch->getSimplePathsFromNode();
 *
 * @author rhodri
 */
class AllSimplePathsFromNode
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
     * Limit hops
     *
     * @var int
     */
    protected $limit;
    
    /**
     * List of paths collected so far
     *
     * @var array
     */
    protected $paths;
    
    /**
     * @param \Graph\GraphContainer $graph the graph structure
     * @param \Graph\Node           $node  starting node
     * @param int                   $limit limit hops
     */
    public function __construct(
        \Graph\GraphContainer $graph,
        \Graph\Node $node,
        $limit = 3
    ) {
        $this->graph = $graph;
        $this->startNode = $node;
        $this->limit = $limit;
    }
    
    /**
     * Returns a list of all simple paths within hops limit, starting from
     * starting node.
     *
     * @return array
     */
    public function getSimplePathsFromNode()
    {
        $this->paths = array();
        
        $this->simplePathsFromNode(
            $this->startNode,
            array($this->startNode->id),
            0
        );
        
        return $this->paths;
    }
    
    /**
     * Recursive function, similar to depth first search. Follows edges up to
     * limit, no cycles.
     *
     * @param \Graph\Node $node  next node to follow
     * @param array       $path  path visited so far
     * @param int         $count number of hops so far
     *
     * @return null
     */
    protected function simplePathsFromNode(\Graph\Node $node, $path, $count)
    {
        // skip adding to path if first node (ie count is zero)
        if ($count > 0) {
            if (in_array($node->id, $path) || $count > $this->limit) {
                // return early if visited or limit reached
                return;
            }

            $path[] = $node->id;
            
            if (! in_array($path, $this->paths)) {
                $this->paths[] = $path;
            }
        }
        
        foreach ($node->getNeighboursOut() as $edge) {
            $this->simplePathsFromNode(
                $this->graph->getNodes()[$edge->to],
                $path,
                $count + 1
            );
        }
    }
}
