<?php

namespace App\Http\Livewire;

use App\Models\Caja;
use App\Models\Cartera;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Sucursal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SaleListProductsController extends Component
{
    //Para consultas de fecha de inicio y fin
    public $dateFrom, $dateTo;
    //Guarda el id de la sucursal
    public $sucursal_id;
    //Variable que guarda el id del usuario seleccionado
    public $user_id;


    public function mount()
    {
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->sucursal_id = $this->idsucursal();
        $this->user_id = Auth::user()->id;
    }

    public function render()
    {

        if($this->user_id != "Todos")
        {
            $listaproductos = Product::join("sale_details as sd","sd.product_id","products.id")
            ->join("sales as s","s.id","sd.sale_id")
            ->join("users as u","u.id","s.user_id")
            ->join("carteras as c","c.id","s.cartera_id")
            ->join("cajas as cj","cj.id","c.caja_id")
            ->select("s.id as codigo","products.nombre as nombre_producto","sd.quantity as cantidad_vendida","s.created_at as fecha_creacion",
            "u.name as nombre_vendedor","sd.price as precio_venta",
            DB::raw('0 as nombresucursal'))
            ->where("cj.sucursal_id",$this->sucursal_id)
            ->where("s.user_id",$this->user_id)
            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
            ->orderBy("s.created_at","desc")
            ->get();
        }
        else
        {
            $listaproductos = Product::join("sale_details as sd","sd.product_id","products.id")
            ->join("sales as s","s.id","sd.sale_id")
            ->join("users as u","u.id","s.user_id")
            ->join("carteras as c","c.id","s.cartera_id")
            ->join("cajas as cj","cj.id","c.caja_id")
            ->select("s.id as codigo","products.nombre as nombre_producto","sd.quantity as cantidad_vendida","s.created_at as fecha_creacion",
            "u.name as nombre_vendedor","sd.price as precio_venta",
            DB::raw('0 as nombresucursal'))
            ->where("cj.sucursal_id",$this->sucursal_id)
            ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
            ->orderBy("s.created_at","desc")
            ->get();
        }

        //Llenando las columnas adicionales a la lsita de ventas
        foreach ($listaproductos as $l)
        {
            //Obtener el nombre de la sucursal de una venta
            $l->nombresucursal = $this->nombresucursal($l->codigo);
        }

        return view('livewire..sales.salelistproducts', [
            'listaproductos' => $listaproductos,
            'listasucursales' => Sucursal::all(),
            'listausuarios' => $this->listausuarios(),
        ])
        ->extends('layouts.theme.app')
        ->section('content');
    }


    //Listar a todos los usuarios que hayan realizado ventas en las fechas y sucursales seleccionadas
    public function listausuarios()
    {
        $listausuarios = User::join("sales as s", "s.user_id", "users.id")
        ->select("users.*")
        ->where("s.status","PAID")
        ->where("s.status","PAID")
        ->where("users.status","ACTIVE")
        ->groupBy("users.id")
        ->get();
        return $listausuarios;
    }
    //Obtener el Id de la Sucursal donde esta el Usuario
    public function idsucursal()
    {
        $idsucursal = User::join("sucursal_users as su","su.user_id","users.id")
        ->select("su.sucursal_id as id","users.name as n")
        ->where("users.id",Auth()->user()->id)
        ->where("su.estado","ACTIVO")
        ->get()
        ->first();
        return $idsucursal->id;
    }
    //Devuelve el nombre de la sucursal de una venta
    public function nombresucursal($idventa)
    {
        $venta = Sale::find($idventa);

        $cartera = Cartera::find($venta->cartera_id);

        $sucursal_id = Caja::find($cartera->caja_id)->sucursal_id;

        $nombresucursal = Sucursal::find($sucursal_id)->name;

        return $nombresucursal;
    }
}
