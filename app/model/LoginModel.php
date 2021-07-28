<?php

namespace App\model;
use App\model\DB_CORE\DB;

class LoginModel extends DB {

    public function login($email, $password)
    {
        $row = $this->getRow('USU_USUARIO', ['USU_EMAIL' => $email]);
        if(isset($row->USU_ID)){
            if(password_verify($password, $row->USU_CLAVE)) { return $row; }
        }
        
        return FALSE;
    }    


    public function validate_unique($data)
    {        
        if($this->getRow('USU_USUARIO', ['USU_EMAIL' => post('razonSocial')]))
        {
            $data['razonSocial_err'] = 'Razón Social ya está registrado';
            $data['has_errors'] = TRUE;
        }            

        if($this->getRow('USU_USUARIO', ['USU_EMAIL' => post('email')]))
        {
            $data['email_err'] = 'El email ya está registrado';
            $data['has_errors'] = TRUE;
        }

        if($data['password'] != $data['confirm_password'])
        {
            $data['confirm_password_err'] = 'La confirmación del Password es incorrecta.';
            $data['has_errors'] = TRUE;
        }           
        
        return $data;
    }
    
}