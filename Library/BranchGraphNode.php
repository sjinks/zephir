<?php

/*
 +--------------------------------------------------------------------------+
 | Zephir                                                                   |
 | Copyright (c) 2013-present Zephir Team (https://zephir-lang.com/)        |
 |                                                                          |
 | This source file is subject the MIT license, that is bundled with this   |
 | package in the file LICENSE, and is available through the world-wide-web |
 | at the following url: http://zephir-lang.com/license.html                |
 +--------------------------------------------------------------------------+
*/

namespace Zephir;

/**
 * BranchGraphNode
 *
 * Allows to visualize assignments for a specific variable in every branch used
 */
class BranchGraphNode
{
    protected $_increase = 0;

    protected $_branches = array();

    /**
     * BranchGraphNode
     *
     * @param Branch $branch
     */
    public function __construct($branch)
    {
        $this->_branch = $branch;
    }

    /**
     * Inserts a node in the branch graph
     *
     * @param BranchGraphNode $branch
     */
    public function insert(BranchGraphNode $branch)
    {
        if (!in_array($branch, $this->_branches)) {
            $this->_branches[] = $branch;
        }
    }

    /**
     * Increases the branch graph level
     */
    public function increase()
    {
        $this->_increase++;
    }

    /**
     * Generates an ASCII visualization of the branch
     *
     * @param int $padding
     */
    public function show($padding = 0)
    {
        echo str_repeat("    ", $padding), $this->_branch->getUniqueId(), ':' , $this->_increase;
        if (count($this->_branches)) {
            echo ':', PHP_EOL;
            foreach ($this->_branches as $node) {
                $node->show($padding + 1);
            }
        } else {
            echo PHP_EOL;
        }
    }
}
