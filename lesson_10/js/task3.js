// ******* Завдання 3. Запит інформації у користувача *******

let userName = prompt("Як Вас звати?");
let userAge = prompt("Скільки Вам років?");

// Перевірка на те, чи користувач ввів дані:
// - якщо не ввів і натиснув Ок - prompt() верне пустий рядок("");
// - якщо натиснув Cancel - prompt() верне null.
// І null, і "" є логічними false.
if (userName && userAge) {
  alert(`${userName}, тобі зараз ${userAge}`);
} else {
  alert(`Деяка інформація про Вас відсутня...`);
}