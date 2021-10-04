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
        $oldumask = umask(0);
        mkdir($directory,0777, true);
        umask($oldumask);
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
        chmod($filepath, 0777);
    }
}
