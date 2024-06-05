<?php

namespace app\Controllers;

use app\Models\PollType;
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
}
