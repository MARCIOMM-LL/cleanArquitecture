<?php

namespace Alura\Arquitetura;

#Fábrica neste contexto é uma classe que cria objetos 
#e não um padrão de projeto
class FabricaAluno
{
    private Aluno $aluno;

    #A palavra reservada self significa o método sempre irá
    #retornar a cada chamada uma instância/objeto da própria classe
    public function comCpfEmailNome(string $numeroCpf, string $email, string $nome): self
    {
        $this->aluno = new Aluno(new CPF($numeroCpf), $nome, new Email($email));
        return $this;
    }

    public function adicionaTelefone(string $ddd, string $numero): self
    {
        $this->aluno->adicionarTelefone($ddd, $numero);
        #O return $this serve para encadiar métodos da mesma classe
        return $this;
    }

    #No método aluno usamos o tipo/classe Aluno
    #como retorno, isso significa que iremos usar 
    #essa classe para retornar o objeto/instância 
    #já construída
    public function aluno(): Aluno
    {
        return $this->aluno;
    }
}

$fabrica = new FabricaAluno();
$fabrica->comCpfEmailNome('', '', '')
        ->adicionaTelefone('', '')
        ->aluno();