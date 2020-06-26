<?php

namespace Alura\Arquitetura\Aplicacao\Aluno\MatriculaAluno;

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Dominio\Aluno\RepositorioDeAluno;

class MatriculaAluno
{

    private RepositorioDeAluno $repositorioDeAluno;

    public function executa(MatriculaAlunoDto $dados): void
    {
        $aluno = Aluno::comCpfEmailNome($dados->cpfAluno, $dados->nomeAluno, $dados->emailAluno);
        $this->repositorioDeAluno->adicionar($aluno);
    }
}