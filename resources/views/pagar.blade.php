@extends('layouts.app')

@section('content')
  <br><br>
  <div>sfsdfadsfsadfasdfsa</div>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-form-title" style="background-image: url(perso/images/fondo1.jpg);">
					<span class="login100-form-title-1">
						Proceder pago
					</span>
				</div>

				<form class="login100-form validate-form">
					<div class="wrap-input100 validate-input m-b-26" data-validate="Nombre es requerido">
						<span class="label-input100">sfsdfsafsad</span>
						<input class="input100" type="text" name="username">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input m-b-18" data-validate = "Apellido es requerido">
						<span class="label-input100">Apellido</span>
						<input class="input100" type="text" name="pass">
						<span class="focus-input100"></span>
					</div>
					<div class="wrap-input100 validate-input m-b-18">
						<span class="label-input100">Seleccionar archivo</span>
						<div class="custom-file" style="margin-top: 10px">
							<input type="file" class="custom-file-input" id="validatedCustomFile" required>
							<label class="custom-file-label" for="validatedCustomFile">Seleccionar archivo...</label>
							<div class="invalid-feedback">Seleccione un archivo porfavor</div>
						</div>
						<span class="focus-input100"></span>
					</div>
         <!-- <div class="wrap-input100 validate-input m-b-18" data-validate = "Numero de tarjeta es requerido">
						<span class="label-input100">Numero de tarjeta</span>
						<input class="input100" type="number" name="pass">
						<span class="focus-input100"></span>
					</div>
          <div class="wrap-input100 validate-input m-b-18" data-validate = "Mes de vencimiento es requerido">
						<span class="label-input100">Mes de vencimiento</span>
						<input class="input100" type="text" name="pass" placeholder="MM/AA">
						<span class="focus-input100"></span>
					</div>
          <div class="wrap-input100 validate-input m-b-18" data-validate = "Codigo de seguridad es requerido">
						<span class="label-input100">Codigo de seguridad</span>
						<input class="input100" type="number" name="pass" placeholder="CVV">
						<span class="focus-input100"></span>
					</div> -->

					<!-- <div class="flex-sb-m w-full p-b-30">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt1">
								Forgot Password?
							</a>
						</div>
					</div> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Cargar
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
