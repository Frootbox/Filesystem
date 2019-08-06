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

        if (file_exists($this->path)) {
            return;
        }
    
        $segments = explode('/', $this->path);
        
        array_shift($segments);
        array_pop($segments);
    
        $path = '/';
    
        foreach ($segments as $segment) {
    
            $path .= $segment . '/';
    
            if (!@file_exists($path)) {
                @mkdir($path);
            }
        }
    }
}