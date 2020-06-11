<?php
/*
*  App core class
*  Maakt URL & laad core controller
*  URL format /{controller}/{method}/{parameters}
*/
declare(strict_types=1);

class Core
{
    private $currentController = 'Exercises';
    protected string $currentMethod = 'index';
    protected array $params = [];
    private array $url = [];

    public function __construct()
    {
        // print_r($this->getUrl());
        $url = $this->getUrl();


        //overwrite $currentController als er een gevonden kan worden
        if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')) {
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }


        //require huidige controller
        require_once '../app/controllers/' . $this->currentController . '.php';
        $this->currentController = new $this->currentController();

        // Method uit URL
        if (isset($url[1])) {
            // check of de method bestaat in controller
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]);
            }
        }

        // Parameters uit url
        $this->params = $url ? array_values($url) : [];

        call_user_func_array(
            [$this->currentController, $this->currentMethod],
            $this->params);
    }

    public function getUrl() : array
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // verwijderd / aan het einde van de opgehaalde url
            $url = filter_var($url, FILTER_SANITIZE_URL); // Haalt ongewenste karakters weg
            $url = explode('/', $url);
            return $url;
        } else {
            // URL is empty thus it's the homepage.
            return $url = ["home"];
        }
    }
}
