<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------
    public $equipe = [
        'nome' => 'required',
        'descricao' => 'required',
        'mecanico_id' => 'required',
        'especialidade_id' => 'required',
    ];
    
public $cliente = [
    'nome_completo' => 'required',
    'endereco' => 'required',
    'email' => 'required',
    'cpf' => 'required',
    'cnh' => 'required',
    'telefone' => 'required',
];
public $mecanico = [
    'nome_completo' => 'required',
    'endereco' => 'required',
    'email' => 'required',
    'cpf' => 'required',
    'tipo' => 'required',
    'senha' => 'required',
    'especialidade_id'  => 'required',
];

public $peca = [
    'nome' => 'required',
    'descricao' => 'required',
    'valor' => 'required',
];

public $especialidade = [
    'nome' => 'required',
    'descricao' => 'required',
   
];
public $servico= [
    'nome' => 'required',
    'descricao' => 'required',
    'valor' => 'required',
];



    public $veiculo = [
        'ano' => 'required',
        'placa' => 'required',
        'cor' => 'required',
        'descricao' => 'required',
        'cliente_id' => 'required',
        'marca_id' => 'required',
        'modelo_id' => 'required',
    ];
    
    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
