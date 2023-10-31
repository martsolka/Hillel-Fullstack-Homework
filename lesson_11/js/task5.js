// ******* Завдання 5. Таблиця множення *******

let number = 5;
let limit = 10;
let multTable = [];

console.log(
  `%cТаблиця множення числа ${number}:`,
  "color: orange; font-weight: bold;"
);

for (let i = 1; i <= limit; i++) {
  multTable.push([number, i, number * i]);
}

console.table(multTable);