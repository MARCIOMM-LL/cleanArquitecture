<?php

namespace Alura\Arquitetura\Dominio\Aluno;

use Alura\Arquitetura\Dominio\CPF;

interface RepositorioDeAluno
{
    public function adicionar(Aluno $aluno): void;

    public function buscarPorCpf(CPF $cpf): Aluno;

    /** @return Aluno[] */
    public function buscarTodos(): array;
}