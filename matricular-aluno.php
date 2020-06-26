<?php
#Aqui fica a interface gráfica do usuário

use Alura\Arquitetura\Dominio\Aluno\Aluno;
use Alura\Arquitetura\Infra\Aluno\RepositorioDeAlunoEmMemoria;

require_once 'vendor/autoload.php';

#A variável $argv serve para manipular através do CLI
$cpf = $argv[1];
$nome = $argv[2];
$email = $argv[3];
$ddd = $argv[4];
$numero = $argv[5];

$aluno = Aluno::comCpfEmailNome($cpf, $nome, $email)->adicionarTelefone($ddd, $numero);
$repositorio = new RepositorioDeAlunoEmMemoria();
$repositorio->adicionar($aluno);