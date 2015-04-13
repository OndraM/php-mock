<?php

namespace phpmock;

/**
 * Call stack helper.
 *
 * @author Markus Malkusch <markus@malkusch.de>
 * @link bitcoin:1335STSwu9hST4vcMRppEPgENMHD2r1REK Donations
 * @license http://www.wtfpl.net/txt/copying/ WTFPL
 * @internal
 */
class CallStack
{

    /**
     * @var array The call stack.
     * @see \debug_backtrace()
     */
    private $stack;
    
    /**
     * Initializes the call stack.
     *
     * @param int $limit The call stack limit. Default is 10. 0 would be no limit.
     */
    public function __construct($limit = 10)
    {
        $this->stack = debug_backtrace($limit);
    }
    
    /**
     * Finds the first namespace which is not part of a given namespace.
     *
     * The resulting namespace comes from ReflectionClass::getNamespaceName(),
     * i.e. the namespace doesn't have a \-prefix. E.g. the root namespace
     * would be "".
     *
     * @param type $namespace The given namespace.
     *
     * @return string|null The namespace or null if none was found.
     */
    public function findFirstNotMatchingNamespace($namespace)
    {
        $canonicalNamespace = $this->getCanonicalNamespace($namespace);
        foreach ($this->stack as $call)
        {
            if (empty($call["class"])) {
                continue;
            }
            $reflectionClass = new \ReflectionClass($call["class"]);
            $callNamespace   = $this->getCanonicalNamespace($reflectionClass->getNamespaceName());
            
            if (strpos($callNamespace, $canonicalNamespace) === false) {
                return $reflectionClass->getNamespaceName();
            }
        }
        return null;
    }
    
    /**
     * Returns a canonical representation of a namespace.
     *
     * @param string $namespace The namespace.
     *
     * @return string The canonical namespace.
     */
    private function getCanonicalNamespace($namespace)
    {
        return strtolower(trim($namespace, "\\"));
    }
}
