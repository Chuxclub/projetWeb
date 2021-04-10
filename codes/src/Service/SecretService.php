<?php


namespace App\Service;


class SecretService
{

    public function getSecretMessage(): string
    {
        $messages = [
            "Ne vous inquietez pas Garrus, vous etes toujours aussi moche qu'avant.",
            "Max, never Maxine.",
            "Excuuuuuse me, Princess !",
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }

    public function getReverseMessage(): string
    {
        $reverse = strrev($this->getSecretMessage());

        return $reverse;
    }
}