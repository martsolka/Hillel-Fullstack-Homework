/**
 * Функція-налаштувач, яка створює і повертає об'єкт, що містить функції для взаємодії з API Giphy.
 *
 * @param {string} apiKey - Ключ API, який використовується для аутентифікації запитів до Giphy API.
 * @param {string} baseUrl - Базова URL-адреса API Giphy.
 * @return {object} Об'єкт з функціями для отримання трендових, випадкових, за пошуковим запитом або списку обраних гіфок.
 */
function setupGiphy(apiKey, baseUrl) {
  return {
    /**
    * Функція для отримання трендових гіфок, які є найпопулярнішими на сьогодні.
    * Giphy API endpoint: https://developers.giphy.com/docs/api/endpoint/#trending
    * @param {Object} tab - Об'єкт вкладки, для якої виконується запит.
    */
    fetchTrendingGifs: (tab) => {
      const url = `${baseUrl}/trending?api_key=${apiKey}`;
      createStatusPlaceholder(tab.panelBodyEl, 'fetching', 'Загрузка трендових гіфок...');
      fetch(url)
        .then(response => response.json())
        .then(result => {
          tab.gifs = result.data;
          setTimeout(() => {
            if (tab.gifs.length) {
              renderGifs(tab, 'трендових гіфок');
            } else {
              createStatusPlaceholder(tab.panelBodyEl, 'notFound', 'Трендових гіфок немає');
            }
          }, 500);
        })
        .catch(error => {
          createStatusPlaceholder(tab.panelBodyEl, 'empty', `Помилка: ${error}`);
        });
    },
    /**
     * Функція для отримання випадкових гіфок. 
     * Giphy API endpoint: https://developers.giphy.com/docs/api/endpoint/#random
     * Оскільки Giphy повертає лише одну гіфку, використовується цикл із значенням ліміту з елемента селекта
     * та отримуємо масив гіфок.
     * @param {Object} tab - Об'єкт вкладки, для якої виконується запит.
     */
    fetchRandomGifs: (tab) => {
      const url = `${baseUrl}/random?api_key=${apiKey}`;
      tab.gifs = [];
      tab.panelBodyEl.innerHTML = '';
      createStatusPlaceholder(tab.panelBodyEl, 'fetching', 'Загрузка випадкових гіфок...');
      for (let i = 0; i < tab.pagination.limit; i++) {
        fetch(url)
          .then(response => response.json())
          .then(result => {
            tab.gifs.push(result.data);
            if (i === tab.pagination.limit - 1) {
              if (tab.gifs.length) {
                renderGifs(tab, 'випадкових гіфок');
              } else {
                createStatusPlaceholder(tab.panelBodyEl, 'notFound', 'Випадкових гіфок немає');
              }
            }
          })
          .catch(error => {
            createStatusPlaceholder(tab.panelBodyEl, 'empty', `Помилка: ${error}`);
          });
      }
    },
    /**
    * Отримує GIF-файли на основі пошукового запиту.
    * Giphy API endpoint: https://developers.giphy.com/docs/api/endpoint/#search
    * @param {Object} tab - Об'єкт вкладки, для якої виконується запит.
    */
    fetchSearchGifs: (tab) => {
      if (!tab.searchQuery) {
        createStatusPlaceholder(tab.panelBodyEl, 'empty', 'Введіть запит в пошуковому полі та натисніть Enter або зніміть фокус із заповненого поля введення і пошук буде виконаний.');
        return;
      }

      const url = `${baseUrl}/search?api_key=${apiKey}&q=${tab.searchQuery}`;
      createStatusPlaceholder(tab.panelBodyEl, 'fetching', `Шукаємо гіфвки за запитом "<strong>${tab.searchQuery}</strong>"...`);
      fetch(url)
        .then(response => response.json())
        .then(result => {
          tab.gifs = result.data;
          setTimeout(() => {
            if (tab.gifs.length) {
              renderGifs(tab, `("<strong>${tab.searchQuery}</strong>")`);
            } else {
              createStatusPlaceholder(tab.panelBodyEl, 'notFound', `Нічого не знайдено за запитом "<strong>${tab.searchQuery}</strong>"`);
            }
            tab.searchQuery = '';
          }, 500);
        })
        .catch(error => {
          console.error(error);
          createStatusPlaceholder(tab.panelBodyEl, 'empty', `Помилка: ${error}`);
        });
    },
    /**
    * Отримує гіфки зі списку улюблених, збережених в локальному сховищі як масив ідентифікаторів.
    * Giphy API endpoint: https://developers.giphy.com/docs/api/endpoint/#get-gifs-by-id
    * @param {Object} tab - Об'єкт вкладки, для якої виконується запит.
    */
    fetchFavoriteGifs: (tab) => {
      const favoriteIds = tab.favoriteGifs.get();
      if (!favoriteIds.length) {
        createStatusPlaceholder(tab.panelBodyEl, 'empty', 'Гіфок не знайдено... Спробуйте додати кілька!');
        return;
      }

      const url = `${baseUrl}?api_key=${apiKey}&ids=${favoriteIds.join(',')}`;
      createStatusPlaceholder(tab.panelBodyEl, 'fetching', 'загружаємо вибрані гіфки...');
      fetch(url)
        .then(response => response.json())
        .then(result => {
          tab.gifs = result.data;
          renderGifs(tab, 'вибраних гіфок', true);
        })
        .catch(error => {
          createStatusPlaceholder(tab.panelBodyEl, 'empty', `Error fetching favorite GIFs: ${error}`);
        });
    }
  }
}