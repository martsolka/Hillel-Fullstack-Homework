// ******* Завдання 2. Ім'я та прізвище *******

let firstName = "Соломія";
let lastName = "Мартинюк";
let fullName;

// Конкатенація за допомогою оператора "+":
fullName = firstName + " " + lastName;
console.log("Concat using +:", fullName);
// Конкатенація з використанням шаблонних літералів:
fullName = `${firstName} ${lastName}`;
console.log("Concat using `${}`:", fullName);
// Конкатенація за допомогою методу String.concat():
fullName = firstName.concat(" ", lastName);
console.log("Concat using String.concat():", fullName);