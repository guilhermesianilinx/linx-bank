<?php

namespace App\Exceptions;

use DomainException;

class InsufficientFundsException extends DomainException
{
    private int $currentBallance;
    private int $withdrawalAmount;

    public function __construct(int $currentBallance, int $withdrawalAmount)
    {
        $this->currentBallance = $currentBallance;
        $this->withdrawalAmount =$withdrawalAmount;

        parent::__construct(
            $this->customMessage()
        );
    }

    private function customMessage(): string
    {
        return "Saldo insuficiente para saque. " .
        "Valor da conta: " . $this->currentBallance .
        "Valor tentantiva saque: " . $this->withdrawalAmount;
    }
}