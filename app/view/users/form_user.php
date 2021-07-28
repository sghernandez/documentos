   
<form class="form-horizontal" id="form_usuario" action="" method="post">
    <?= form_hidden('send', TRUE)
        . form_hidden('id', (isset($user->ID) ? $user->ID : 0)) ?>	
    
    <div class="info"></div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Nombre:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?= isset($user->FIRSTNAME) ? $user->FIRSTNAME : '' ?>" placeholder="Nombre" required>
            <div id="error_nombre" class="error"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label">Apellido:</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido" required
                   value="<?= isset($user->LASTNAME) ? $user->LASTNAME : '' ?>">						  					    
                   <div id="error_apellido" class="error"></div>
        </div>
    </div>									
    <div class="form-group">
        <label class="col-sm-3 control-label">Email:</label>
        <div class="col-sm-8">
            <input type="email" class="form-control" id="email" id="email" name="email" placeholder="Email" required
                   value="<?= isset($user->EMAIL) ? $user->EMAIL : '' ?>">						  					    
            <div id="error_email" class="error"></div>
        </div>
    </div>	

    <div class="form-group">
        <label class="col-sm-3 control-label">Teléfono:</label>
        <div class="col-sm-8">
            <input type="number" class="form-control" minlength="7" maxlength="10" id="telefono" name="telefono" placeholder="Teléfono" required
                   value="<?= isset($user->TELEPHONE) ? $user->TELEPHONE : '' ?>">						  					    
                   <div id="error_telefono" class="error"></div>
        </div>
    </div>	
    <div class="form-group">
        <label class="col-sm-3 control-label">Edad:</label>
        <div class="col-sm-8">
            <input type="number" id="edad" id="edad" name="edad" class="form-control" min="18" maxlength="80" placeholder="Edad" required
                   value="<?= isset($user->AGE) ? $user->AGE : '' ?>">						  					    
                 <div id="error_edad" class="error"></div>
        </div>
    </div>            
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-8">
            <button type="submit" onclick="return valida_formulario('form_usuario')" class="btn btn-inverse btn-block">Guardar</button>
        </div>
    </div><br>
    </form>
    