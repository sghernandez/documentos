<form class="form-horizontal" id="form_documento" action="<?php echo url('registro/delete') ?>" method="post"> 
    <?php echo form_hidden('send', TRUE). form_hidden('id', $id) ?>	     
    <div class="text-center">¿ DESEA BORRAR EL DOCUMENTO ?</div>          
    <div class="form-group">
        <div class="col-sm-12"><br><br>
            <button type="submit" onclick="return valida_formulario('form_documento')" class="btn btn-danger btn-block">CONFIRMAR</button>
        </div>
    </div><br>
</form>
