<template>
  <div
    class="container-fluid d-flex vh-100 p-2 p-sm-4 bg-secondary-subtle text-body bg-gradient"
  >
    <suspense>
      <div
        class="row flex-grow-1 flex-nowrap shadow rounded-4 overflow-hidden bg-light bg-opacity-10 mx-auto mw-900"
      >
        <div class="col-2 col-md-3 px-0">
          <the-sidebar
            :activePageComponent="activePageComponent"
            @change-page="onChangePage"
          />
        </div>
        <div class="col d-flex flex-column h-100 bg-body bg-opacity-25">
          <the-header />
          <main class="flex-grow-1 overflow-y-auto border-bottom">
            <keep-alive>
              <component :is="activePageComponent" />
            </keep-alive>
          </main>
          <the-footer />
        </div>
      </div>
      <template #fallback>
        <loader />
      </template>
    </suspense>
  </div>
</template>

<script>
import "bootstrap/dist/css/bootstrap.min.css";

import { defineAsyncComponent } from "vue";
import { mapActions } from "pinia";
import { useAccountStore } from "@/stores/account";

import Loader from "./components/lesson25/Loader.vue";
import TheHeader from "./components/lesson25/layout/TheHeader.vue";
import TheSidebar from "./components/lesson25/layout/TheSidebar.vue";
import TheFooter from "./components/lesson25/layout/TheFooter.vue";

export default {
  components: {
    Loader,
    TheHeader,
    TheSidebar,
    TheFooter,
    AccountIndex: defineAsyncComponent(() =>
      import("./components/lesson25/account/AccountIndex.vue")
    ),
    FeedIndex: defineAsyncComponent(() =>
      import("./components/lesson25/feed/FeedIndex.vue")
    ),
  },
  data() {
    return {
      activePageComponent: "AccountIndex",
    };
  },
  methods: {
    ...mapActions(useAccountStore, ["fetchAccount"]),
    onChangePage(page) {
      if (
        this.activePageComponent === page ||
        this.$options.components[page] === undefined
      ) {
        console.log("Page already active or not provided in components");
        return;
      }
      this.activePageComponent = page;
    },
  },
  created() {
    document.title = "ДЗ 25. Сховища VUE. Pinia";
    this.fetchAccount();
  },
};
</script>

<style>
@import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css");

.btn-dark-transparent {
  --bs-btn-color: var(--bs-dark-text-emphasis);
  --bs-btn-bg: transparent;
  --bs-btn-border-color: transparent;
  --bs-btn-hover-color: var(--bs-body-emphasis);
  --bs-btn-hover-bg: rgba(var(--bs-body-bg-rgb), 0.3);
  --bs-btn-hover-border-color: transparent;
  --bs-btn-active-color: var(--bs-body-emphasis);
  --bs-btn-active-border-color: transparent;
  --bs-btn-active-bg: rgba(var(--bs-body-bg-rgb), 0.5);
  --bs-btn-disabled-bg: rgba(var(--bs-body-bg-rgb), 0.1);
  --bs-btn-disabled-border-color: transparent;
  --bs-btn-disabled-color: rgba(var(--bs-body-color-rgb), 0.5);
}

.mw-900 {
  max-width: 900px;
}

#app {
  ::-webkit-scrollbar {
    width: 4px;
    height: 4px;
  }

  ::-webkit-scrollbar-track {
    background: rgba(var(--bs-body-color-rgb), 0.05);
  }

  ::-webkit-scrollbar-thumb {
    background: rgba(var(--bs-body-color-rgb), 0.15);
  }
}
</style>
