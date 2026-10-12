<?php
// GANTI Controller.php bawaan (Laravel 11+ tidak menyertakan trait authorize() secara default)
namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller
{
    use AuthorizesRequests;
}
