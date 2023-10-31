// ******* Завдання 9. Піраміда з чисел *******

let pyramidRows = 5;

for (let i = 1; i <= pyramidRows; i++) {
  let numRow = `${i}`.repeat(i);
  console.log(`%c${numRow}`, "color: green; font-size: 20px;");
}