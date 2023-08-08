<?php

namespace App\Dtos;

use Spatie\LaravelData\Data;

class PostData extends Data
{
    public function __construct(
        public int $id,
        public int $userId,
        public string $title,
        public string $body,
    ){}
}