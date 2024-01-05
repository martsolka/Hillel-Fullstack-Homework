<template>
  <h4 class="mb-0">{{ character.title }}</h4>
  <div class="btn-group text-bg-dark bg-opacity-50" role="group">
    <button class="btn btn-dark text-info" type="button" @click="decrement()" :disabled="count === 0">-</button>
    <small class="fs-5 fw-medium px-3 align-self-center">{{ count }}</small>
    <button class="btn btn-dark text-info" type="button" @click="increment()" :disabled="availableCount === 0">+</button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      count: 0,
    }
  },
  props: {
    character: {
      required: true,
      type: Object
    },
    availableCount: {
      required: true,
      type: Number
    },
  },
  methods: {
    increment() {
      this.count++;
      this.update();
    },
    decrement() {
      this.count--;
      this.update();
    },
    update() {
      let updatedCharacter = { ...this.character };
      updatedCharacter.count = this.count;
      this.$emit('changeCharacter', updatedCharacter);
    },
  },
}
</script>
