<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run()
    {
        $clienteModel = new \App\Models\ClienteModel();

        $faker = \Faker\Factory::create('pt_BR');

        $qteRegistros = 50;

        $clientes = [];
        $ie = 1000;

        for ($i = 0; $i < $qteRegistros; $i++) {
            $nome = $faker->unique()->company();

            $admissao = new \DateTime();
            $admissao->setDate(rand(1997, 2022), rand(1, 12), rand(1, 30));

            $certificado = new \DateTime();
            $certificado->setDate(rand(2018, 2025), rand(1, 12), rand(1, 30));

            $ie += 101;

            array_push($clientes, [
                'razao'             => $nome,
                'apelido'           => $nome,
                'cnpj'              => strval($faker->unique()->cnpj()),
                'ie'                => $ie,
                'ativo'             => $faker->numberBetween(0, 1),
                'controlacnd'       => $faker->numberBetween(0, 1),
                'movimentocontabil' => $faker->numberBetween(0, 1),
                'regimetributario'  => strval($faker->numberBetween(1, 8)),
                'tipo'              => strval($faker->numberBetween(1, 4)),
                'codigosimples'     => strval($faker->numberBetween(0, 100000)),
                'codigo'            => $faker->unique()->numberBetween(0, 1000),
                'clientedesde'      => $admissao->format('Y-m-d'),
                'vectocertificado'  => $certificado->format('Y-m-d'),
                'tipocertificado'   => 'a1'
            ]);
        }

        $clienteModel->skipValidation(false)->protect(false)->insertBatch($clientes);

        echo "$qteRegistros foram inseridos no banco de dados";
    }
}
