<?php

namespace Alura\Arquitetura;

class Email
{
    private string $endereco;

    public function __construct(string $endereco)
    {
        if (filter_var($endereco, FILTER_VALIDATE_EMAIL) === false) {
            throw new \InvalidArgumentException("Endereço de e-mail inválido");
        }
    }

    public function __toString(): string
    {
        return $this->endereco;
        return $this->endereco;
    }
}