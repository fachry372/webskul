<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;

class QuillController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index(): View
    {
        return view('quill');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request): JsonResponse
    {
        dd($request->all());
    }
}
