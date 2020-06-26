<?php

namespace Alura\Arquitetura\Dominio\Aluno;

interface CifradorDeSenha
{
    public function cifrar(string $senha): string;
    public function verificar(string $senhaTexto): bool;
}