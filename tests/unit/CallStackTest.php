<?php

namespace phpmock;

/**
 * Tests CallStack.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license http://www.wtfpl.net/txt/copying/ WTFPL
 * @see CallStack
 */
class CallStackTest extends \PHPUnit_Framework_TestCase
{
    
    /**
     * Tests findFirstNotMatchingNamespace().
     * 
     * @test
     */
    public function testFindFirstNotMatchingNamespace()
    {
        $callStack = new CallStack();
        $namespace = $callStack->findFirstNotMatchingNamespace(__NAMESPACE__);
        
        $this->markTestIncomplete();
    }
}
