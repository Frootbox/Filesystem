<?php 
/**
 * 
 */

namespace Frootbox\Filesystem\Traits;


trait Directory {
    
    /**
     *
     */
    public function make ( ) {
    
        $segments = explode('/', $this->path);
        
        array_shift($segments);
        array_pop($segments);
    
        $path = '/';
    
        foreach ($segments as $segment) {
    
            $path .= $segment . '/';
    
            if (!file_exists($path)) {
                mkdir($path);
            }
        }
    }
}