<?php
class Router
{
    private $routes;
    public function add(string $path, array $param): void
    {
        $this->routes[] = [
            "path" => $path,
            "params" => $param,
        ];
    }
    public function searchPath(string $uri): bool | array
    {
        foreach ($this->routes as $path) {
            if ($path['path'] === $uri) {
                return $path['params'];
            }
        }
        return false;
    }
}