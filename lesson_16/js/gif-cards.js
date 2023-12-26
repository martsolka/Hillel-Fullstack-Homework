/**
 * Функція відображення гіфок на вкладці з пагінацією (кнопка "Показати ще").
 * @param {Object} tab - Вкладка, на якій потрібно відобразити гіфки.
 * @param {string} foundText - Текст для відображення кількості знайдених гіфок.
 * @param {boolean} refreshOnUnfavorite - Позначає, чи потрібно оновлювати вміст при видаленні з обраного.
 * @param {HTMLElement} gifsGrid - Елемент контейнера, який міститиме гіфки.
 */
function renderGifs(tab, foundText, refreshOnUnfavorite = false, gifsGrid = null) {
  const { gifs, panelBodyEl, pagination, favoriteGifs } = tab;

  // Кількість гіфок, яку слід відобразити.
  const showCount = Math.min(pagination.offset + pagination.limit, tab.gifs.length);
  // Загальна кількість гіфок на вкладці.
  const total = tab.gifs.length;

  // Створення та відображення інформаційного тексту про знайдені гіфки.
  createStatusPlaceholder(tab.panelBodyEl, 'found', `Відображено ${showCount} з ${total} ${foundText}`);

  // Створення контейнера для гіфок, якщо його ще не існує.
  if (!gifsGrid) {
    gifsGrid = createGifsGrid();
    panelBodyEl.appendChild(gifsGrid);
  }

  // Отримання підмасиву гіфок для відображення на поточній сторінці.
  const slicedGifs = gifs.slice(pagination.offset, pagination.offset + pagination.limit);

  // Додавання гіфок до відображення та налаштування обробників подій.
  slicedGifs.forEach(gif => {
    gif.isFavorite = favoriteGifs.get().includes(gif.id);
    let { cardEl, favoriteBtnEl, shareBtnEl } = createGifCard(gif);
    gifsGrid.appendChild(cardEl);
    favoriteBtnEl.addEventListener('click', onToggleFavorite);
    shareBtnEl.addEventListener('click', onShareGif);

    /**
     * Обробник події для переключення стану обраного для гіфки.
     */
    function onToggleFavorite() {
      gif.isFavorite = !gif.isFavorite;
      const favGifsIds = gif.isFavorite ? [...favoriteGifs.get(), gif.id] : favoriteGifs.get().filter(id => id !== gif.id);
      favoriteGifs.save(favGifsIds);
      favoriteBtnEl.setAttribute('title', gif.isFavorite ? 'Видалити з обраних' : 'Додати до обраних');
      favoriteBtnEl.querySelector('i').className = `bi bi-bookmark-heart${gif.isFavorite ? '-fill' : ''}`;

      showToast(`GIF "<strong>${gif.title}</strong>" ${gif.isFavorite ? '<strong>додано</strong> до' : '<strong>видалено</strong> з'} обраних`);

      // Оновлення вкладки при видаленні з обраного, якщо встановлено відповідний параметр 
      // (спойлер: клік відбуватиметься лише на вкладці "Favorites" щоб перерендерити вміст і відображати лише додані гіфки).
      if (refreshOnUnfavorite) {
        tab.tabEl.click();
      }
    }

    /**
     * Обробник події для кнопок поширення в соціальних мережах та копіювання в буфер.
     */
    function onShareGif() {
      const shareModal = document.getElementById('share-modal');
      shareModal.querySelectorAll('[data-share]').forEach(btn => {
        btn.addEventListener('click', () => shareGifOnSocial(btn, gif));
      });
      shareModal.querySelectorAll('[data-copy]').forEach(btn => {
        btn.addEventListener('click', () => copyGifToClipboard(btn, gif, shareModal));
      });
    }
  });

  // Відображення кнопки "Показати ще", якщо є ще гіфки для відображення.
  if (pagination.offset + pagination.limit < gifs.length) {
    const loadMoreBtn = createLoadMoreBtn();
    loadMoreBtn.addEventListener('click', () => {
      document.body.classList.add('show-more');
      setTimeout(() => {
        document.body.classList.remove('show-more');
        renderGifs(tab, foundText, refreshOnUnfavorite, gifsGrid);
        loadMoreBtn.remove();
      }, 300);
    });

    panelBodyEl.appendChild(loadMoreBtn);
  }

  // Збільшення вказівника offset для наступної порції гіфок.
  pagination.offset += pagination.limit;
}

/**
 * Функція для створення елемент GIF-картки на основі заданих даних GIF.
 *
 * @param {Object} gifData - Дані GIF отримані з API.
 * @param {string} gifData.id - Ідентифікатор гіфки.
 * @param {string} gifData.title - Назва гіфки.
 * @param {string} gifData.url - Посилання гіфки на GIPHY.
 * @param {string} gifData.images.original.url - Посилання на зображення гіфки.
 * @param {boolean} gifData.isFavorite - Стан гіфки (true - додано до обраних, false - не є в обраних).
 * @return {Object} - Об'єкт, що містить елемент GIF-картки, елемент кнопки "Додати до обраних/Видалити з обраних" та елемент кнопки "Поділитися".
 */
function createGifCard(gifData) {
  const { id, title, url, images: { original: { url: imgUrl } }, isFavorite } = gifData;
  const cardHTML = `
    <div class="card bg-glass p-2 rounded-4" data-gif-id="${id}">
      <img class="card-img rounded-4" src="${imgUrl}" alt="${title}" loading="lazy">
      <div class="card-img-overlay bg-glass m-2 vstack justify-content-end rounded-4">
        <h6 class="card-title text-white rounded-4 p-2">${title}</h6>
        <div class="hstack gap-2" aria-label="GIF actions">
          <a class="btn bg-gradient text-light border-0 icon-link icon-link-hover stretched-link" href="${url}" target="_blank">GIPHY<i class="bi bi-arrow-right"></i></a>
          <button class="btn p-2 fs-5 bg-gradient text-light border-0 position-relative z-3 ms-auto" type="button" data-gif-btn="favorite" title="${isFavorite ? 'Видалити з обраних' : 'Додати до обраних'}">
            <i class="bi bi-bookmark-heart${isFavorite ? '-fill' : ''}"></i>
          </button>
          <button class="btn p-2 fs-5 bg-gradient text-light border-0 position-relative z-3" type="button" data-gif-btn="share" data-bs-toggle="modal" data-bs-target="#share-modal" title="Поділитися">
            <i class="bi bi-share"></i>
          </button>
        </div>
      </div>
    </div>`;
  const cardEl = htmlToElement(cardHTML);
  return {
    cardEl,
    favoriteBtnEl: cardEl.querySelector('[data-gif-btn="favorite"]'),
    shareBtnEl: cardEl.querySelector('[data-gif-btn="share"]'),
  }
}

/**
 * Функція для створення елементу кнопки "Показати ще".
 */
function createLoadMoreBtn() {
  return htmlToElement('<button class="btn px-5 bg-glass text-light rounded-4 border-0 mt-3" type="button">Показати ще</button>');
}

/**
 * Функція для створення сітки для елементів GIF-карток.
 */
function createGifsGrid() {
  return htmlToElement('<div class="masonry masonry-cols-sm-2 masonry-cols-md-3 masonry-cols-lg-4"></div>');
}