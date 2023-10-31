// ******* Завдання 2. Перевірка порожнього тексту *******

let text1 = "Lorem, ipsum dolor.";
let text2 = "";
let text3 = "  ";

console.log("%cСпосіб 1 - за допомогою оператора '===':", "color: green; font-weight: bold;");
if (text1 === "") {
  console.log("Змінна 'text1' не містить текст");
} else {
  console.log("Змінна 'text1' містить текст:", text1);
}

console.log("%cСпосіб 2 - застосування властивості 'length':", "color: green; font-weight: bold;");
if (text2.length) {
  console.log("Змінна 'text2' містить текст:", text2);
} else {
  console.log("Змінна 'text2' не містить текст");
}

console.log("%cСпосіб 3 - використання методу 'trim()':", "color: green; font-weight: bold;");
if (text3.trim()) {
  console.log("Змінна 'text3' містить текст:", text3);
} else {
  console.log("Змінна 'text3' не містить текст");
}