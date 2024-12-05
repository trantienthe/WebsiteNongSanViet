<?php

namespace App\Providers;

use App\Contracts\OrderContract;
use App\Repositories\OrderRepository;

class RepositoryServiceProvidr extends ServiceProvider
{
    protected $repositories = [
        CategoryContract::class         =>          CategoryRepository::class,
        AttributeContract::class        =>          AttributeRepository::class,
        BrandContract::class            =>          BrandRepository::class,
        ProductContract::class          =>          ProductRepository::class,
        OrderContract::class            =>          OrderRepository::class,
    ];
}