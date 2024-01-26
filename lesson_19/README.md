# СТАРТ VUE 🚀

**НАВІГАЦІЯ:**

👉 [ДЗ 19. Вступ до Vue. Інніціалізація \ перший компонент.](#hw-19)

👉 [ДЗ 20. Майданчик для вивчення Flexbox.](#hw-20)

👉 [ДЗ 21. Трекер оцінок студентів.](#hw-21)

👉 [ДЗ 22. ToDO ліст на Vue.](#hw-22)

👉 [ДЗ 23. Розподільник очок.](#hw-23)

👉 [ДЗ 24. Підсумок базових концепцій VUE. Axios та підключення бібліотек.](#hw-24)

👉 [ДЗ 32. MySQL: SELECT.](#hw-32)

👉 [ДЗ 33. MySQL: INSERT \ UPDATE \ DELETE.](#hw-33)

---

## <a id="hw-19">ДЗ 19.</a> 👩‍💻 Вступ до Vue. Інніціалізація \ перший компонент.

### 📝 Завдання

**1.✅ Встановити Node.js 📥**

- Завантажила та встановила останню LTS-версію з сайту [Node.js](https://nodejs.org/uk/).
- Перевірила версію в терміналі:
  ```bash
  node -v
  20.10.0
  ```
  ```bash
  npm -v
  10.2.3
  ```

**2.✅ Створити перший проект Vue 📂**

- Запустила команду в терміналі для створення проекту:
  ```bash
  npm create vue@latest
  ```
- Задала ім'я проекту `lesson_19`.
- Для ряду підказок, які містять додаткові функції, вказала `No`.
- Перейшла в новостворений каталог:
  ```bash
  cd lesson_19
  ```
- Виконала команду для встановлення залежностей:
  ```bash
  npm install
  ```
- Запустила локальний сервер в режимі розробки:
  ```bash
  npm run dev
  ```
- Відкрила стартову сторінку за посиланням `http://localhost:5173`:

  <img src="./public/vue_start_page.png" alt="Vue start page" width="60%">

**3.✅ Прочитати вступ з документації 📖**

- Переглянула основні концепції Vue.js в [документації](https://ua.vuejs.org/guide/introduction.html).

**4.✅ Встановити плагін Vue 🔧**

- Додала браузерне розширення [Vue.js devtools](https://chromewebstore.google.com/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd?hl=en-US&utm_source=ext_sidebar) для debug-у Vue проектів:

<img src="./public/vue_devtools.png" alt="Vue devtools" width="60%">

---

## <a id="hw-20">ДЗ 20.</a> 🎲🎪 Майданчик для вивчення Flexbox

Невеличкий інтерактивний додаток на Vue для демонстрації властивостей CSS Flexbox.

### ✨Можливості ✨

- Вибір різних властивостей для контейнера із панелі керування **'Flex Properties'** ⚙: `flex-direction`, `flex-wrap`, `justify-content`, `align-items`, `align-content`.

- **Візуалізація** зміни стилів флекс контейнера і флекс елементів **в режимі реального часу** 🕒.

- Розкриття/закриття панелі **'CSS сode'** із згенерованими стилями 🎨.

- **Копіювання** CSS правил у буфер обміну **одним кліком** 📋.

### 💻 Демонстрація 💻

<img src="./public/flexbox-playground-demo.gif" alt="Flexbox playground demo">

---

## <a id="hw-21">ДЗ 21.</a> 👀📃 Трекер оцінок студентів

### ✨Можливості ✨

- Перегляд списку всіх студентів з їхніми оцінками 👩‍🎓👨‍🎓

- Генерація випадкових студентів та оцінок кожні 5 секунд ⏲️

- Перегляд середнього бала по всіх студентах 📊

- Візуалізація зростання/падіння середнього балу ⬆️⬇️

### 💻 Демонстрація 💻

## <img src="./public/students-scores.gif" alt="Students scores" width="60%">

## <a id="hw-22">ДЗ 22.</a> 📝 ToDO ліст на Vue.

Простий додаток для відстеження задач на день, написаний на Vue 3 та стилізований з використанням Bootstrap 5 і власних стилів.

### ✨Можливості ✨

- 🗒️ **CRUD операції** - Повна підтримка створення, читання, оновлення та видалення елементів списку завдань.

- ✅ **Відмітка завершеності** - Візуалізація зміни статусу завдань по кліці на назву або через форму редагування.

- 💾 **Локальне сховище** - Дані автоматично зберігаються локально в сховищі браузера після додавання/редагування/видалення, тож ви можете завжди переглянути їх і після перезагрузки сторінки.

- 👀 **Фільтри** - Перегляд завдань на сьогодні (всі, в процесі, виконані) або минулі (згруповані по даті створення без можливості редагування).

- 📅 **Динамічна дата/час** - Відображення поточної дати та часу зверху.

- 🎨 **Підтримка тем** - Перемикання між світлою та темною темами.

- 🔮 **Анімація** - базові переходи та анімації під час додавання/видалення TODO і завантаження сторінки, за допомогою компонентів Vue `<Transition>` і `<TransitionGroup>`.

- 📱 **Адаптив** - Виглядає чудово на всіх розмірах екрану та пристроях.

### 💻 Демонстрація 💻

<img src="./public/todo-vue.gif" alt="ToDO list">

---

## <a id="hw-23">ДЗ 23.</a> 🎯 Розподільник очок

Невеличкий додаток на Vue, який дай можливість налаштовувати очки між різними числовими характеристиками (здоров'я, сила, швидкість тощо) уявного персонажа.

### ✨Можливості ✨

- Повторно-використовуваний компонент лічильника для налаштування очок від 1 до 10 🧮

- Двобічне зв'язування даних із дочірнім компонентом `CharacterCounter` та батьківським 🔗

- Відстеження використаних очок у батьківському компоненті 👀

- Блокування кнопок `+` та `-` в залежності від використаних очок 🔒

### 💻 Демонстрація 💻

<img src="./public/character-counter.gif" alt="Character counter" width="60%">

---

## <a id="hw-24">ДЗ 24.</a> 👨‍💻 Підсумок базових концепцій VUE. Axios та підключення бібліотек.

### 📝 Завдання 1. Формування повного імені.

Кастомнi компоненти `FullName`(батьківський) та `FullNameInput`(дочірній) для введення імені та прізвища, які використовуються для генерації повного імені.

Прив'язування елементів форми відбувається через `v-model`.

Реактивне відображення повного імені виконується одним з варіантів обміну даних між компонентами:

```html
<select class="form-select" id="method" v-model.number="method">
  <option value="1">custom prop + custom event</option>
  <option value="2">modelValue prop with data</option>
  <option value="3">modelValue prop with computed</option>
</select>
<label for="method">Method</label>
```

- **custom prop + custom event**

  - 📥 Батько передає властивість `fullName` (повне ім'я) через проп `:full-name`:

    ```js
    data() {
      return {
        fullName: 'John Doe',
        method: 1
      }
    }
    ```

    ```html
    <full-name-input :full-name="fullName" @updateFullName="onUpdateFullName" />
    ```

  - 💾 Дитина отримує нове значення властивості `fullName`:

    ```js
      props: {
        fullName: {
          required: true,
          type: String
        },
      },
    ```

  - ✂️ Дитина розділяє значення на окремі локакальні змінні `name` (ім'я) та `surname` (прізвище).

  - 🔗 Дитина прив'язує поля вводу та змінні `name`, `surname` за допомогою `v-model`.

    ```html
    <input class="form-control" type="text" v-model="name" />
    <input class="form-control" type="text" v-model="surname" />
    ```

  - 📤 Дитина викликає подію `updateFullName` при зміні будь-якого поля, передаючи нове значення:

    ```js
    methods: {
      fire(value = null) {
        const updatedFullName = `${this.name} ${this.surname}`;
        if (this.method === 1) {
          this.$emit('updateFullName', updatedFullName);
        } else {
          // ...
        }
      }
    ```

  - 🔀 Батько отримує і оновлює своє значення `fullName` через обробник події `@updateFullName="onUpdateFullName"`:

    ```js
    methods: {
      onUpdateFullName(updatedFullName) {
        this.fullName = updatedFullName;
      }
    }
    ```

- **modelValue prop with data**

  - Аналогічно до методу 1, але з використанням `v-model` для передачі даних у дочірній компонент та `modelValue`, `update:modelValue` для отримання, відправлення нового значення в батьківський:

  ```html
  <full-name-input v-model="fullName" />
  ```

  ```js
    props: {
      modelValue: {
        required: true,
        type: String
      },
    },
    methods: {
      fire(value = null) {
        const updatedFullName = `${this.name} ${this.surname}`;
        if (this.method === 1) {
          // ...
        } else {
          this.$emit('update:modelValue', value || updatedFullName);
        }
      }
    }
  ```

- **modelValue prop with computed**

  - Гетери у дочірньому компоненті отримують ім'я/прізвище з повного імені, а сетери складають та відправляють оновлене повне ім'я:

    ```js
    computed: {
      nameComputed: {
        get() {
          if (this.method !== 3) {
            return '';
          }
          return this.modelValue.split(' ')[0] || '';
        },
        set(value) {
          this.fire(`${value} ${this.surnameComputed}`);
        }
    },
      surnameComputed: {
        get() {
          if (this.method !== 3) {
            return '';
          }
          return this.modelValue.split(' ')[1] || '';
        },
        set(value) {
          this.fire(`${this.nameComputed} ${value}`);
        }
      }
    }
    ```

### 💻 Демонстрація 💻

<img src="./public/full-name-builder.gif" alt="Full name builder" width="80%">

### 📝 Завдання 2. Запит до сервісу [GIPHY](https://giphy.com/)

Реалізовано компонент `RandomGif` для відображення випадкових GIF з використанням [API Giphy](https://developers.giphy.com/docs/api/endpoint/#random) та [Axios](https://axios-http.com/).

### ✨Можливості ✨

- 🎲 Відображення випадкового GIF (зображення з підписом та посиланням).

  > У випадку, якщо значення для підпису приходить порожнє/містить лище пробіли - встановлюється значення за замовч **No title**.

- 🔄 Оновлення GIF по кнопці **Get Another GIF**.

- ⏳ Індикатор завантаження.

- 🔗 Перехід на сторінку GIPHY по кліці на **View on GIPHY** або зображенню.

### 💻 Демонстрація 💻

<img src="./public/random-gif.gif" alt="Random Gif" width="80%">

---

## <a id="hw-32">ДЗ 32. <img alt="Alt text" src="https://img.shields.io/badge/MySQL-4479A1.svg?logo=MySQL&logoColor=white&style=flat" /> SELECT 🕵️‍♂️ </a>

### 📝 Сформувати SQL запити на основі таблиці `users` 👥:

```sql
CREATE TABLE `home`.`users`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `status` ENUM('active', 'inactive', 'blocked') NOT NULL DEFAULT 'active',
    `role` ENUM('admin', 'manager', 'player') NOT NULL DEFAULT 'user',
    `rating` TINYINT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;
```

- Оберіть всіх адмінів (юзери, які мають роль admin).
  
  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `role` = 'admin';
  ```

- Оберіть всіх юзерів, які мають емейл у домені "@gmail.com".

  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `email` LIKE '%@gmail.com';
  ```

- Оберіть id та name юзерів, котрі мають не активний статус (blocked або inactive) та роль user.

  **Відповідь:**

  ```sql
  SELECT `id`, `name` FROM `home`.`users` WHERE (`status` = 'blocked' OR `status` = 'inactive') AND `role` = 'user';
  ```
  ```sql
  SELECT `id`, `name` FROM `home`.`users` WHERE `status` IN ('blocked', 'inactive') AND `role` = 'user';
  ```

- Оберіть юзерів з id 4, 34, 3426, 63479.

  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `id` IN (4, 34, 3426, 63479);
  ```

- Оберіть юзерів, які створені пізніше "2024-01-01 00:00:00" (дату можна вказувати так само, як це прописано у завданні).

  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `created_at` > '2024-01-01 00:00:00';
  ```

- Оберіть всіх юзерів, котрі зареєстровані у 2023-му році.

  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `created_at` LIKE '2023%';
  ```

- Підрахуйте середній рейтинг гравців (rating поле визначе рейтинг користувача, а гравцями є всі, хто має роль player).

  **Відповідь:**

  ```sql
  SELECT AVG(`rating`) FROM `home`.`users` WHERE `role` = 'player';
  ```

- Оберіть топ 10 кращих за рейтингом гравців (гравцями є всі, хто має роль player).

  **Відповідь:**

  ```sql
  SELECT * FROM `home`.`users` WHERE `role` = 'player' ORDER BY `rating` DESC LIMIT 10;
  ```

- Знайдіть найбільний рейтинг серез всіх гравців (гравцями є всі, хто має роль player).

  **Відповідь:**

  ```sql
  SELECT MAX(`rating`) FROM `home`.`users` WHERE `role` = 'player';
  ```

---

## <a id="hw-33">ДЗ 33. <img alt="MySQL" src="https://img.shields.io/badge/MySQL-4479A1.svg?logo=MySQL&logoColor=white&style=flat" /> INSERT \ UPDATE \ DELETE</a>

### 📝 Сформувати SQL запити на основі таблиці `users` 👥:

```sql
CREATE TABLE `home`.`users`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `status` ENUM('active', 'inactive', 'blocked') NOT NULL DEFAULT 'active',
    `role` ENUM('admin', 'manager', 'player') NOT NULL DEFAULT 'player',
    `rating` TINYINT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(`id`)
) ENGINE = InnoDB;
```


- Напишіть запит на додавання 1 рядка у таблицю. Значення оберіть на свій розсуд.

  **Відповідь:**

  ```sql
  INSERT INTO `home`.`users` (`name`, `email`, `status`, `role`, `rating`) VALUES ('Solomia', 'martsolka@gmail.com', 'active', 'player', 5);
  ```

- Напишіть запит на додавання одразу 5 рядків у таблицю. Значення оберіть на свій розсуд.

  **Відповідь:**

  ```sql
  INSERT INTO `home`.`users` (`name`, `email`, `status`, `role`, `rating`) 
  VALUES ('Sophia', 'sophia@gmail.com', 'inactive', 'manager'),
    ('Vlad', 'vlad@mail.ru', 'inactive'),
    ('Vitalii', 'vitalii@gmail.com', 'blocked',  NULL, 4),
    ('Svitlana', 'svitlana@gmail.com', 'active', 'admin'),
    ('Sergei', 'sergei@gmail.com', 'active', NULL, 5);
  ```

- Напишіть запит, який буде оновлювати значення статусу у користувача з id = 1 на значення "blocked".

  **Відповідь:**

  ```sql
  UPDATE `home`.`users` SET `status` = 'blocked' WHERE `id` = 1;
  ```

- Напишіть запит, який буде оновлювати значення статусу у користувачів з емейлом домену @mail.ru на значення "blocked".

  **Відповідь:**

  ```sql
  UPDATE `home`.`users` SET `status` = 'blocked' WHERE `email` LIKE '%@mail.ru';
  ```

- Напишіть запит, який видалить запис  з id = 1.

  **Відповідь:**

  ```sql
  DELETE FROM `home`.`users` WHERE `id` = 1;
  ```

- Запит, який видалить всіх гравців (хто має роль player), котрі були зареєстровані (створені) раніше 2011 року.

  **Відповідь:**

  ```sql
  DELETE FROM `home`.`users` WHERE `role` = 'player' AND `created_at` < '2011-01-01 00:00:00';
  ```

 - > Додатково: Напишіть запит, який оновить всі рейтинги на значення у 2 рази менше, ніж було (округлення по правилам математики)
   >
   > **Відповідь:**
   >
   > ```sql
   > UPDATE `home`.`users` SET `rating` = ROUND(`rating` / 2, 0) WHERE `rating` IS NOT NULL;
   > ```
