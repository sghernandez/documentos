<?php
    
    
/* Retorna los errores del formulario para desplegarlos
   en el formulario a través de ajax */
function get_errors() 
{      
   $results['errors'] = TRUE;
   foreach ($_POST as $key => $post){            
      $results['error_'. $key] = strip_tags("$key");
   }

   return $results;
}    
    
if ( ! function_exists('form_hidden'))  
{
	/**
	 * Hidden Input Field
	 *
	 * Generates hidden fields. You can pass a simple key/value string or
	 * an associative array with multiple values.
	 *
	 * @param	mixed	$name		Field name
	 * @param	string	$value		Field value
	 * @param	bool	$recursing
	 * @return	string
	 */
	function form_hidden($name, $value = '', $recursing = FALSE)
	{
		static $form;

		if ($recursing === FALSE)
		{
			$form = "\n";
		}

		if (is_array($name))
		{
			foreach ($name as $key => $val)
			{
				form_hidden($key, $val, TRUE);
			}

			return $form;
		}

		if ( ! is_array($value))
		{
            $q = htmlspecialchars($value, ENT_QUOTES, "ISO-8859-1");
            $q = stripslashes($q);            
			$form .= '<input type="hidden" name="'.$name.'" value="'.$q."\" />\n";
		}
		else
		{
			foreach ($value as $k => $v)
			{
				$k = is_int($k) ? '' : $k;
				form_hidden($name.'['.$k.']', $v, TRUE);
			}
		}

		return $form;
	}
}    


    function is_ajax_request(){
       return ! empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
       strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }          
    
    
    function auth()
    {
        if(! isLoggedIn()){
            redirect('users/login');
        }
    }


    function post($key)
    {
        if(isset($_POST[$key])){
            return trim(filter_var($_POST[$key], FILTER_SANITIZE_STRING));
        }

        return '';
    }


    function get($key)
    {
        if(isset($_GET[$key])){
            return trim(filter_var($_GET[$key], FILTER_SANITIZE_STRING));
        }

        return '';
    }    

    function validate($array, $data)
    {
        $errors = [];

        foreach($array as $field => $rules)
        {
            foreach(explode('|', $rules) as $rule)
            {
                $min = explode('min_len(', $rule);

                if(isset($min[1]))  {
                   $err = min_len(post($field), $field, intval($min[1]));
                }
                else{
                    $err = $rule(post($field), $field);
                }

                if(count($err)) {
                    $errors[] = $err;
                    break; // si una regla no es válida se detine y no sigue validando las otras
                }
            }

        }      

        foreach($errors as $key =>  $error)
        {           
            $data['errors'] = TRUE;
            foreach($error as $key_err =>  $e)
            {
                $data[$key_err] = $e;
                $data['error_'. (rtrim($key_err, '_err'))] = $e;
                $data['has_errors'] = TRUE;   
            }
        }
        
        return $data;
    }

    function min_len($val, $field, $len)
    {
        $errors = [];
        if(strlen($val) < $len){
            $errors[$field. '_err'] = 'Este campo debe tener mínimo '. $len. ' Caracteres';
        }

        return $errors;
    }    
    
    
    function max_len($val, $field, $len)
    {
        $errors = [];
        if(strlen($val) > $len){
            $errors[$field. '_err'] = 'Este campo debe tener máximo '. $len. ' Caracteres';
        }

        return $errors;
    }    
    

    function required($val, $field)
    {
        $errors = [];
        if(empty($val)){
            $errors[$field. '_err'] = 'Este campo es requerido.';
        }

        return $errors;
    }


    function valid_email($val, $field)
    {
        $errors = [];

        if (! filter_var($val, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            $errors[$field. '_err'] = 'Email no válido';
          }        

        return $errors;
    }    

    function addIndexErrors($array)
    {
        $new_array = $array;

        foreach($array as $key => $value){
            $new_array[$key.'_err'] = '';
        }

        return $new_array;
    }    


    /* retorna un array añadiendo el "nombreTabla_" a cada índice del arreglo */
    function tableName($table, $array)
    {
        $new_array = [];
        foreach($array as $key => $value){
            $new_array[$table. '_'. $key] = $value;
        }

        return $new_array;
    }    


    function isPost(){
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }


/*
  -------------------------------------------------------------------
  Nombre: get_print_r
  -------------------------------------------------------------------
  Descripción:
  hace un print_r de la variable recibida, encerrandolas en
  la etiqueta: <pre></pre>, para ver el contenido del arreglo
  de forma clara; solo es para testear los contenidos.
  -------------------------------------------------------------------
  Entradas:
  $array: arreglo
  -------------------------------------------------------------------
  Salida: arreglo tabulado por las etiquetas "pre"
  -------------------------------------------------------------------
 */
function get_print_r($array = []) // utilidad para el proceso de desarrollo
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

