// ******* Завдання 10. Трикутник Паскаля *******

let triangleRows = 5;
let pascalTriangle = [];

// Цикл по рядках
for (let i = 0; i < triangleRows; i++) {
  // Створюємо відступи для красивого виведення
  let spacing = " ".repeat(triangleRows - i);
  // Масив для поточного рядка, завжди починається з 1
  let numRow = [1]; 
  // Цикл по елементах рядка
  for (let j = 1; j < i; j++) {
    // Обчислюємо елемент як суму 2 чисел з попереднього рядка
    numRow.push(pascalTriangle[i - 1][j - 1] + pascalTriangle[i - 1][j]);
  }
  // Додаємо 1 в кінець рядка, якщо це не перший рядок
  if (i !== 0) {
    numRow.push(1);
  }
  pascalTriangle.push(numRow);

  console.log(
    `%c${spacing}${pascalTriangle[i].join(" ")}`,
    "color: purple; font-size: 20px;"
  ); 
}

console.log(pascalTriangle);