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
     * Render pages dynamically
     * 
     * @param string $file
     * @param array $messages
     * 
     * @return void 
     */
    protected function render(string $file, array $messages): void
    {
        $data = $messages;
        include_once sprintf("./view/%s.php", $file);
    }

    /**
     * Redirect pages dynamically
     * 
     * @param string $path
     * 
     * @return void
     */
    protected function redirect(string $path): void
    {
        header(sprintf("location: %s", $path));
        exit;
    }
}