<?php

namespace App\controller;
use App\model\RegistroModel;

class RegistroController{

    public function __construct()
    {        
        $this->RegistroModel = new RegistroModel;
        $this->container = 'layouts/master';
    }

    public function ingreso()
    {  
        $data = [
           'title' => 'Listado de Documentos',
           'view' => 'documentos/documentos',                     
           'datatables' => (form_hidden('datatables_ruta', 'registro/documents_list'). form_hidden('datatables_targets', '-1, -2'))          
       ];

        if (is_ajax_request()) {
           return view($data['view'], $data);
        }      

        return view($this->container, array_merge($data));
    }

    
   /* */
   public function documents_list() 
   {
      $data = [];

      foreach ($this->RegistroModel->getDocumentos(TRUE) as $r) // $this->user->get_all_users(TRUE)
      {          
        $fn_edit = "carga_modal('" .'registro/add?id=' . $r->DOC_ID . "')";
        $fn_delete = "carga_modal('" .'registro/delete?id=' . $r->DOC_ID . "')";
        // $fn_delete = "if(confirm('Desea borrar el usuario?')) { ruta('" .'usercrud/add?id=' . $r->ID . "'); }";

        $fila = [];
        $fila[] = "<div align='center'>$r->DOC_CODIGO</div>";
        $fila[] = "<div align='center'>$r->DOC_NOMBRE</div>";
        $fila[] = "<div align='center'>$r->DOC_CONTENIDO</div>";
        $fila[] = "<div align='center'>$r->PRO_NOMBRE</div>";
        $fila[] = "<div align='center'>$r->TIP_NOMBRE</div>";
        $fila[] = '<div align="center"><span onclick="' . $fn_edit . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-edit"></i></span></div>';
        $fila[] = '<div align="center"><span onclick="' . $fn_delete . '" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-trash"></i></span></div>';
        
        $data[] = $fila;
     }

     
     $total = count($this->RegistroModel->getDocumentos());
     
     $salida = [
       'draw' => $_POST['draw'],
       'recordsTotal' => $total,
       'recordsFiltered' => $total,
        'data' => $data
      ];

      echo json_encode($salida);
            
    }
    
    
     /* Formulario para agregar/editar */
	 function add()
     {         
        $id = intval(post('id') ? : get('id'));        
        if(post('send')) 
        { 
           $result = $this->RegistroModel->validar_documento();                        
           echo json_encode ($result, JSON_UNESCAPED_SLASHES);
           return;            
        }
       
        $title = ($id ? 'Editar' : 'Nuevo'). ' Documento';
        $data = [
            'doc' => $id ? $this->RegistroModel->getRow('DOC_DOCUMENTO', ['DOC_ID' => $id]) : '',
            'tipos' => $this->RegistroModel->getRows('TIP_TIPO_DOC'),
            'procesos' => $this->RegistroModel->getRows('PRO_PROCESO'),            
        ];
        
        $view = view('documentos/form_documento', $data, TRUE);	
        
        echo json_encode(compact('view', 'title'));
	}     
    
    
    
    public function delete() 
    {
        $id = intval(post('id') ? : get('id'));        
        if(post('send')) 
        {  
           $this->RegistroModel->setQuery('DELETE FROM DOC_DOCUMENTO WHERE DOC_ID = ' . post('id'), FALSE);               
           $result['info'] = 'Documento borrado correctamente.';
           echo json_encode ($result, JSON_UNESCAPED_SLASHES);
           return;            
        }
       
        $title = 'Borrar Documento';
        $view = view('documentos/form_delete', ['id' => $id], TRUE);	
        
        echo json_encode(compact('view', 'title'));
    }
    

} // finaliza la clase