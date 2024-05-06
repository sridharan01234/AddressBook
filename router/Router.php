<?php
class Router
{
    private $routes;

    /**
     * Add application paths
     *
     * @param string $path
     * @param array $param
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
     * Searchs path
     *
     * @param string $uri
     * @return bool|array
     */
    public function searchPath(string $uri): bool|array
    {
        foreach ($this->routes as $path) {
            if ($path['path'] === $uri) {
                return $path['params'];
            }
        }
        return false;
    }
}
