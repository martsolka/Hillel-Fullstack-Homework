<template>
  <footer
    class="row align-items-center justify-content-between gap-2 py-2 small flex-wrap-reverse text-center text-sm-start"
  >
    <div class="col-auto text-body-decondary">
      <small>&copy 2024 Socialite. All rights reserved.</small>
    </div>
    <div class="col-auto">
      <secondary-navigation />
    </div>
  </footer>
</template>

<script>
import SecondaryNavigation from "../SecondaryNavigation.vue";

export default {
  components: { SecondaryNavigation },
};
</script>

<style scoped></style>
