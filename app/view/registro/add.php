<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card bg-light mt-5">
            <div class="card-header card-text">
                <?php flash('register_success'); ?>
                <h2 class="card-text">Registro Ciudadano</h2>
            <p class="card-text">Por favor ingrese todos los campos</p>
            </div>
        
            <div class="card-body">
                <form method="post" action="">
                    <div class="form-group">
                        <label for="name">Nombre<sub>*</sub></label>
                        <input type="text" name="nombre" required class="form-control form-control-lg <?php echo (!empty($data['nombre_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['nombre'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['nombre_err'] ;?> </span>
                    </div>
                     
                    <div class="form-group">
                        <label for="name">Apellido<sub>*</sub></label>
                        <input type="text" name="apellido" required class="form-control form-control-lg <?php echo (!empty($data['apellido_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['apellido'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['apellido_err'] ;?> </span>
                    </div>                    

                    <div class="form-group">
                        <label for="name">Documento<sub>*</sub></label>
                        <input type="number" name="documento" required class="form-control form-control-lg <?php echo (!empty($data['documento_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['documento'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['documento_err'] ;?> </span>
                    </div>                  

                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>">
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    <input type="hidden" name="nuevo" value="<?php echo $data['nuevo']  ?>">
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-info btn-block pull-left" value="REGISTRAR CIUDADANO">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>