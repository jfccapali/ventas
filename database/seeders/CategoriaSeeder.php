<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create(
            [
                'nombre_categoria' => 'ALIMENTOS',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'BELLEZA',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'DEPORTES',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'ELECTRODOMENTICOS',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'HIGIENE Y SALUD',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'MAQUILLAJE',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'ROPA',
                'estado'=>'1'
            ]
        );

        Categoria::create(
            [
                'nombre_categoria' => 'TECNOLOGIA',
                'estado'=>'1'
            ]
        );
    }
}
