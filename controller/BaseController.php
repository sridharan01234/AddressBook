<?php

/**
 * This file contains common basic actions
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 8/5/2024
 */

class BaseController
{
    /**
     * Renders pages dynamically
     * 
     * @param string $file
     * 
     * @return void 
     */
    protected function render(string $file, $variables): void
    {
        $data = $variables;
        include_once sprintf("./view/%s.php", $file);
    }
    
    /**
     * Redirest pages dynamically
     * 
     * @param string $path
     * 
     * @return void
     */
    protected function redirect(string $path): void
    {
        header(sprintf("location: %s",$path));
    }
}