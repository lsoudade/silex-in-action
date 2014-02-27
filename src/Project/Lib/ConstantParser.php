<?php

namespace Project\Lib;

/**
 * Builds an array containing specific constants of a given class
 */
class ConstantParser
{
    public function parse($class, $pattern) 
    {
        $refl = new \ReflectionClass($class);   
        
        return array_flip(array_filter(array_flip($refl->getConstants()), function($i) use($pattern) {
            return strstr($i, $pattern);
        }));
    }
}