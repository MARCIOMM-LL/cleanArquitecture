<?php

namespace Alura\Arquitetura\Dominio;

class Email
{
    private string $endereco;

    public function __construct(string $endereco)
    {
        #Função filter_var() juntamente com sua constante FILTER_VALIDATE_EMAIL 
        #para validar e-mail em uma estrutura condicional if()
        if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("Endereço de e-mail inválido");
        }
    }

    public function __toString(): string
    {
        return $this->endereco;
    }
}