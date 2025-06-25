<?php

namespace app\controllers;

use app\core\Application;

use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;

class SiteControlller extends Controller
{
    public  function home()
    {
        return $this->render('home', $params = []);
    }
    public function contact(Request $request , Response $response)
    {
        $contact = new ContactForm();
        if( $request->isGet()) {
                return $this->render('contact', [
                    'model' => $contact,
                ]);
            
        }else{
            
            $contact->loadData($request->getBody());
            
            if ($contact->validate() ) {
                // Redirect to success page or login page
                echo '<pre>';
            var_dump($request->getBody()); // Debugging line to check the loaded data
            echo '</pre>';
                $contact->save();
                Application::$app->session->setFlash('success', 'Thank you for contacting us. We will get back to you soon.');
                Application::$app->response->redirect('/');
                exit;
            }
            return $this->render('contact' , [
                'model' => $contact,
                
            ]);
        }
        
        
    }
    
}
