<?php

namespace App\model;
use App\model\DB_CORE\DB;


class RegistroModel extends DB {

    public function __construct(){
        if(! isLoggedIn()) { redirect('ccomercial/login'); }
    }
    
    public function getDocumentos($order_by=FALSE)
    {
      $limit = '';
      $sort_columns = ['DOC_CODIGO', 'DOC_NOMBRE', 'DOC_CONTENIDO', 'PRO_NOMBRE', 'TIP_NOMBRE', 'DOC_ID'];    
      $q = @$_POST['columns'][0]['search']['value'];
      $search = $this->datatables_search($sort_columns, $q, 1);   
      
      if ($order_by) {
       //  $limit = $this->datatables_limit('DOC_NOMBRE', @$sort_columns[$_POST['order'][0]['column']]);
      }      

       $sql = "SELECT ". implode(',', $sort_columns)." FROM DOC_DOCUMENTO 
              JOIN PRO_PROCESO ON DOC_ID_PROCESO = PRO_ID 
              JOIN TIP_TIPO_DOC ON DOC_ID_TIPO = TIP_ID". $search. $limit;
       
      if(! $q){ $sql .= $limit; }
       
      return $this->getRows('', $sql) ? : [];   
      
    }    
    
    
    public function validar_documento()
    {                        
            $validator = [
                'nombre' => 'required|min_len(5)', 
                'contenido' => 'required|min_len(10)',   
                'tipo' => 'required',
                'proceso' => 'required',                   
            ];
            
            $codigo_valido = TRUE;
            $idEnviado = post('id');
            $data = validate($validator, []);
            $tipo_actual = $this->getRow('TIP_TIPO_DOC', ['TIP_ID' => post('tipo')]);
            $proceso_actual = $this->getRow('PRO_PROCESO', ['PRO_ID' => post('proceso')]);  
            
            $codigo = @$tipo_actual->TIP_PREFIJO.'-'.@$proceso_actual->PRO_PREFIJO.'-';
            if( ! ($id = $idEnviado) )
            {
                $sql = 'SELECT MAX(DOC_ID) AS DOC_ID FROM DOC_DOCUMENTO';
                $result = $this->getRows('', $sql);
                
                $id = (isset($result[0]) ? $result[0]->DOC_ID : 0); 
                $id++;
                
                $cquery = $this->getRow('DOC_DOCUMENTO', ['DOC_CODIGO' => $codigo . $id]);
                $codigo_valido = isset($cquery->DOC_ID) ? FALSE : TRUE;
            }
                                  
            $codigo .= $id; 
            
            if(! $codigo_valido)
            {
                $data['has_error'] = TRUE;
                $data['error_nombre'] = 'El código: '. $codigo. ' ya se encuentra registrado'
                    . ' por favor cierre y abra nuevamente el formulario.';
            }            
            
            if (! array_key_exists('has_errors', $data)) 
            {    
                $doc = [
                    'DOC_CODIGO' => $codigo,
                    'DOC_CONTENIDO' => post('contenido'),
                    'DOC_ID_PROCESO' => post('proceso'),
                    'DOC_ID_TIPO' => post('tipo'),
                    'DOC_NOMBRE' => post('nombre')
                ];
                
                if($idEnviado){ $this->updateWhere('DOC_DOCUMENTO', $doc, ['DOC_ID' => $idEnviado]); }
                else
                { 
                   $this->conn();
                   $sql = "INSERT INTO DOC_DOCUMENTO "
                        . "(". implode(', ', array_keys($doc)).")"
                        . " VALUES (?,?,?,?,?)";
                   
                    $new_array = explode(',', implode(',', $doc));
                    $stm = $this->pdo->prepare($sql);    
                    $stm->execute($new_array); 
                    // $this->insert('DOC_DOCUMENTO', $doc);                     
                }
                
                $data['info'] = 'Datos guardados correctamente.';    
            }  

            return $data;

    }
        
    
    function datatables_limit($defult, $col)
    {
        $sql = '';
        $limit = post('length');
        $page = post('start');

        $sql .= " LIMIT " . ( ( $page - 1 ) * $limit ) . ", $limit";

        if ($col) 
        {
            $dir = strtoupper(@$_POST['order'][0]['dir']);
            $order = in_array($dir, ['ASC', 'DESC']) ? $dir : 'ASC';
            $sql .= " ORDER BY $dir $order ";
        }
        else { $sql .= " ORDER BY $defult "; }
        
        return $sql;
    }     
   
    
    public function registrar_ingreso($id)
    {
        $dataInsert = [
            'Ccomercial_id' => $_SESSION['user_id'],
            'Persona_id' => $id
        ];     

        return $this->insert('Ingreso', $dataInsert);
    }    


    public function validate_unique($data)
    {        
        if($this->getRow('Persona', ['Persona_email' => post('email')]))
        {
            $data['email_err'] = 'El email ya está registrado';
            $data['has_errors'] = TRUE;
        }            

        if($this->getRow('Persona', ['Persona_documento' => post('documento')]))
        {
            $data['documento_err'] = 'El documento ya está registrado';
            $data['has_errors'] = TRUE;
        }       
        
        return $data;
    }
    
}