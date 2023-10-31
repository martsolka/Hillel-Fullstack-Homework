// ******* Завдання 4. Виведення послідовності чисел *******

let start = 1;
let end = 100;
let current;

// спосіб 1: по одному з кожного рядка
current = start;
while (current <= end) {
  console.log(current++);
}
current = end;
while (current >= start) {
  console.log(current--);
}

// спосіб 2: масивом
let numbers = [];
current = start;
while (current <= end) {
  numbers.push(current++);
}
console.log(numbers);
console.log(numbers.reverse());