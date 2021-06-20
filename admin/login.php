<div class="container">
	<div class="d-flex justify-content-center h-100">
		<div class="card">
			<div class="card-header">
				<h3>Formulario de Ingreso</h3>

			</div>
			<div class="card-body">
				<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="bi bi-person-fill" style="font-size: 17px;"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="usuario" name="login">
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="bi bi-key-fill" style="font-size: 17px;"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="contraseña"name="pass">
					</div>
					<!--<div class="row align-items-center remember">
						<input type="checkbox">Remember Me
					</div>-->
					<input type="hidden" name="id_u" id="id_u" value="">
					<div class="form-group">
						<input type="submit" value="Ingresar" class="btn float-right login_btn" name="enviare">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Ingresar Usuario<a href="#">Ingresar</a>
				</div>
				<!--<div class="d-flex justify-content-center">
					<a href="#">Forgot your password?</a>
				</div>-->
			</div>
		</div>
	</div>
</div>