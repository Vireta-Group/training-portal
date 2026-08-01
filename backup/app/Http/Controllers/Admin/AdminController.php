<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

abstract class AdminController extends Controller
{
    protected function viewDir(): string
    {
        return '';
    }

    protected function view(string $view, array $data = []): View
    {
        return view("admin.{$this->viewDir()}.{$view}", $data);
    }
}
