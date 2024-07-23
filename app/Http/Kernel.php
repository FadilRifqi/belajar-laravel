<?php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'pegawai' => \App\Http\Middleware\Pegawai::class,
        'admin' => \App\Http\Middleware\Admin::class,
    ];
}