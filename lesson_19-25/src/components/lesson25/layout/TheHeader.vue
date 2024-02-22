<template>
  <header class="row row-gap-1 py-2">
    <div class="col-4 flex-fill pe-0">
      <search-input />
    </div>
    <div class="col col-sm-auto">
      <div class="d-flex gap-1">
        <icon-button biName="bell" />
        <icon-button biName="chat" />
        <user-button />
        <icon-button biName="box-arrow-right" />
      </div>
    </div>
  </header>
</template>

<script>
import SearchInput from '../SearchInput.vue';
import IconButton from '../IconButton.vue';
import UserButton from '../UserButton.vue';

export default {
  components: { SearchInput, IconButton, UserButton },
};
</script>

<style scoped></style>
