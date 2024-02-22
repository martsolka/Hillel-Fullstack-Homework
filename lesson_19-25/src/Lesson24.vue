<template>
  <div
    class="container-fluid vstack flex-md-row align-items-center justify-content-md-center gap-5 bg-primary-subtle vh-100 py-5 px-4 overflow-auto">
    <full-name />
    <random-gif />
  </div>
</template>

<script>
import 'bootstrap/dist/css/bootstrap.min.css';
import FullName from './components/lesson24/FullName.vue';
import RandomGif from './components/lesson24/RandomGif.vue';

export default {
  components: { FullName, RandomGif },
  mounted() {
    document.title = "ДЗ 24. Підсумок базових концепцій VUE. Axios та підключення бібліотек";
  },
}
</script>

<style scoped>
.card {
  --bs-card-border-color: transparent;
  --bs-border-color: transparent;
  max-width: 400px;
  box-shadow: var(--bs-box-shadow);
}
</style>