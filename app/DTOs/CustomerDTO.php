<?php

namespace App\DTOs;

class CustomerDTO
{
    public string $name;
    public ?string $email;
    public string $city;

    public function __construct(string $name, ?string $email, string $city)
    {
        $this->name = $name;
        $this->email = $email;
        $this->city = $city;
    }

    /**
     * Método para criar o DTO a partir da requisição validada
     */
    public static function fromRequest(array $data): self
    {
        return new self(
            $data['name'],
            $data['email'] ?? null,
            $data['city']
        );
    }
}
