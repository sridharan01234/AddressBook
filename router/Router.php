<?php

/**
 * This file contains routing functionalities
 * 
 * Author : sridharan
 * Email : sridharan01234@gmail.com
 * Last modified : 8/5/2024
 */

class Router
{
    private $routes;

    /**
     * Add application paths
     *
     * @param string $path
     * @param array $param
     * 
     * @return void
     */
    public function add(string $path, array $param): void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $param,
        ];
    }

    /**
     * Search path
     *
     * @param string $uri
     * 
     * @return bool|array
     */
    public function searchPath(string $uri): bool|array
    {
        foreach ($this->routes as $path) {
            if ($path['path'] == $uri) {
                return $path['params'];
            }
        }
        return false;
    }
}
