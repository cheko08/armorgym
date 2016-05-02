<html>
<head>
	<meta charset="utf-8">
</head>
<body>
	<div class="email-background" style="background-color:#000080;background-image:none;background-repeat:repeat;background-position:top left;background-attachment:scroll;color:#000080;padding-top:10px;padding-bottom:10px;padding-right:10px;padding-left:10px;" >
		<div class="pre-header" style="color:#000080;">
			Gracias por escoger Armor Gym. En este correo podrás  encontrar tus datos de registro. 
		</div>
		
		<div class="email-container" style="max-width:500px;font-family:sans-serif;color:#fff;margin-top:0;margin-bottom:0;margin-right:auto;margin-left:auto;text-align:center; overflow:hidden;" >
			<?php

			$fecha_inscripcion = $miembro->fecha_inscripcion;
			$fecha_inscripcion = date("d/m/Y", strtotime($fecha_inscripcion));

			?>

			<h1 style="color:#fff;">Bienvenido a Armor Gym</h1>
			
			<p style="color:#fff;">Hola {{$miembro->nombre}}, tu número de socio es <strong>{{$miembro->id}}</strong> </p>
			<p style="color:#fff;">Tu membresía ({{$miembro->membresia->nombre}}) incluye <strong>{{$miembro->membresia->descripcion}}</strong> y tiene un costo de <strong>${{$miembro->membresia->precio_mensual}}.00 MXN</strong> pesos por mes.</p>
			<p style="color:#fff;">Tu fecha de inscripción es: <strong>{{$fecha_inscripcion}}</strong></p>
			<img src="http://www.armorgym.com.mx/assets/images/armorgym.jpg" alt="Armor Gym" style="max-width:100%;" >
		</div>
		
	</div>
</body>
</html>