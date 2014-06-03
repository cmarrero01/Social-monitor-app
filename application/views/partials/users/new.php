<?=$header;?>
<div id="container-smtv">
    <h3>Usuarios</h3>
    <div class="filtros-tabla clearfix">
        <div class="alert alert-<?=(isset($class))?$class:'';?>">
            <?=(isset($msg))?$msg:'';?>
        </div>
        <form action="<?=(isset($users) and !empty($users))?site_url('/usuarios/editUser'):site_url('/usuarios/addUser');?>">
            <div class="config-left">
                <input type="hidden" name="idAccount" value="1" />
                <label for="full_name">
                    Nombre y Apellido
                </label>
                <input type="text" value="<?=(isset($users[0]->full_name))?$users[0]->full_name:'';?>" name="full_name" id="full_name" />
                <label for="email">
                    Email
                </label>
                <input type="text" value="<?=(isset($users[0]->email))?$users[0]->email:'';?>" name="email" id="email" />
            </div>
            <div class="config-right line-right">
                <label for="password">
                    Password
                </label>
                <input type="password" value="" name="password" id="password" />
                <label for="rpassword">
                    Repeat-password
                </label>
                <input type="password" value="" name="rpassword" id="rpassword" />
            </div>
            <input type="submit" value="<?=(isset($users) and !empty($users))?'Editar usuario':'Nuevo Usuario'?>" name="newUser" class="btn btn-info" />
        </form>
    </div>
</div>
<?=$footer;?>