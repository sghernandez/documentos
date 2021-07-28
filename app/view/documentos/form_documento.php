<form class="form-horizontal" id="form_documento" action="<?php echo url('registro/add') ?>" method="post">
    <?= form_hidden('send', TRUE). form_hidden('id', (isset($doc->DOC_ID) ? $doc->DOC_ID : 0)) ?>	
    
    <div class="info"></div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label">Código:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" name="cod_actual" value="<?= isset($doc->DOC_CODIGO) ? $doc->DOC_CODIGO : '' ?>" readonly>
            <div><b>Este código es autogenerado</b></div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="col-sm-3 control-label">Nombre Doc:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= isset($doc->DOC_NOMBRE) ? $doc->DOC_NOMBRE : '' ?>" placeholder="Nombre" required>
            <div id="error_nombre" class="error"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Contenido:</label>
        <div class="col-sm-8">
             <textarea rows="3" id="contenido" name="contenido" class="form-control" placeholder="Contenido" required><?= isset($doc->DOC_CONTENIDO) ? $doc->DOC_CONTENIDO : '' ?></textarea>
             <div id="error_contenido" class="error"></div>
        </div>
    </div>									
    <div class="form-group">
        <label class="col-sm-3 control-label">Tipo:</label>
        <div class="col-sm-8">
            <select name="tipo" id="tipo" class="form-control">
                <option value="">Seleccione un Tipo</option>
                <?php foreach($tipos as $r): 
                     $tipoDoc = isset($doc->DOC_ID_TIPO) ? $doc->DOC_ID_TIPO : '' ?>
                     <option value="<?php echo $r->TIP_ID ?>" <?php echo $r->TIP_ID == $tipoDoc ? 'selected' : '' ?> >
                           <?php echo "$r->TIP_NOMBRE - $r->TIP_PREFIJO" ?>
                     </option>
                <?php endforeach ?>
            </select>
            <div id="error_tipo" class="error"></div>
        </div>
    </div>	
    
    <div class="form-group">
        <label class="col-sm-3 control-label">Proceso:</label>
        <div class="col-sm-8">
            <select name="proceso" id="proceso" class="form-control">
                <option value="">Seleccione un Proceso</option>
                <?php foreach($procesos as $r): 
                     $tipop = isset($doc->DOC_ID_PROCESO) ? $doc->DOC_ID_PROCESO : '' ?>
                     <option value="<?php echo $r->PRO_ID ?>" <?php echo $r->PRO_ID == $tipop ? 'selected' : '' ?> >
                           <?php echo "$r->PRO_NOMBRE - $r->PRO_PREFIJO" ?>
                     </option>
                <?php endforeach ?>
            </select>
            <div id="error_proceso" class="error"></div>
        </div>
    </div>	    
    
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" onclick="return valida_formulario('form_documento')" class="btn btn-inverse btn-block">Guardar</button>
        </div>
    </div><br>
    </form>
    