<?php

namespace App\Http\Controllers;

use App\Http\Requests;

/**
 * Class VueTableController
 * @package App\Http\Controllers
 */
class VueTableController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vue-table.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function bootstrap()
    {
        return view('vue-table.bootstrap-view');
    }

}
