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
     * @param string|null $path
     */
    public function __construct(string $path = null)
    {                
        if ($path !== null) {            
            $this->path = dirname($path) . '/';
            $this->name = basename($path);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getName();
    }

    /**
     * @param string $directory
     * @return void
     */
    protected function makeDir(string $directory)
    {
        $oldumask = umask(0);
        mkdir($directory,0777, true);
        umask($oldumask);
    }
    
    /**
     * @return $this
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
     * @return \Frootbox\Filesystem\Directory
     * @throws \Exception
     */
    public function getDirectory(): \Frootbox\Filesystem\Directory
    {
        // Get filename
        $fileName = $this->getPath() . $this->getName();

        if (!is_dir($fileName)) {
            throw new \Exception('File is not a directory.');
        }

        return new \Frootbox\Filesystem\Directory($fileName);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Tells whether the file is a directory
     *
     * @return bool
     */
    public function isDirectory(): bool
    {
        return is_dir($this->path);
    }

    /**
     * @param $newDirectory
     * @return void
     * @throws \Exception
     */
    public function move($newDirectory): void
    {
        if (!file_exists($newDirectory)) {
            $this->makeDir($newDirectory);
        }

        $newPath = rtrim($newDirectory, '/') . '/' . $this->getName();

        rename($this->getPath() . $this->getName(), $newPath);
    }
    
    /**
     * @param $source
     * @return $this
     */
    public function setSource($source): File
    {
        $this->source = $source;
        
        return $this;
    }
    
    /**
     * @return void
     * @throws \Exception
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
