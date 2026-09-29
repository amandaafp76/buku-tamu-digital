<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class PetugasDashboardController extends BaseController
{
    public function index()
    {
        return view('petugas/dashboard/index');
    }
}
