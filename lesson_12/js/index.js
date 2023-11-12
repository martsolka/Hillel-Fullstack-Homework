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
// - спосіб 2 (за допомогою методу foreach()):
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
 * Створіть об'єкт "користувач" з полями "ім'я", "вік" та "статус". 
 * Напишіть функцію, яка приймає цей об'єкт і повертає рядок у форматі "Ім'я: [ім'я], Вік: [вік], Статус: [статус]"
 */

const user = {
  name: "Соломія",
  age: 21,
  status: "онлайн",
};

function getUserInfo(user) {
  const { name, age, status } = user;
  return `Ім'я: ${name}, Вік: ${age}, Статус: ${status}`;
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
 * Створіть об'єкт "автомобіль" з полями "марка", "модель" та "рік випуску". 
 * Напишіть функцію, яка приймає цей об'єкт і виводить інформацію про автомобіль у консоль.
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
