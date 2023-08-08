<?php

namespace App\Interfaces;

interface CachedPostsInterface
{
    public function index(): array;

    public function find(int $id): array;
}