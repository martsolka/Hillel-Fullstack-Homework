function printResult(taskName, result, color = "blue") {
  console.group(`%c${taskName}`, `font-weight: bold; color: ${color};`);
  console.log(result);
  console.groupEnd();
}

//#region ******* ЗАВДАННЯ 1 *******
/**
 * Напишіть функцію, яка приймає масив чисел та повертає суму всіх елементів.
 */

// - спосіб 1 (за допомогою циклу):
function sumArrayLoop(arr) {
  let sum = 0;
  for (let i = 0; i < arr.length; i++) {
    sum += arr[i];
  }
  return sum;
}
// - спосіб 2 (за допомогою методу forEach()):
function sumArrayForeach(arr) {
  let sum = 0;
  arr.forEach(num => sum += num);
  return sum;
}
// - спосіб 3 (за допомогою рекурсії):
function sumArrayRecurse(arr) {
  if (arr.length === 0) {
    return 0;
  } else {
    return arr[0] + sumArrayRecurse(arr.slice(1));
  }
}

printResult("ЗАВДАННЯ 1 (за допомогою циклу for):", sumArrayLoop([1, 2, 3, 4, 5]));
printResult("ЗАВДАННЯ 1 (за допомогою методу foreach()):", sumArrayForeach([10, 20, -10, 30]));
printResult("ЗАВДАННЯ 1 (за допомогою рекурсії):", sumArrayRecurse([-5.5, 10.25, -9, 12]));
//#endregion

//#region ******* ЗАВДАННЯ 2 *******
/**
 * Створіть об"єкт "користувач" з полями "ім"я", "вік" та "статус". 
 * Напишіть функцію, яка приймає цей об"єкт і повертає рядок у форматі "Ім"я: [ім"я], Вік: [вік], Статус: [статус]"
 */

const user = {
  name: "Соломія",
  age: 21,
  status: "онлайн",
};

function getUserInfo(user) {
  const { name, age, status } = user;
  return `Ім"я: ${name}, Вік: ${age}, Статус: ${status}`;
}

printResult("ЗАВДАННЯ 2:", getUserInfo(user), "green");
//#endregion

//#region ******* ЗАВДАННЯ 3 *******
/**
 * Напишіть функцію, яка приймає рядок і повертає новий рядок із перевернутим порядком символів.
 */

// - спосіб 1 (за допомогою циклу):
function reverseStringLoop(str) {
  const reversed = [];
  for (let i = str.length - 1; i >= 0; i--) {
    reversed.push(str[i]);
  }
  return reversed.join("");
}

// - спосіб 2 (за допомогою методу split()):
function reverseString(str) {
  return str.split("").reverse().join("");
}



printResult("ЗАВДАННЯ 3 (за допомогою циклу):", reverseStringLoop("Hello, world!"), "orange");
printResult("ЗАВДАННЯ 3 (за допомогою методу split()):", reverseString("Lorem ipsum dolor sit."), "orange");
//#endregion

//#region ******* ЗАВДАННЯ 4 *******
/**
 * Створіть об"єкт "автомобіль" з полями "марка", "модель" та "рік випуску". 
 * Напишіть функцію, яка приймає цей об"єкт і виводить інформацію про автомобіль у консоль.
 */

const car = {
  brand: "Hyundai",
  model: "Elantra",
  year: 2023,
};

function logCarInfo({ brand, model, year }) {
  const str = `Марка: ${brand}\nМодель: ${model}\nРік випуску: ${year}`;
  printResult("ЗАВДАННЯ 4:", str, "red");
}

logCarInfo(car);
//#endregion

//#region ******* ЗАВДАННЯ 5 *******
/**
 * Створіть просту гру "Вгадай число". 
 * Генеруйте випадкове число від 1 до 100, а потім пропонуйте користувачеві вгадати це число, 
 * підказуючи "більше" або "менше" до тих пір, поки користувач не вгадає число. 
 * Використовуйте  prompt для того, щоб запитати у коритсувача його варіант, та alert для виведення підказок (більше, менше).
 */

const randNumber = (limit) => Math.floor(Math.random() * limit) + 1;

function guessNumber(num, i) {
  const userNum = +(prompt(`ЗАВДАННЯ 5 (спроба ${i})\nВгадайте число від 1 до ${limit}:`));

  if (userNum === 0) { return };

  if (userNum === num) {
    alert(`Так! Ви вгадали число із ${i} спроби!`);

    const continueGame = confirm("Хочете зіграти ще раз?");
    if (continueGame) {
      guessNumber(randNumber(limit), 1);
    }
  } else if (userNum < num) {
    alert("Число більше!");
    guessNumber(num, ++i);
  } else {
    alert("Число менше!");
    guessNumber(num, ++i);
  }
}

