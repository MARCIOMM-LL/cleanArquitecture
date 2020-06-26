<?php

namespace Alura\Arquitetura\Dominio\Aluno;

class Telefone
{
    private string $ddd;
    private string $numero;

    #O método mágico __construct irá iniciar os valores 
    #que seus parâmetros irão conter assim que forem passados
    public function __construct(string $ddd, string $numero)
    {
        $this->ddd = $ddd;
        $this->numero = $numero;
    }

    #O retorno do método com a palavra reservada void sinifica
    #que o método não irá retornar nada
    private function setDdd(string $ddd): void
    {
        #Aqui temos o uso de expressões regulares para validação
        #de telefone juntamente co exceções
        if(preg_match('/\d{2}/', $ddd) !== 1) {
            throw new \InvalidArgumentException("DDD inválido");
        }

        $this->ddd = $ddd;
    }

    private function setNumero(string $numero): void
    {
        if(preg_match('/\d{8,9}/', $numero) !== 1) {
            throw new \InvalidArgumentException("Número de telefone inválido");
        }

        $this->numero = $numero;
    }

    #O método mágico __toString() transforma um objeto em uma string
    public function __toString(): string
    {
        #Aqui no return está sendo usada a impressão interpolação
        return "({$this->ddd}) {$this->numero}";
    }

    public function ddd(): string
    {
        return $this->ddd;
    }

    public function numero(): string
    {
        return $this->numero;
    }
}