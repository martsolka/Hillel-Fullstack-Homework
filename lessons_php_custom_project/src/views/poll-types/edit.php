<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poll Types | Edit Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="min-vh-100 bg-primary-subtle d-flex">
  <div class="container my-auto py-4">
    <div class="card shadow-sm border-0 col-lg-8 mx-auto">
      <div class="card-header">
        <h2 class="card-title text-center">Edit Poll Type</h2>
      </div>
      <div class="card-body">
        <?php
        $errors = $_SESSION['errors']['poll_type'] ?? [];
        $old = $_SESSION['old']['poll_type'] ?? [];
        unset($_SESSION['errors']['poll_type'], $_SESSION['old']['poll_type']);
        ?>
        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form action="/poll-types/update" method="POST" id="poll-type-create" class="row g-3 row-cols-1 row-cols-md-auto">
          <div class="col col-lg-4">
            <div class="form-floating">
              <input type="text" name="name" id="name" class="form-control <?= $errors['name'] ?? '' ? 'is-invalid' : '' ?>" value="<?= $old['name'] ?? $pollType->name ?? '' ?>" placeholder="Enter name">
              <label for="name" class="form-label">Name</label>
            </div>
          </div>
          <div class="col flex-grow-1">
            <div class="form-floating">
              <input type="text" name="description" id="description" class="form-control <?= $errors['description'] ?? '' ? 'is-invalid' : '' ?>" value="<?= $old['description'] ?? $pollType->description ?? '' ?>" placeholder="Enter description">
              <label for="description" class="form-label">Description</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <select name="status" id="status" class="form-select <?= $errors['status'] ?? '' ? 'is-invalid' : '' ?>">
                <option value="" selected disabled>-- Choose --</option>
                <?php foreach ($statuses as $value => $label) : ?>
                  <option value="<?= $value ?>" <?= ($old['status'] ?? $pollType->status) === $value ? 'selected' : '' ?>><?= $label ?></option>
                <?php endforeach; ?>
              </select>
              <label for="status" class="form-label">Status</label>
            </div>
          </div>
        </form>
      </div>
      <div class="card-footer hstack justify-content-between gap-2">
        <button type="submit" form="poll-type-create" class="btn btn-dark fw-medium text-nowrap" name="id" value="<?= $pollType->id ?>">✔ Submit Form</button>
        <a href="/poll-types" class="btn bg-light fw-medium text-nowrap link-body-emphasis">📃 Poll Types &rarr;</a>
      </div>
    </div>
    <div class="card shadow-sm border-0 col-lg-8 mx-auto mt-3">
      <div class="card-header">
        <h3 class="card-title">📃 Poll Type Questions</h3>
      </div>
      <div class="card-body">
        <?php
        $errors = $_SESSION['errors']['question'] ?? [];
        $old = $_SESSION['old']['question'] ?? [];
        unset($_SESSION['errors']['question'], $_SESSION['old']['question']);
        ?>
        <?php if ($errors) : ?>
          <div class="alert alert-danger">
            <ul class="mb-0">
              <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <form action="/poll-type-questions/store" method="POST" id="question-create" class="row g-3 row-cols-1 row-cols-md-auto mb-3">
          <div class="col flex-grow-1">
            <div class="form-floating">
              <input type="text" name="question" id="question" class="form-control <?= $errors['question'] ?? '' ? 'is-invalid' : '' ?>" value="<?= $old['question'] ?? '' ?>" placeholder="Question text">
              <label for="question" class="form-label">Question text</label>
            </div>
          </div>
          <div class="col">
            <div class="form-floating">
              <select name="type" id="type" class="form-select <?= $errors['type'] ?? '' ? 'is-invalid' : '' ?>">
                <option value="" selected disabled>-- Choose --</option>
                <?php foreach (\app\Enums\QuestionType::cases() as $questionType) : ?>
                  <option value="<?= $questionType->value ?>" <?= $old['type'] ?? '' === $questionType->value ? 'selected' : '' ?>><?= $questionType->label() ?></option>
                <?php endforeach; ?>
              </select>
              <label for="type" class="form-label">Type</label>
            </div>
          </div>
          <div class="col">
            <button type="submit" form="question-create" class="btn link-body-emphasis bg-light border fw-medium text-nowrap h-100" name="poll_type_id" value="<?= $pollType->id ?>">➕ Add New</button>
          </div>
        </form>
        <?php if (!empty($questions = $pollType->questions())) : ?>
          <ol class="list-group list-group-numbered">
            <?php foreach ($questions as $question) : ?>
              <li class="list-group-item d-flex justify-content-between ">
                <div class="ms-2 me-3 flex-grow-1">
                  <div class="fw-bold"><?= $question->question ?></div>
                  <small class="text-muted">Type: <?= $question->questionType()->label() ?> | ID:<?= $question->id ?></small>
                </div>
                <a class="btn btn-sm bg-light-subtle align-self-center border" href="/poll-type-questions/delete?id=<?= $question->id ?>" onclick="return confirm('Are you sure you want to delete this question (<?= $question->question ?>)?')">❌</a>
              </li>
            <?php endforeach; ?>
          </ol>
        <?php else : ?>
          <p class="card-text text-center lead text-muted">👀 No questions found in this poll type</p>
        <?php endif; ?>
      </div>
    </div>
  </div>
</body>

</html>