<?php

namespace Alura\Arquitetura\Aplicacao\Aluno\MatriculaAluno;

#Aqui temos uma classe anêmica, ou seja, uma 
#classe desprovida de comportamento 
class MatriculaAlunoDto
{
    public string $cpfAluno;
    public string $nomeAluno;
    public string $emailAluno;

    public function __construct(string $cpfAluno, string $nomeAluno, string $emailAluno)
    {
        $this->cpfAluno = $cpfAluno;
        $this->nomeAluno = $nomeAluno;
        $this->emailAluno = $emailAluno;
    }
}    