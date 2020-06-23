<?php

namespace Alura\Arquitetura;

class CPF
{
    private string $numero;

    public function __construct(string $numero)
    {
        #A este procedimento se dá o nome de self encapsulation,
        #o filtro não está sendo feito diretamenteno __construtor
        $this->setNumero($numero);
    }

    #Aqui está sendo realizado o Guard Clause/ Cláusula de Guarda,
    #ou seja, é feito o filtro antes de atribuir diretamente no __construtor
    private function setNumero(string $numero)
    {
        $opcoes = [
            'options' => [
                'regexp' => '/\d{3}\.\d{3}\.\d{3}\-\d{2}/'
            ]
        ];
        if(filter_var($numero, FILTER_VALIDATE_REGEXP, $opcoes) === false) {
            throw new \InvalidArgumentException("CPF no formato inválido");
        }

        $this->numero = $numero;
    }

    
}