<?php 
/**
 * 
 */

namespace Frootbox\Filesystem;

class Directory implements \Iterator {
    
    use \Frootbox\Filesystem\Traits\Directory;
    
    protected $path;
    protected $files = null;
    
    
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
    public function current ( ) {
        
        return $this->files[$this->iteratorIndex];
    }
    
    
    /**
     * 
     */
    public function next ( ) {
                
        ++$this->iteratorIndex;
    }
    
    
    /**
     * 
     */
    public function key ( ) {
        
        return $this->iteratorIndex;
    }
    
    
    /**
     *
     */
    public function valid ( ) {
        
        if ($this->files === null) {
            $this->loadFiles();
        }
    
        return isset($this->files[$this->iteratorIndex]);
    }
    
    
    /**
     *
     */
    public function rewind ( ) {
            
        $this->iteratorIndex = 0;
    }
    
    
    /**
     * 
     */
    public function exists ( ) {
        
        return file_exists($this->path);
    }
    
    /**
     * 
     */
    public function loadFiles ( ): Directory {
        
        $this->files = [ ];
        $dir = dir($this->path);
        
        while (false !== ($entry = $dir->read())) {
            
            if ($entry{0} == '.') {
                continue;
            }
            
            $this->files[] = $entry;
        }
        
        $dir->close();
        
        return $this;
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