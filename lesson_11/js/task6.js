// ******* Завдання 6. Парні числа *******

let from = 1;
let to = 50;
let evenNums = [];

// спосіб 1: перевірка кожного елемента на парність
for (let i = from; i <= to; i++) {
  if (i % 2 === 0) {
    evenNums.push(i);
  }
}
console.log("Спосіб 1:", evenNums);
evenNums = [];

// спосіб 2 - якщо початкове значення непарне,
// збільшуємо до парного і в циклі перебираємо не кожен наступий, а з кроком 2:
if (from % 2 !== 0) {
  for (let i = from + 1; i <= to; i += 2) {
    evenNums.push(i);
  }
}
console.log("Спосіб 2:", evenNums);