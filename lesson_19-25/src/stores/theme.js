import { defineStore } from 'pinia'

export const useThemeStore = defineStore('theme', {
  state: () => ({
    userTheme: localStorage.getItem('theme'),
  }),
  getters: {
    preferedTheme: (state) => {
      return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }
  },
  actions: {
    setTheme(theme) {
      this.userTheme = theme;
      localStorage.setItem('theme', theme);
      document.documentElement.dataset.bsTheme = theme;
    }
  },
})