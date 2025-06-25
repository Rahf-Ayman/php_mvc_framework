<?php


namespace app\core;

class Application
{
    public string $layout = 'main'; // this will be used to set the layout of the application
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public static string $ROOT_DIR;
    public ?Controller $controller = null; // this will be used to set the controller of the application
    public Database $db;
    public Session $session;
    public ?UserModel $user; // this will be used to get the user model from the database
    public View  $view;

    public function __construct($rootPath , array $config)
    {
        $this->user = null;
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->view = new View();

        $primaryValue = $this->session->get('user'); // this will be used to get the user id from the session
        if ($primaryValue) {
            
            $primaryKey = $this->userClass::primaryKey();
            
            if ($this->userClass::findOne([$primaryKey => $primaryValue]) === false) {
                $this->session->remove('user'); // remove the user from the session if it does not exist in the database
            }
            $this->user = $this->userClass::findOne([$primaryKey => $primaryValue]);
             // this will be used to get the user name from the database
        }else {
            $this->user = null;
        }
    }

    public function run()
    {
        try{
            echo $this->router->resolve();   //echoooooooooooooooo
        }catch (\Exception $e) {
            $this->response->setStatus($e->getCode()); // this will set the status code to 500
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    public function getController()
    {
        return $this->controller;
    }

    public function setController(Controller $controller)
    {
        $this->controller = $controller;
    }

    public function login(DbModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey(); // id
        $this->session->set('user', $user->{$primaryKey});
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove('user'); 
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }
}
