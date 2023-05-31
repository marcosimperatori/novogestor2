<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new \App\Models\UsuarioModel();

        $faker = \Faker\Factory::create('pt_BR');

        $qtdeRegistros = 5;

        $usuariosPush = [];

        for ($i = 0; $i < $qtdeRegistros; $i++) {

            array_push($usuariosPush, [
                'nome'          => $faker->unique()->name,
                'email'         => $faker->unique()->email,
                'password_hash' => '123456',
                'ativo'         => $faker->numberBetween(0, 1),
                'depto' => $faker->numberBetween(4, 7),
            ]);
        }

        $usuarioModel->skipValidation(true)
            ->protect(false)
            ->insertBatch($usuariosPush);

        echo "$qtdeRegistros criados com sucesso!";
    }
}
