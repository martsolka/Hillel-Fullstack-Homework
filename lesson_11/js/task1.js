// ******* Завдання 1. Перевірка знака числа *******

let num1 = 45;
let num2 = -4.5;

console.log("%cСпосіб 1 - конструкція if...else:", "color: blue; font-weight: bold;");
if (num1 < 0) {
  console.log(`Число ${num1} - НЕГАТИВНЕ`);
} else {
  console.log(`Число ${num1} - ПОЗИТИВНЕ`);
}

console.log("%cСпосіб 2 - тернарний оператор (?:):", "color: blue; font-weight: bold;");
console.log(`Число ${num2} - ${(num2 > 0) ? "ПОЗИТИВНЕ" : "НЕГАТИВНЕ"}`);