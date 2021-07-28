<?php

namespace App\controller;
use App\model\LoginModel;

class LoginController
{
    public function __construct()
    {        
        $this->LoginModel = new LoginModel;
        $this->container = 'layouts/master';
    }


    public function login()
    {
        if(isLoggedIn()) { redirect('registro/ingreso'); }

            $data = addIndexErrors([
                'email' => post('email'),
                'password' => post('password'),
                'email_err' => '',
                'password_err' => ''
            ]);   

            if(isPost())
            {
                $loggedIn = $this->LoginModel->login(post('email'), post('password'));

                if($loggedIn){
                    $this->createSession($loggedIn);
                }else{
                    $data['email_err'] = 'Password / Email incorrecto';                
                }    
            }    
            
            return view($this->container, array_merge($data, ['view' => 'login/login'])); 
    
    }

    // variables de sessión
    public function createSession($row)
    {
        $_SESSION['user_id'] = $row->USU_ID;
        $_SESSION['name'] = $row->USU_EMAIL;
        
        flash('register_success', strtoupper('!bienvenido! centro comercial '. $row->Ccomercial_razonSocial));
        redirect('registro/ingreso');
    }

    //logout and destroy user session
    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        session_destroy();

        redirect('/');
    }

}