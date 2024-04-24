<?php

namespace App\Http\Controllers;

use App\Enums\PollTypeStatus;
use App\Http\Requests\StorePollTypeRequest;
use App\Http\Requests\UpdatePollTypeRequest;
use App\Models\PollType;
use Illuminate\Http\Request;

class PollTypeController extends Controller
{
    public function index()
    {
        // $pollTypes = PollType::query()->get();
        // $filtered1 = PollType::query()->where('status', PollTypeStatus::ACTIVE)->get();
        // $filtered2 = PollType::query()->whereNull('updated_at')->orderBy('created_at', 'desc')->get(['name', 'status']);   
        // dd($filtered1, $filtered2->toArray());

        $pollTypes = PollType::all();

        return view('poll-types.index', compact('pollTypes'));
    }

    public function create()
    {
        return view('poll-types.create');
    }

    public function store(StorePollTypeRequest $request)
    {
        $data = $request->only(['name', 'description', 'status']);
        // $pollType = (new PollType)->fill($data);
        // $isSaved = $pollType->save();
        $pollType = PollType::query()->create($data);

        return to_route('poll-types.index')->with('alert.message', "Poll type '{$pollType->name}' was successfully added to the database.");
    }

    public function edit(PollType $pollType)
    {
        // $pollType = PollType::query()->where('id', $id)->first();
        return view('poll-types.edit', compact('pollType'));
    }

    public function update(UpdatePollTypeRequest $request, PollType $pollType)
    {
        // $data = $request->only(['name', 'description', 'status']);
        // PollType::query()->where('id', $pollType->id)->update($data);

        $pollType->name = $request->input('name');
        $pollType->description = $request->input('description');
        $pollType->status = $request->enum('status', PollTypeStatus::class);
        $pollType->save();

        return to_route('poll-types.index')->with('alert.message', "Poll type with ID '{$pollType->id}' was successfully updated.");
    }

    public function destroy(PollType $pollType)
    {
        $pollType->delete();

        return to_route('poll-types.index')->with('alert.message', "Poll type with ID '{$pollType->id}' was successfully deleted from the database.");
    }

}
