<template>
  <div
    class="btn-group btn-group-sm p-1 flex-wrap shadow-sm"
    role="group"
    aria-label="Theme Toggle"
  >
    <input
      type="radio"
      class="btn-check"
      name="theme"
      id="themeLight"
      value="light"
      v-model="selectedTheme"
    />
    <label
      class="btn btn-dark-transparent vstack align-items-center justify-content-center flex-md-row column-gap-2 fw-medium lh-sm text-center"
      for="themeLight"
    >
      <i class="bi bi-sun fs-5"></i>
      <small class="d-none d-sm-block">Light</small>
    </label>
    <input
      type="radio"
      class="btn-check"
      name="theme"
      id="themeDark"
      value="dark"
      v-model="selectedTheme"
    />
    <label
      class="btn btn-dark-transparent vstack align-items-center justify-content-center flex-md-row column-gap-2 fw-medium lh-sm text-center"
      for="themeDark"
    >
      <i class="bi bi-moon-stars fs-5"></i>
      <small class="d-none d-sm-block">Dark</small>
    </label>
  </div>
</template>

<script>
import { mapStores } from "pinia";
import { useThemeStore } from "@/stores/theme";

export default {
  computed: {
    ...mapStores(useThemeStore),
    selectedTheme: {
      get() {
        return this.themeStore.userTheme;
      },
      set(value) {
        this.themeStore.setTheme(value);
      },
    },
  },
  created() {
    this.selectedTheme =
      this.themeStore.userTheme || this.themeStore.preferedTheme;
  },
};
</script>
