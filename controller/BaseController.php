<?php
class BaseController
{
    /**
     * Renders pages dynamically
     * 
     * @param string $file
     * 
     * @return void 
     */
    public function render(string $file, $variables): void
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
    public function redirect(string $path): void
    {
        header(sprintf("location: %s",$path));
    }
}