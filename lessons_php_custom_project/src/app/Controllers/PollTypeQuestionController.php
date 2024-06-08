<?php

namespace app\Controllers;

use app\Enums\QuestionType;
use app\Models\PollTypeQuestion;
use core\Validator;

class PollTypeQuestionController
{

  public function store(): void
  {
    $data = [
      'question' => trim($_POST['question']) ?: null,
      'type' => trim($_POST['type'] ?? '') ?: null,
      'poll_type_id' => trim($_POST['poll_type_id']) ?: null
    ];

    $rules = [
      'question' => ['required', 'min:3', 'max:255'],
      'type' => ['required', 'enum:' . implode(',', QuestionType::values())],
      'poll_type_id' => ['required'],
    ];

    if ($errors = Validator::make($rules, $data)->validate()) {
      $_SESSION['errors']['question'] = $errors;
      $_SESSION['old']['question'] = $data;

      header('Location: /poll-types/edit?id=' . $data['poll_type_id']);
      exit();
    }

    PollTypeQuestion::make()->fill($data)->create();

    header('Location: /poll-types/edit?id=' . $data['poll_type_id']);
    exit();
  }

  public function delete(): void
  {
    $id = $_GET['id'] ?? null;
    $question = PollTypeQuestion::find($id);

    if ($question?->delete()) {
      header('Location: ' . '/poll-types/edit?id=' . $question->poll_type_id);
      exit();
    }

    $_SESSION['alert'] = ['type' => 'danger', 'message' => "Question with id '{$id}' was not found in the database."];

    header('Location: /poll-types');
    exit();
  }
}
