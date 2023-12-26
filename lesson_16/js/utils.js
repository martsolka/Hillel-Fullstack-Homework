/**
 * Функція для створення локального сховища для збереження даних за ключем.
 * (спойлер: локально зберігатимуться обрані гіфки а точніше, масив їх ідентифікаторів).
 * @param {string} key - Ключ для доступу до локального сховища.
 * @returns {Object} - Об'єкт з методами для отримання та збереження даних в локальному сховищі.
 */
function setupLocalStorage(key) {
  return {
    /**
     * @returns {Array} - Дані, зчитані з локального сховища.
     */
    get: () => JSON.parse(localStorage.getItem(key)) || [],
    /**
     * @param {Array} data - Дані для збереження у локальному сховищі.
     */
    save: (data) => localStorage.setItem(key, JSON.stringify(data)),
  };
}

/**
 * Функція для створення статусного блоку і відображення його.
 * @param {HTMLElement} container - Контейнер, до якого додається блок із статусом та текстом.
 * @param {string} status - Статус, що визначає вигляд та значок статусного блоку.
 * @param {string} text - Текст, який відображається поруч із значком статусу.
 */
function createStatusPlaceholder(container, status, text) {
  // Об'єкт із значками для різних статусів.
  const statusIcons = {
    fetching: '⏳', found: '✅', notFound: '🙁', empty: '👁‍🗨'
  };

  // Перевірка наявності контейнера, статусу та наявності відповідного значка.
  if (!container || !status || !statusIcons[status]) {
    return;
  }

  // Формування HTML-коду для статусного блоку.
  const html = `
  <div class="gap-2 text-start ${(status !== 'found') ? 'vstack align-items-center justify-content-center h-100 w-50 m-auto text-center' : ''}" data-placeholder="${status}" role="status">
    <span class="d-inline-block ${(status !== 'found') ? 'fs-1' : ''}">${statusIcons[status]}</span>
    <p class="d-inline-block mb-0 opacity-75">${text}</p>
  </div > `;

  // Пошук та видалення існуючого статусного блоку у контейнері.
  const placeholder = container.querySelector('[data-placeholder]');
  if (placeholder) {
    placeholder.remove();
  }

  // Додавання нового статусного блоку до початку контейнера.
  container.insertAdjacentHTML('afterbegin', html);
}


/**
 * Функція для створення посилання і поширення гіфки в соціальній мережі.
 * @param {HTMLElement} socialBtn - Кнопка, яка викликає подію поширення.
 * @param {Object} gifData - Об'єкт гіфки з деструкторизованими властивостями(title, url).
 */
function shareGifOnSocial(socialBtn, { url, title }) {
  // Отримання ідентифікатора соціальної мережі з атрибута dataset.
  const social = socialBtn.dataset.share;

  // Кодування URL та заголовка гіфки.
  const encodedUrl = encodeURIComponent(url);
  const encodedTitle = encodeURIComponent(`Перегляньте цей GIF: ${title}`);

  // Створення посилання для кожної соціальної мережі.
  const shareURL = {
    facebook: `https://www.facebook.com/sharer/sharer.php?u=${encodedUrl}`,
    twitter: `https://twitter.com/intent/tweet?text=${encodedTitle}&url=${encodedUrl}&hashtags=gif,giphy`,
    telegram: `https://telegram.me/share/url?text=${encodedTitle}&url=${encodedUrl}`,
    whatsapp: `https://api.whatsapp.com/send?text=${encodedTitle} ${encodedUrl}`,
  }[social];

  // Відкриття нового вікна браузера з посиланням на поширенну гіфку.
  if (shareURL) {
    window.open(shareURL, '_blank');
  }
}


/**
 * Функція для копіювання URL гіфки або вбудованого посилання в буфер обміну.
 * @param {HTMLElement} copyBtn - Кнопка, яка викликає подію копіювання.
 * @param {Object} gifData - Об'єкт з деструкторизованими властивостями гіфки (url та embed_url).
 * @param {HTMLElement} shareModal - Модальне вікно, з якого викликається копіювання.
 */
function copyGifToClipboard(copyBtn, { url, embed_url }, shareModal) {
  // Повідомлення для виведення у спливаючому вікні (toast).
  const toastMessage = `Скопійовано ${copyBtn.dataset.copy === 'embed' ? 'вбудоване посилання' : 'URL гіфки'}: <strong>${url}</strong>`;

  // Текст для копіювання в буфер обміну.
  const copyText = copyBtn.dataset.copy === 'embed'
    ? `<iframe src="${embed_url}" width="480" height="480" frameBorder="0" allowFullScreen></iframe><p><a href="${url}">via GIPHY</a></p>`
    : url;

  // Закриття кнопки модального вікна.
  const btnClose = shareModal.querySelector('.btn-close');

  // Перевірка, чи підтримується API Clipboard у браузері.
  if (!navigator.clipboard) {
    // Використання додаткового елемента textarea для копіювання в буфер обміну для старіших браузерах.
    const textarea = document.createElement('textarea');
    textarea.value = copyText;
    document.body.appendChild(textarea);
    textarea.select();
    document.execCommand('copy');
    document.body.removeChild(textarea);

    // Закриття модального вікна та виведення повідомлення.
    btnClose.click();
    showToast(toastMessage);
    return;
  }

  // Використання API Clipboard для копіювання тексту в буфер обміну.
  navigator.clipboard.writeText(copyText)
    .then(() => btnClose.click(), showToast(toastMessage))
    .catch(err => console.error('Не вдалося скопіювати', err));
}


/**
 * Виводить спливаюче повідомлення (toast) з заданим текстом.
 * @param {string} message - Текст повідомлення для відображення у спливаючому вікні.
 */
function showToast(message) {
  // Створення елементу toast з використанням HTML-рядка.
  const toast = htmlToElement(
    `<div class="toast position-fixed top-0 end-0 mt-5 me-3 bg-glass border-0 shadow z-3" role="alert" aria-live="assertive" aria-atomic="true">
      <div class="d-flex">
        <div class="toast-body text-start">${message}</div>
        <button type="button" class="btn-close btn-close-white m-2" data-bs-dismiss="toast" aria-label="Закрити"></button>
      </div>
    </div>`
  );

  // Видалення існуючих елементів toast перед додаванням нового.
  document.querySelectorAll('.toast').forEach(existingToast => existingToast.remove());

  // Додавання елементу toast до тіла документа та відображення його за допомогою Bootstrap Toast.
  document.body.appendChild(toast);
  bootstrap.Toast.getOrCreateInstance(toast).show();
}

/**
 *  Функція для конвертації HTML-рядка в DOM-елемент.
 * @param {string} html - HTML-рядок для конвертаціїю
 * @returns {HTMLElement} - Конвертований DOM-елемент
 */
function htmlToElement(html) {
  // Створення тимчасового div-елемента для конвертації HTML.
  const template = document.createElement('div');
  template.innerHTML = html;

  // Повернення першого(єдиного) дочірнього елемента з отриманого DOM-елемента.
  return template.firstElementChild;
}
