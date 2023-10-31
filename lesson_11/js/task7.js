// ******* Завдання 7. Трикутник із зірочок *******

let stars = "";
let numRows = 5;

for (let i = 1; i <= numRows; i++) {
  stars += "*";
  console.log(`%c${stars}`, "color: orange; font-size: 20px;");
}