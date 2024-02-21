<template>
  <aside
    class="d-flex flex-column px-2 py-3 h-100 overflow-x-hidden overflow-y-auto"
  >
    <logo />
    <hr />
    <div class="overflow-y-auto mb-auto">
      <primary-navigation
        :activePageComponent="activePageComponent"
        @change-page="$emit('change-page', $event)"
      />
    </div>
    <hr />
    <theme-toggle />
  </aside>
</template>

<script>
import Logo from "../Logo.vue";
import PrimaryNavigation from "../PrimaryNavigation.vue";
import ThemeToggle from "../ThemeToggle.vue";
export default {
  components: { Logo, PrimaryNavigation, ThemeToggle },
  props: {
    activePageComponent: {
      type: String,
      required: true,
    },
  },
};
</script>
