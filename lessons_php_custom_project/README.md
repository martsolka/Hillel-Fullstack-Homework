# 📋 Система опитувань

Проста система опитувань з використанням PHP та MySQL, яка дозволяє користувачам створювати та керувати опитуваннями.

## 🗄️ Структура бази даних 

Система опитувань містить наступні таблиці:

- 📝 **poll_types** - зберігає основну інформацію про опитування, таку як назва, необов'язковий опис, статус і мітки часу. 

- ❔ **poll_type_questions** - зберігає питання для кожного типу опитування, які можуть бути одиничного вибору (радіокнопки), множинного вибору (чекбокси), випадаючого списку, рейтингом або відкритою відповіддю.

- 🔘 **poll_type_question_options** - зберігає варіанти відповідей для запитань, які мають заздалегідь визначені варіанти(радіокнопки, чекбокси, випадаючі списки).

- 📊 **polls** - зберігає інформацію про конкретне опитування, коли і хто на нього відповідав.

- 🗨️ **poll_answers** - зберігає відповіді, надіслані користувачами на кожне питання опитування.

---

SQL script to create the necessary tables:

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
  `question` varchar(255) DEFAULT NULL,
  `poll_type_id` int UNSIGNED NOT NULL,
  FOREIGN KEY (`poll_type_id`) REFERENCES `poll_types` (`id`)
);

CREATE TABLE `polls` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `owner` varchar(255) DEFAULT NULL,
  `poll_type_id` int UNSIGNED NOT NULL,
  `answered_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`poll_type_id`) REFERENCES `poll_types` (`id`)
);

CREATE TABLE `poll_answers` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `answer` text,
  `poll_id` int UNSIGNED NOT NULL,
  `poll_type_question_id` int UNSIGNED NOT NULL,
  FOREIGN KEY (`poll_id`) REFERENCES `polls` (`id`),
  FOREIGN KEY (`poll_type_question_id`) REFERENCES `poll_type_questions` (`id`)
);

CREATE TABLE `poll_type_question_options` (
  `id` int UNSIGNED NOT NULL,
  `question_id` int UNSIGNED NOT NULL,
  `option_text` varchar(255) NOT NULL UNIQUE,
  FOREIGN KEY (`question_id`) REFERENCES `poll_type_questions` (`id`)
);