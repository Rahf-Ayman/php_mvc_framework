<?php

namespace app\core;


class View {
    public string $title = '';

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyViews($view, $params);
        $layoutContent = $this->layoutContent();

        return str_replace('{{content}}', $viewContent, $layoutContent); // the problem in echooo

    }

    public function rendererrorView()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/_404.php";
        return ob_get_clean();
    }

    public function renderContent($viewcontent)
    {

        $layoutContent = $this->layoutContent();


        // echo $layoutContent ." " .$viewContent;

        return str_replace('{{content}}', $viewcontent, $layoutContent); // the problem in echooo

    }

    protected function layoutContent()
    {
        $layout = Application::$app->layout; // this will be used to get the layout of the application
        if(Application::$app->controller){
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/layout/$layout.php";
        return ob_get_clean();
    }

    protected function renderOnlyViews($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value; // this will create a variable with the name of the key and assign it the value
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}