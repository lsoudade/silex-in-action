<?php
namespace Project\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class BooleanTransformer implements DataTransformerInterface
{
    /**
     * Transforms an int to a boolean ready to be used by checkbox
     *
     * @param string $intVal Int as a string
     * @return boolean
     */
    public function transform($intVal)
    {
        return (bool) $intVal;
    }

    /**
     * Does nothing
     * Interface implementation
     */
    public function reverseTransform($boolean)
    {
        return $boolean;
    }
}