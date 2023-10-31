// ******* Завдання 3. Кратність і парність *******

let numbers1 = [10, 15, 99];
let numbers2 = [2, 5, 8];

if (numbers1.length === numbers2.length) {
  for (let i = 0; i < numbers1.length; i++) {
    // Перевіряємо, чи перше число є кратним другому
    if (numbers1[i] % numbers2[i] === 0) {
      // Перевіряємо, чи перше число є парним
      if (numbers1[i] % 2 === 0) {
        console.log(
          `Перше число(${numbers1[i]}) є кратним другому(${numbers2[i]}) і парним одночасно`
        );
      } else {
        console.log(
          `Перше число(${numbers1[i]}) є кратним другому(${numbers2[i]}), але непарне`
        );
      }
    } else {
      console.log(
        `Перше число(${numbers1[i]}) не є кратним другому(${numbers2[i]})`
      );
    }
  }
}