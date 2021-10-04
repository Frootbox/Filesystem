<?php 
/**
 * 
 */

namespace Frootbox\Filesystem;

class Directory implements \Iterator
{
    use \Frootbox\Filesystem\Traits\Directory;
    
    protected $path;
    protected $files = null;
    
    /**
     * 
     */
    public function __construct($path = null)
    {
        if (!empty($path)) {
            $this->setPath($path);
        }
    }
    
    /**
     * 
     */
    public function current(): mixed
    {
        return $this->files[$this->iteratorIndex];
    }
    
    /**
     * 
     */
    public function next(): void
    {
        ++$this->iteratorIndex;
    }
    
    /**
     * 
     */
    public function key(): mixed
    {
        return $this->iteratorIndex;
    }
    
    /**
     *
     */
    public function valid(): bool
    {
        if ($this->files === null) {
            $this->loadFiles();
        }
    
        return isset($this->files[$this->iteratorIndex]);
    }
    
    /**
     *
     */
    public function rewind(): void
    {
        $this->iteratorIndex = 0;
    }
    
    /**
     * 
     */
    public function exists()
    {
        return file_exists($this->path);
    }
    
    /**
     * 
     */
    public function getPath()
    {
        return $this->path;
    }
    
    /**
     * 
     */
    public function loadFiles(): Directory
    {
        $this->files = [ ];

        if (file_exists($this->path)) {

            $dir = dir($this->path);

            while (false !== ($entry = $dir->read())) {

                if ($entry[0] == '.') {
                    continue;
                }

                $this->files[] = $entry;
            }

            $dir->close();
        }
        
        return $this;
    }
    
    /**
     * 
     */
    public function setPath($path)
    {
        if (substr($path, -1) != '/') {
            $path .= '/';
        }
        
        $this->path = $path;
    }
}
