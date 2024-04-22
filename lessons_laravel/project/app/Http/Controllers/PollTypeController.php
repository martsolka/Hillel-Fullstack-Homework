<?php

namespace App\Http\Controllers;

use App\Models\PollType;
use Illuminate\Http\Request;

class PollTypeController extends Controller
{
    public function index()
    {
        // $pollTypes = PollType::query()->get();
        $pollTypes = PollType::all();

        return view('poll-types.index', compact('pollTypes'));
    }

    public function create()
    {
        return view('poll-types.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
