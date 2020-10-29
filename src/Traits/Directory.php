<?php 
/**
 * 
 */

namespace Frootbox\Filesystem\Traits;


trait Directory {
    
    /**
     *
     */
    public function make(): void
    {
        if (file_exists($this->path)) {
            return;
        }
    
        $oldumask = umask(0);
        mkdir($this->path,0777, true);
        umask($oldumask);

        return;


        $segments = explode('/', $this->path);
        
        array_shift($segments);
        array_pop($segments);

        $todo = [];

        while (count($segments)) {

            $xpath = '/' . implode('/', $segments);

            if (file_exists($xpath)) {
                break;
            }

            $todo[] = array_pop($segments);
        }

        $todo = array_reverse($todo);

        foreach ($todo as $segment) {

            $xpath .= '/' . $segment;

            mkdir($xpath);
        }
    }
}
