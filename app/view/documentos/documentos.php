<?= $datatables ?>
<div class="panel panel-default">
    <div class="panel-heading text-center">
        <b style="font-size: 16px"><?= $title ?></b>             
        <span class="pull-right"> 
            <button type="button" class="btn btn-xs" onclick='ruta("registro/ingreso")'><i class="fad fa-plus" aria-hidden="true"></i>                    
                <i class="glyphicon glyphicon-refresh"></i>
            </button>
            &nbsp;
            <button type="button" class="btn btn-xs" onclick='carga_modal("registro/add")'><i class="fad fa-plus" aria-hidden="true"></i>                    
                <i class="glyphicon glyphicon-plus-sign"></i> <b>Nuevo</b> 
            </button>            
        </span>                  
    </div>   
        
    <div class="panel-body">
        <div class="dataTable_wrapper hide_filter">
            <div id="form_search" class="col-xs-12" style="margin-bottom: 15px">                                                  
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"></div>               
                <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                    <input type="text" name="search" id="0" placeholder="Buscar..." class="search form-control">                      
                </div>	                         

                <div class="col-xs-12 col-sm-1 col-md-1 col-lg-1">
                    <button type="button" onclick="search()" class="btn btn-inverse"><i class="glyphicon glyphicon-search"></i></button>
                </div>                                        
            </div>         
            <table id="dataTable" class="table table-bordered table-striped" style="margin-top: 40px"> 	
                <thead>
                    <tr>
                        <th class="text-center">CÓDIGO</th>
                        <th class="text-center">DOCUMENTO</th>
                        <th class="text-center">CONTENIDO</th>
                        <th class="text-center">PROCESO</th>	
                        <th class="text-center">TIPO</th>
                        <th class="text-center">EDITAR</th>  		
                        <th class="text-center">BORRAR</th>  
                    </tr>
                </thead>
                <tbody> 	
                </tbody>
            </table>
        </div>
    </div>
</div>    