// ******* Завдання 8. Таблиця множення 2.0 *******

let multTable2 = [];

console.log(`%cТаблиця множення:`, "color: blue; font-weight: bold;");

for (let i = 1; i <= 10; i++) {
  let row = [];
  for (let j = 1; j <= 10; j++) {
    row.push(i * j);
  }
  multTable2.push(row);
}

console.table(multTable2);