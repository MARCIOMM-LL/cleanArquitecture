<?php
#Aqui fica o modelo de domínio

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\CPF;
use Alura\Arquitetura\Dominio\Email;

class Aluno
{
    #Tipo passado diretamente nos atributos
    #isso é permitido a partir do php 7 em diante
    private CPF $cpf;
    private string $nome;
    private Email $email;
    private array $telefones;

    #Aqui está sendo usado o padrão de projeto 
    #named constructor/construtor nomeado que serve
    #basicamente para instânciar um objeto da própria 
    #classe através de um ou mais métodos estáticos
    public static function comCpfEmailNome(string $cpf, string $nome, string $email): self
    {
        return new Aluno(new CPF($cpf), $nome, new Email($email));
    }
    
    #Esse __construct possui em seus parâmetros os objetos
    #CPF E Email/classe
    public function __construct(CPF $cpf, string $nome, Email $email)
    {
        $this->cpf = $cpf;
        $this->nome = $nome;
        $this->email = $email;
    }

    public function adicionarTelefone(string $ddd, string $numero)
    {
        $this->telefones[] = new Telefone($ddd, $numero);
        return $this;
    }

    public function cpf(): string
    {
        return $this->cpf;
    }

    public function nome(): string
    {
        return $this->nome;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function telefones(): array
    {
        return $this->telefones;
    }

    
}
