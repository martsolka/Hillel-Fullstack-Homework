/**
 * Функція для читання даних про таби і панелі гіфок з JSON-файлу.
 * @param {string} filename - Ім'я файлу, з якого потрібно прочитати.
 * @return {Promise} - Promise, який повертає об'єкт з даними, зчитаними з файлу або помилку.
 */
function readTabsAndPanelsFromFile(filename) {
  return new Promise((resolve, reject) => {
    fetch(filename)
      .then(response => response.json())
      .then(data => resolve(data))
      .catch(error => reject(error));
  });
};

/**
 * Функція для налаштування вкладок та панелі гіфок.
 * @param {Array} jsonData - Масив об'єктів із даними для кожної вкладки.
 * @param {HTMLElement} tabsContainer - Контейнер для вкладок.
 * @param {HTMLElement} panelsContainer - Контейнер для вмісту з гіфками.
 * @param {number} limit - Ліміт кількості гіфок на сторінці для відображення за раз.
 * @param {Object} giphy - Об'єкт, який містить методи для отримання гіфок по api конкретного ендпоінту.
 * @param {Object} favoriteGifs - Масив, який містить ID гіфок, які зберігаються у лок. схов. користувача.
 * @returns {Object} - Об'єкт, який містить створені вкладки та панелі.
 */
function setupTabsAndPanels(jsonData, tabsContainer, panelsContainer, limit, giphy, favoriteGifs) {
  const elements = {};

  jsonData.forEach(tabData => {
    const { tabId, isActive, tabIcon, tabTitle, panelId, panelTitle, panelDescription, fetchFunction } = tabData;
    const tabHTML = `
        <button class="nav-link ${isActive ? 'active' : ''} rounded-4 bg-gradient text-white-50 text-nowrap" id="${tabId}"
          data-bs-toggle="pill" data-bs-target="#${panelId}" type="button" role="tab" aria-controls="${panelId}" aria-selected="${isActive}">
          <i class="${tabIcon} me-2"></i>${tabTitle}
        </button>`;

    const panelHTML = `
      <div class="tab-pane fade ${isActive ? 'show active' : ''}" id="${panelId}" role="tabpanel" aria-labelledby="${tabId}" tabindex="0">
        <div class="card text-bg-dark bg-transparent h-100 border-0">
          <div class="card-header py-2 border-bottom">
            <h3 class="card-title">${panelTitle}</h3>
            <p class="card-subtitle opacity-75">${panelDescription}</p>
          </div>
          <div class="card-body border-0"></div>
        </div>
      </div>`;

    // Створення елементів вкладки та панелі з HTML-рядка.
    const tabEl = htmlToElement(tabHTML);
    const panelEl = htmlToElement(panelHTML);
    const panelBodyEl = panelEl.querySelector('.card-body');

    // Додавання створених елементів до відповідних контейнерів.
    tabsContainer.appendChild(tabEl);
    panelsContainer.appendChild(panelEl);

    // Створення об'єкта для кожної вкладки з необхідними властивостями.
    elements[tabId] = {
      isActive,
      tabEl,
      panelEl,
      panelBodyEl,
      gifs: [],
      favoriteGifs,
      pagination: { limit, offset: 0 },
      fetchGifs: () => giphy[fetchFunction](elements[tabId]), // Функція для отримання гіфок за властивістю fetchFunction кожної вкладки.
    };

    // Додавання додаткового поля для збереження пошукового запиту, якщо використовується функція пошуку гіфок
    if (fetchFunction === 'fetchSearchGifs') {
      elements[tabId].searchQuery = '';
    }
  });

  return elements;
}