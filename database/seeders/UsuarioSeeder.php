<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'usuario' => 'usuario1',
            'contrasena' => bcrypt('12345678'),
            'nombres'=>'carlos',
            'apellido_paterno' => 'aguirre',
            'apellido_materno' => 'guevara',
            'direccion' => 'calle 1',
            'sexo' => 'M',
            'fecha_nacimiento' => '2000-01-01',
            'estado' => '1'
        ]);

        User::create([
            'usuario' => 'usuario2',
            'contrasena' => bcrypt('12345678'),
            'nombres'=>'martha',
            'apellido_paterno' => 'perez',
            'apellido_materno' => 'alvela',
            'direccion' => 'calle 2',
            'sexo' => 'F',
            'fecha_nacimiento' => '2015-06-11',
            'estado' => '1'
        ]);

        User::create([
            'usuario' => 'usuario3',
            'contrasena' => bcrypt('12345678'),
            'nombres'=>'mario',
            'apellido_paterno' => 'mendoza',
            'apellido_materno' => 'flores',
            'direccion' => 'calle 3',
            'sexo' => 'M',
            'fecha_nacimiento' => '1984-10-30',
            'estado' => '1'
        ]);
    }
}
