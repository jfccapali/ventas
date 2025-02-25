<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Producto::create(
            [
                'id_categoria' => '1',
                'nombre_producto' =>'PRODUCTO 1',
                'estado'=>'1',
                'stock'=>20,
                'precio'=>50.5,
            ]
        );

        Producto::create(
            [
                'id_categoria' => '2',
                'nombre_producto' =>'PRODUCTO 2',
                'estado'=>'1',
                'stock'=>15,
                'precio'=>200.55,
            ]
        );

    }
}
