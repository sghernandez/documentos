<div class="container">
    <div class="col-md-6">
        <div>
            <div aling="center">
                <?php flash('register_success'); ?>
                <h2>Login Registro de Documentos</h2>                
            </div>
        
            <div class="well">
                <p class="text-center">Por favor ingrese su email y password</p>
                <form method="post" action="<?php echo URLROOT ?>/login/login">
                    <div class="form-group">
                        <label for="email">Email<sub>*</sub></label>
                        <input type="email" name="email" class="form-control form-control-lg <?php echo (!empty($data['email_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['email'] ;?>" required>
                        <span class="invalid-feedback"><?php echo $data['email_err'] ;?> </span>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password<sub>*</sub></label>
                        <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ? 'is-invalid' : '' ;?>" value="<?php echo $data['password'] ;?>" required>
                        <span class="invalid-feedback"><?php echo $data['password_err'] ;?> </span>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <input type="submit" class="btn btn-info btn-block" value="Ingresar">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>