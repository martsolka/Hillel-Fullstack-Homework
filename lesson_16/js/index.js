window.addEventListener('load', () => {
  readTabsAndPanelsFromFile('./data/tabsAndPanels.json')
    .then(data => {
      const giphy = setupGiphy('vw4LUmpjLvqSTFaLvFKedzH6GwK7h1jP', 'https://api.giphy.com/v1/gifs');
      const favoriteGifs = setupLocalStorage('favoriteGifs');
      const searchInputEl = document.getElementById('search-input');
      const limitSelectEl = document.getElementById('limit-select');
      const tabsContainer = document.getElementById('gifs-tab'), panelsContainer = document.getElementById('gifs-tab-content');
      const tabsAndPanels = setupTabsAndPanels(data, tabsContainer, panelsContainer, +limitSelectEl.value, giphy, favoriteGifs);

      Object.values(tabsAndPanels).forEach(tabObject => {
        tabObject.tabEl.addEventListener('click', () => {
          Object.values(tabsAndPanels).forEach(tab => tab.isActive = false);
          tabObject.isActive = true;
          tabObject.pagination = { limit: +limitSelectEl.value, offset: 0 }
          tabObject.panelBodyEl.innerHTML = '';
          tabObject.fetchGifs();
        });

        if (tabObject.isActive) {
          tabObject.tabEl.click();
        }

        limitSelectEl.addEventListener('change', () => {
          if (tabObject.isActive) {
            tabObject.tabEl.click();
          }
        });
      });

      searchInputEl.addEventListener('blur', handleSearch);

      searchInputEl.addEventListener('keyup', (event) => {
        if (event.key === 'Enter') {
          handleSearch();
          searchInputEl.blur();
        }
      });

      function handleSearch() {
        const searchTab = Object.values(tabsAndPanels).find(tab => tab.searchQuery === '');
        const query = searchInputEl.value.trim();
        if (searchTab && query) {
          searchTab.searchQuery = query;
          searchTab.tabEl.click();
        }
        searchInputEl.value = '';
      }
    })
    .catch(error => console.error('Помилка зчитання даних:', error));
});
