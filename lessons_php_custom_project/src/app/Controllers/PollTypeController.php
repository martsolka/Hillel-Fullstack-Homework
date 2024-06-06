<?php

namespace app\Controllers;

use app\Enums\PollTypeStatus;
use app\Models\PollType;
use core\Validator;
use core\Viewer;

class PollTypeController
{
  public function index(): void
  {
    $pollTypes = PollType::all();

    (new Viewer('poll-types.index', compact('pollTypes')))->render();
  }

  public function show(): void
  {
    $id = $_GET['id'] ?? -1;
    $pollType = PollType::find($id);

    echo '<pre>';
    var_dump($pollType);
    echo '</pre>';
  }

  public function create(): void
  {
    $statuses = PollTypeStatus::forSelect(PollTypeStatus::ARCHIVED);

    (new Viewer('poll-types.create', compact('statuses')))->render();
  }

  public function store(): void
  {
    $rules = [
      'name' => ['required', 'min:3', 'max:50'],
      'description' => ['nullable'],
      'status' => ['required', 'enum:' . implode(',', array_keys(PollTypeStatus::forSelect(PollTypeStatus::ARCHIVED)))],
    ];

    $data = array_reduce(array_keys($rules), fn ($acc, $fieldName) => [
      $fieldName => empty($_POST[$fieldName]) ? null : $_POST[$fieldName]
    ] + $acc, []);

    if ($errors = Validator::make($rules, $data)->validate()) {
      echo '<pre>';
      var_dump('errors', $errors);
      echo '</pre>';
      die;

      header('Location: /poll-types/create');
      exit;
    }

    PollType::make()->fill($data)->create();

    header('Location: /poll-types');
    exit;
  }
}
