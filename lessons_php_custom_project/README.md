# 📋 Система опитувань

Проста система опитувань з використанням PHP та MySQL, яка дозволяє користувачам створювати та керувати опитуваннями.

## 🗄️ Структура бази даних 

Система опитувань містить наступні таблиці:

- 📝 **poll_types** - зберігає основну інформацію про опитування, таку як назва, необов'язковий опис, статус і мітки часу. 

- ❔ **poll_type_questions** - зберігає питання для кожного типу опитування, які можуть бути одиничного вибору (радіокнопки), множинного вибору (чекбокси), випадаючого списку, рейтингом або відкритою відповіддю.

- 🔘 **poll_type_question_options** - зберігає варіанти відповідей для запитань, які мають заздалегідь визначені варіанти(радіокнопки, чекбокси, випадаючі списки).

- 📊 **polls** - зберігає інформацію про конкретне опитування, коли і хто на нього відповідав.

- 🗨️ **poll_answers** - зберігає відповіді, надіслані користувачами на кожне питання опитування.

## 𝄜 Створення таблиць

```sql
CREATE TABLE `poll_types` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` varchar(20) NOT NULL DEFAULT 'draft',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE `poll_type_questions` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `type` varchar(20) DEFAULT NULL,
  `question` varchar(255) NOT NULL,
  `poll_type_id` int UNSIGNED NOT NULL,
  FOREIGN KEY (`poll_type_id`) REFERENCES `poll_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `polls` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `owner` varchar(255) DEFAULT NULL,
  `poll_type_id` int UNSIGNED NOT NULL,
  `answered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`poll_type_id`) REFERENCES `poll_types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `poll_answers` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `answer` text,
  `poll_id` int UNSIGNED NOT NULL,
  `poll_type_question_id` int UNSIGNED NOT NULL,
  FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`poll_type_question_id`) REFERENCES `poll_type_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE `poll_type_question_options` (
  `id` int UNSIGNED NOT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `option_text` varchar(255) NOT NULL UNIQUE,
  FOREIGN KEY (`question_id`) REFERENCES `poll_type_questions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
);
```

## ➕ Додавання тестових даних

```sql
INSERT INTO poll_types (name, status, description) VALUES
('Product Evaluation', 'active', 'Survey to gather feedback on a new product'),
('Customer Satisfaction', 'active', 'Poll to measure customer satisfaction'),
('Movie Rating', 'active', 'Survey to rate a movie by viewers'),
('Year in Review 2023', 'draft', 'Poll to summarize the past year'),
('Employee Engagement', 'archived', 'Poll to measure employee engagement and job satisfaction');

INSERT INTO poll_type_questions (type, question, poll_type_id) VALUES
('rating', 'How would you rate the overall quality of the product?', 1),
('multiple_choice', 'Which feature did you like the most?', 1),
('open_ended', 'What improvements would you suggest for the product?', 1),
('single_choice', 'What genre of movie did you choose?', 3),
('multiple_choice', 'What emotions did the movie evoke in you?', 3),
('rating', 'How would you rate the year 2023 overall?', 4);
```

## 💻 Демонстрація 💻

https://github.com/martsolka/Hillel-Fullstack-Homework/assets/75698258/d3274c73-19aa-4bda-b50f-278ab38776b3