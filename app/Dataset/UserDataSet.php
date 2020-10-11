<?php

namespace App\Dataset;

class UserDataSet
{

    private string $name;
    private string $cpf;
    private string $bornAt;

    public function __construct(
        string $name,
        string $cpf,
        string $bornAt
    )
    {
        $this->name = $name;
        $this->cpf = $cpf;
        $this->bornAt = $bornAt;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getCpf(): string
    {
        return $this->cpf;
    }

    public function getBornAt(): string
    {
        return $this->bornAt;
    }
}