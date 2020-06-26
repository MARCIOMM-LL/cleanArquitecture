<?php

#O namespace Alura\Arquitetura faz referência a pasta src
#a pasta Indicacao faz referência a onde o arquivo Indacacao.php
#se encontra. Não cita o arquivo, somente a pasta
namespace Alura\Arquitetura\Dominio\Indicacao;

#O use faz referência às classes que precisam ser importadas
#que inicia sua importação desde a pasta src até onde se 
#encontra o arquivo em questão. Cita o arquivo além da pasta
use Alura\Arquitetura\Dominio\Aluno\Aluno;

class Indicacao
{
    private Aluno $indicante;
    private Aluno $indicado;
    #\DateTimeImmutable é uma classe que tem o mesmo
    #comportamento que a classe DateTime, somente com
    #exceção que não sofrerá mutabilidade. A barra antes
    #serve para fazer a importação
    private \DateTimeImmutable $data;

    public function __construct(Aluno $indicante, Aluno $indicado)
    {
        $this->indicante = $indicante;
        $this->indicado = $indicado;

        $this->data = new \DateTimeImmutable();
    }
}