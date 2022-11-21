<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato de Empleado</title>
</head>
<body>
    <h4 style="text-align: center">FORMATO DE CONTRATO</h4>
    <h4>Cochabamba: {{ date('Y-m-d') }}</h4>
    <h4 style="text-align: center">PRUEBA NRO 1</h4>

    @foreach ($contratos as $cont)
        <p>Lorem ipsum dolor, <b>Nombre completo: </b>{{$cont->name}} {{$cont->lastname}} sit amet consectetur <b>C.I.: </b>{{$cont->ci}} adipisicing elit.
             Voluptas <b>nro de telefono: </b>{{$cont->phone}} aperiam rerum veritatis debitis repellat consectetur porro architecto, 
             neque est perferendis dicta, quaerat, sit quos ex at ullam fugiat nulla aliquid!
        </p>

        <p>Lorem ipsum dolor <b>Salario: </b>{{$cont->salario}} sit amet consectetur adipisicing elit. <b>area de trabajo: </b>{{$cont->area}}
            Aspernatur pariatur <b>cargo: </b>{{$cont->cargo}} tempora exercitationem necessitatibus tenetur rem nihil nam saepe
            illo, accusamus voluptates totam ut earum, reprehenderit rerum cumque ipsam itaque aliquam exercitationem debitis.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, a quam. Laborum iure laboriosam assumenda 
            esse eius odio ea, voluptas repudiandae magnam rerum. <b>fecha de inicio: </b>{{\Carbon\Carbon::parse($cont->fechaInicio)->format('Y-m-d')}} Natus nam 
            <b>fecha de finalizacion: </b>{{\Carbon\Carbon::parse($cont->fechaFin)->format('Y-m-d')}}consectetur labore?
        </p>

        <h4>Parte I</h4>
        <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt natus dolor animi suscipit asperiores tempore similique,
             illo, accusamus voluptates totam ut earum, reprehenderit rerum cumque ipsam itaque aliquam exercitationem debitis.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, a quam. Laborum iure laboriosam assumenda
             quae atque officia incidunt veritatis, laudantium voluptatem aut quos voluptates id autem, eligendi tempore corporis!
             <br>
             Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt natus dolor animi suscipit asperiores tempore similique,
             illo, accusamus voluptates totam ut earum, reprehenderit rerum cumque ipsam itaque aliquam exercitationem debitis.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, a quam. Laborum iure laboriosam assumenda
             quae atque officia incidunt veritatis, laudantium voluptatem aut quos voluptates id autem, eligendi tempore corporis!
        </P>

        <h4>Parte   II</h4>
        <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt natus dolor animi suscipit asperiores tempore similique,
             illo, accusamus voluptates totam ut earum, reprehenderit rerum cumque ipsam itaque aliquam exercitationem debitis.
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis, a quam. Laborum iure laboriosam assumenda
             quae atque officia incidunt veritatis, laudantium voluptatem aut quos voluptates id autem, eligendi tempore corporis!
        </P>
        <br>
        <br>
        <br>
        <br>
        <h5 style="text-align: center"><b>Firma del Empleado</b></h5>
    @endforeach

</body>
</html>