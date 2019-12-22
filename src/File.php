<?php 
/**
 * 
 */

namespace Frootbox\Filesystem;

class File
{
    protected $name;
    protected $path;
    protected $source;
    
    /**
     * 
     */
    public function __construct(string $path = null)
    {                
        if ($path !== null) {            
            $this->path = dirname($path) . '/';
            $this->name = basename($path);
        }
    }   
    
    /**
     * 
     */
    protected function makeDir(string $directory)
    {
        $segments = explode('/', $directory);
        array_shift($segments);
        array_pop($segments);
        
        $path = '/';
        
        foreach ($segments as $segment) {
            
            $path .= $segment . '/';
                        
            if (!@file_exists($path)) {
                @mkdir($path);
            }
        }

        if (!file_exists($directory)) {
            throw new \Exception('Directory couldnt be created.');
        }
    }
    
    /**
     * 
     */
    public function delete(): File
    {                   
        // Delete physical file        
        if (file_exists($this->path . $this->name)) {
            
            if (is_dir($this->path . $this->name)) {
                d(debug_backtrace());
                d($this);
            }
            
            unlink($this->path . $this->name);
        }
        
        return $this;
    }
    
    /**
     * 
     */
    public function setSource($source): File
    {
        $this->source = $source;
        
        return $this;
    }
    
    /**
     * 
     */
    public function write()
    {
        if (!file_exists($this->path)) {            
            $this->makeDir($this->path);        
        }
        
        $filepath = $this->path . $this->name;
        
        file_put_contents($filepath, $this->source);
    }
}
