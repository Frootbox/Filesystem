<?php 
/**
 * 
 */

namespace Frootbox\Filesystem;

class Directory {
    
    use \Frootbox\Filesystem\Traits\Directory;
    
    protected $path;
    
    
    /**
     * 
     */
    public function __construct ( $path = null ) {
        
        if (!empty($path)) {
            $this->setPath($path);
        }
    }
    
    
    /**
     * 
     */
    public function setPath ( $path ) {
        
        if (substr($path, -1) != '/') {
            $path .= '/';
        }
        
        $this->path = $path;
    }
}