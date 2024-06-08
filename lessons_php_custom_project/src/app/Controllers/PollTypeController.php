<?php

namespace app\Controllers;

use app\Enums\PollTypeStatus;
use app\Enums\QuestionType;
use app\Models\PollType;
use app\Models\PollTypeQuestion;
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
    $rules = $this->getRules('create');
    $data = $this->getPostData($rules);

    try {
      if ($errors = Validator::make($rules, $data)->validate()) {
        $_SESSION['errors']['poll_type'] = $errors;
        $_SESSION['old']['poll_type'] = $data;
        header('Location: /poll-types/create');
        exit;
      }
    } catch (\Exception $exception) {
      $errorLogPath = __DIR__ . '/../../storage/logs/error.log';
      $message = date('Y-m-d H:i:s') . ': ' . $exception->getMessage() . PHP_EOL;

      // if (!file_exists($errorLogPath)) {
      //   echo 'Error: File "' . $errorLogPath . '" does not exist.';
      //   exit;
      // }
      // file_put_contents($errorLogPath, $message, FILE_APPEND);

      echo '500 Server error';
      exit;
    }

    if (PollType::make()->fill($data)->create()) {
      $_SESSION['alert']['message'] = "Poll type '{$data['name']}' was successfully added to the database.";
    };

    header('Location: /poll-types');
    exit;
  }

  public function edit(): void
  {
    $id = $_GET['id'] ?? null;

    if (!$id) {
      header('Location: ' . '/poll-types');
      exit();
    }

    $pollType = PollType::find($id);
    $statuses = PollTypeStatus::forSelect();

    if (!$pollType) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => "Poll type with id '{$id}' does not exist."];
      header('Location: ' . '/poll-types');
      exit();
    }

    (new Viewer('poll-types.edit', compact('pollType', 'statuses')))->render();
  }

  public function update(): void
  {
    $id = $_POST['id'] ?? null;
    $rules = $this->getRules('update');
    $data = $this->getPostData($rules);

    if ($errors = Validator::make($rules, $data)->validate()) {
      $_SESSION['errors']['poll_type'] = $errors;
      $_SESSION['old']['poll_type'] = $data;
      header("Location: /poll-types/edit?id={$id}");
      exit();
    }

    if (PollType::find($id)->fill($data)->update()) {
      $_SESSION['alert']['message'] = "Poll type with id '{$id}' was successfully updated.";
    }

    header('Location: ' . '/poll-types');
    exit();
  }

  public function delete(): void
  {
    $id = $_GET['id'] ?? null;
    try {
      if (PollType::find($id)?->delete()) {
        $_SESSION['alert']['message'] = "Poll type with id '{$id}' was successfully deleted.";
      } else {
        throw new \Exception('Poll type with id \'' . $id . '\' was not found in the database.');
      }
    } catch (\Exception $exception) {
      $_SESSION['alert'] = ['type' => 'danger', 'message' => $exception->getMessage()];
    } finally {
      header('Location: ' . '/poll-types');
      exit();
    }
  }

  protected function getRules(string $action): array
  {
    $rules = [
      'create' => [
        'name' => ['required', 'min:3', 'max:50'],
        'description' => ['nullable'],
        'status' => ['required', 'enum:' . implode(',', array_keys(PollTypeStatus::forSelect(PollTypeStatus::ARCHIVED)))],
      ],
      'update' => [
        'id' => ['required'],
        'name' => ['required', 'min:3', 'max:50'],
        'description' => ['nullable'],
        'status' => ['required', 'enum:' . implode(',', array_keys(PollTypeStatus::forSelect()))],
      ]
    ];

    return isset($rules[$action]) ? $rules[$action] : [];
  }

  protected function getPostData(array $rules): array
  {
    return array_reduce(array_keys($rules), fn ($acc, $fieldName) => [
      $fieldName => trim($_POST[$fieldName] ?? '') ?: null
    ] + $acc, []);
  }
}
