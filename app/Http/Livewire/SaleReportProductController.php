<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\SaleDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class SaleReportProductController extends Component
{
    //Variables para almacenar fechas
    public $dateFrom, $dateTo;
    //Paginacion
    public $paginacion;


    use WithPagination;

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }
    public function mount()
    {
        $this->dateFrom = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->dateTo = Carbon::parse(Carbon::now())->format('Y-m-d');
        $this->paginacion = 100;
    }

    public function render()
    {
        $tabla_productos = Product::join("sale_details as sd","sd.product_id","products.id")
        ->join("sales as s","s.id","sd.sale_id")
        ->select("products.id as idproducto","products.nombre as nombre_producto", DB::raw('0 as cantidad_vendida'))
        ->where("s.status","PAID")
        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        ->distinct()
        ->paginate($this->paginacion);

        foreach($tabla_productos as $t)
        {
            $t->cantidad_vendida = $this->obtener_cantidad_vendida($t->idproducto);
        }


        return view('livewire.sales.salereportproduct', [
            'tabla_productos' => $tabla_productos,
        ])
            ->extends('layouts.theme.app')
            ->section('content');
    }


    //Obtiene la cantidad vendida de un producto en un llapso de tiempo
    public function obtener_cantidad_vendida($productoid)
    {
        $cantidad = SaleDetail::join("sales as s","s.id","sale_details.sale_id")
        ->where("sale_details.product_id",$productoid)
        ->whereBetween('s.created_at', [$this->dateFrom . ' 00:00:00', $this->dateTo . ' 23:59:59'])
        ->sum('sale_details.quantity');

        return $cantidad;
    }



}
