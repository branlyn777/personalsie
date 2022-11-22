<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
    	.titulo{
    		text-align: center;
    		margin-top: 10px;
    		font-size: 1.5em;
    	}
    	.subtitulo{
    		text-align: center;
    		margin-top: 1px;
    		font-size: 1.2em;
    	}
    	table{
		   
		    caption-side: bottom;
		    margin-left: auto;
		    margin-right: auto;
		    border-collapse: collapse;
		}

		th{
		    background-color: gray;
		    color: black;
		}

		caption{
		    padding-top: 20px;
		    font-style: italic;
		}

		td,th{
		    border: 1px solid black;
		    padding-left: 20px;
		    padding-right: 20px;
		    padding-top: 10px;
		    padding-bottom: 10px;
		}
    </style>
</head>
<body>
	
    <div class="container">
    	<h2 class="titulo">Soluciones Informaticas Emanuel</h2>
		<h3 class="subtitulo">Lista de Empleados <br>Fecha de Creacion: {{date('Y-m-d')}}</h3><br>
        <table>
            <thead>
                <tr>
                    <th>#</th>
	    			<th>Nro de C.I.</th>
	    			<th>Nombre completo</th>
	    			<th>Fecha de Nacimiento</th>
	    			<th>Direccion</th>
	    			<th>Telefono</th>
	    			<th>Area de Trabajo</th>
	    			<th>Cargo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $emp)
                    <tr>
                        <td>Num</td>
						{{-- <td>{{($empleados->currentpage()-1) * $empleados->perpage() + $loop->index + 1}}</td> --}}
                        <td style="text-align: left">{{$emp->ci}}</td>
                        <td style="text-align: left">{{$emp->name}} {{$emp->lastname}}</td>
                        <td style="text-align: left">{{$emp->dateNac}}</td>
                        <td style="text-align: left">{{$emp->address}}</td>
                        <td style="text-align: left">{{$emp->phone}}</td>
                        <td style="text-align: left">{{$emp->area}}</td>
                        <td style="text-align: left">{{$emp->cargo}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>