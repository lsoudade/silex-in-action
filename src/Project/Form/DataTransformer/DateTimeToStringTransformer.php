<?php
namespace Project\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

class DateTimeToStringTransformer implements DataTransformerInterface
{
    /**
     * Does nothing
     * Interface implementation
     * 
     * @param string $intVal Int as a string
     * @return boolean
     */
    public function transform($datetime)
    {
        if ( !is_null($datetime) ) {
            $dt = new \DateTime($datetime);
            return $dt->format('d/m/Y H:i');
        }
        
        return '';
    }

    public function reverseTransform($datetime)
    {
        if ( !is_null($datetime) ) {
            list($date, $hour) = explode(' ', $datetime);
            list($day, $month, $year) = explode('/', $date);
            list($hours, $minutes) = explode(':', $hour);
            $dt = new \DateTime($year . '-' . $month . '-' . $day . ' ' .$hours . ':' . $minutes . ':00');
            return $dt->format('Y-m-d H:i:00');
        }
        
        return null;
    }
}