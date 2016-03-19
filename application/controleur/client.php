<?php


class Client extends Controller
{

    function __construct()
    {
        parent::__construct();
    }
    
    function manage(){

        Auth::isAdmin();

        $this->loadModel('UserSQL');
        $model_user = new UserSQL();
        
        $this->view->users = $model_user->findAll()->execute();
        
        $this->view->render('client/tousLesClient');
    }
    
    function delete($id){
        
    }
}