const limit = 100;
guessNumber(randNumber(limit), 1);
//#endregion

//#region ******* ЗАВДАННЯ 6 *******
/**
 * Створіть функцію-генератор випадкових паролів заданої довжини. 
 * Пароль має містити як літери, і цифри. Довжина пароля повинна передаватись у вигляді аргумента.
 */

function generatePassword(length) {
  const chars = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j",
    "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w",
    "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", "J",
    "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W",
    "X", "Y", "Z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"
  ];

  let password = "";
  for (let i = 0; i < length; i++) {
    password += chars[randNumber(chars.length)];
  }
  return password;
}

printResult("ЗАВДАННЯ 6 (пароль 1):", generatePassword(7), "purple");
printResult("ЗАВДАННЯ 6 (пароль 2):", generatePassword(14), "purple");
//#endregion

//#region ******* ЗАВДАННЯ 7 *******
/**
 * Напишіть функцію, яка приймає масив чисел і повертає новий масив,
 * який містить лише унікальні значення (без повторень).
 */

// - спосіб 1 (за допомогою методу forEach()):
function uniqueNumbersForeach(numbers) {
  const uniqueNumbersArray = [];

  numbers.forEach(number => {
    if (!uniqueNumbersArray.includes(number)) {
      uniqueNumbersArray.push(number);
    }
  });

  return uniqueNumbersArray;
}

// - спосіб 2 (за допомогою методу Set() і Spread оператора):
function uniqueNumbersSet(numbers) {
  const numbersSet = new Set(numbers);
  return [...numbersSet];
}

const nums1 = [1, 2, 1, 2, 3, -1, 1];
const nums2 = [100, 6, -100, 3, 2, 6, -100, 2];

printResult(`ЗАВДАННЯ 7 (за допомогою методу foreach()):\n вхідний масив: ${nums1}`, uniqueNumbersForeach(nums1));
printResult(`ЗАВДАННЯ 7 (за допомогою методу Set() і Spread оператора:\n вхідний масив: ${nums2}`, uniqueNumbersSet(nums2));
//#endregion

//#region ******* ЗАВДАННЯ 8 *******
/**
 * Напишіть функцію, яка приймає рядок і визначає, чи вона є паліндромом (читається однаково в обох напрямках), 
 * ігноруючи пробіли, розділові знаки та регістр.
 */

const normalizeString = (str) => str.replace(/[ ,.;:!?]/g, "").toLowerCase();

function isPalindrome(str) {
  str = normalizeString(str);
  return str === str.split("").reverse().join("");
}

const strP = "Eve, mad Adam, Eve!";
printResult(`ЗАВДАННЯ 8 ('${strP}' є паліндромом?):`, isPalindrome(strP), "green");
//#endregion

//#region ******* ЗАВДАННЯ 9 *******
/**
 * Напишіть функцію для перевірки, чи є рядок анаграмою іншого рядка (складається з тих самих символів в іншому порядку).
 */

function isAnagram(str1, str2) {
  str1 = normalizeString(str1);
  str2 = normalizeString(str2);

  if (str1.length !== str2.length) { return false; }

  const str1Obj = {};
  const str2Obj = {};

  str1.split("").forEach(char => str1Obj[char] = str1Obj[char] ? str1Obj[char] + 1 : 1);
  str2.split("").forEach(char => str2Obj[char] = str2Obj[char] ? str2Obj[char] + 1 : 1);

  for (const key in str1Obj) {
    if (str1Obj[key] !== str2Obj[key]) {
      return false;
    }
  }

  return true;
}

const text1 = "hello, world";
const text2 = "holler wold";
const text3 = "programm";
const text4 = "gram prom";
const text5 = "gram";
const text6 = "army";

printResult(`ЗАВДАННЯ 9 ('${text1}' є анаграмою '${text2}'?):`, isAnagram(text1, text2), "orange");
printResult(`ЗАВДАННЯ 9 ('${text3}' є анаграмою '${text4}'?):`, isAnagram(text3, text4), "orange");
printResult(`ЗАВДАННЯ 9 ('${text5}' є анаграмою '${text6}'?):`, isAnagram(text5, text6), "orange");
//#endregion
