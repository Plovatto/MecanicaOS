<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;
use \App\Validation\CustomRules;

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
    'email' => 'required|valid_email',
    'cpf' => 'required|exact_length[11]',
    'cnh' => 'permit_empty|exact_length[10]',
    'telefone' => 'permit_empty|valid_phone',
];
public $mecanico = [
    'nome_completo' => 'required',
    'endereco' => 'required',
    'email' => 'required',
    'cpf' => 'required',
    'tipo' => 'required',
    'senha' => 'required',
];

public $peca = [
    'nome' => 'required',
    'descricao' => 'required',
    'valor' => 'required',
];
public $servico= [
    'nome' => 'required',
    'descricao' => 'required',
    'valor' => 'required',
];

public $validationRules = [
    'valid_phone' => [
        'label' => 'Phone Number',
        'rules' => 'regex_match[/^[0-9]{10}$/]',
        'errors' => [
            'regex_match' => 'The {field} field must be a valid phone number.'
        ]
    ],
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
        CustomRules::class,
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
