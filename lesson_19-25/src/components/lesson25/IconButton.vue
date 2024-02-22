<template>
  <button class="btn btn-dark-transparent shadow-sm p-2 lh-1 fs-5">
    <i :class="['bi', 'bi-' + biName]"></i>
  </button>
</template>

<script>
export default {
  props: {
    biName: {
      type: String,
      required: true,
    },
  },
};
</script>
