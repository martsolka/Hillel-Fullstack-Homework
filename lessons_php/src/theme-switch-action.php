<?php require_once('functions.php');
if (isset($_POST['theme'])) {
  setcookie('theme', 'dark', time() + 60 * 60 * 24 * 30, '/'); // sec*min*hour*day = 30 days from now
}
if (isset($_COOKIE['theme']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
  setcookie('theme', '', 1, '/'); // expire the cookie
}
redirect($_SERVER['HTTP_REFERER'] ?? '/'); // redirect back to where we came from