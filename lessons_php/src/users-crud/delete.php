<?php require_once('includes.php');

$id = (int)$_POST['id'] ?? -1;
$userModel = new UserModel();

if ($userModel->isDefaultAdmin($_POST)) {
  $_SESSION['alert'] = ['content' => "❌ You can't delete the default admin!", 'type' => 'danger'];
  AuthManager::goTo('/users-crud/');
}

$isDeleted = $userModel->delete($id);
if (AuthManager::currentUser()['id'] === $id) {
  AuthManager::signOut();
}

$_SESSION['alert'] = $isDeleted
  ? ['content' => "✔ User (ID: $id) successfully deleted from the database!", 'type' => 'success']
  : ['content' => "❌ Error while deleting user (ID: $id)!", 'type' => 'danger'];

AuthManager::goTo('/users-crud/');
