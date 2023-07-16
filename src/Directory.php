<?php 
/**
 * 
 */

namespace Frootbox\Filesystem;

class Directory implements \Iterator
{
    use \Frootbox\Filesystem\Traits\Directory;
    
    protected string $path;
    protected ?array $files = null;
    protected int $iteratorIndex = 0;

    /**
     * @param $path
     */
    public function __construct($path = null)
    {
        if (!empty($path)) {
            $this->setPath($path);
        }
    }

    /**
     * @return mixed
     */
    public function current(): mixed
    {
        return $this->files[$this->iteratorIndex];
    }

    /**
     * @return void
     */
    public function next(): void
    {
        ++$this->iteratorIndex;
    }

    /**
     * @return int
     */
    public function key(): int
    {
        return $this->iteratorIndex;
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        if ($this->files === null) {
            $this->loadFiles();
        }
    
        return isset($this->files[$this->iteratorIndex]);
    }

    /**
     * @return void
     */
    public function rewind(): void
    {
        $this->iteratorIndex = 0;
    }

    /**
     * @return bool
     */
    public function exists(): bool
    {
        return file_exists($this->path);
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return $this
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
     * @param $path
     * @return void
     */
    public function setPath($path): void
    {
        if (substr($path, -1) != '/') {
            $path .= '/';
        }
        
        $this->path = $path;
    }
}
