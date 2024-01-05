<template>
  <div class="container-fluid d-flex bg-info-subtle bg-gradient vh-100" data-bs-theme="dark">
    <div class="card h-75 w-100 m-auto rounded-5 border-0 shadow overflow-hidden bg-dark-subtle"
      style="max-width: 375px;">
      <h2 class="card-header text-center p-3 border-0 shadow lh-1">
        Characteristics
        <span class="d-inline-block rounded p-2 fs-6 align-top bg-body-tertiary bg-opacity-50">
          <span>{{ availableCount }}</span> / <sub class="opacity-75" ref="maxCount"></sub>
        </span>
      </h2>
      <ul class="list-group list-group-flush gap-1 py-2 overflow-y-auto">
        <li class="list-group-item hstack justify-content-between bg-transparent border-0 shadow-sm px-4"
          v-for="character in characteristics" :key="character.id">
          <character-counter :character="character" :availableCount="availableCount"
            @changeCharacter="onChangeCharacter" />
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import CharacterCounter from './components/CharacterCounter.vue';

export default {
  components: { CharacterCounter },
  data() {
    return {
      characteristics: [
        {
          id: 1,
          title: 'Health',
          count: 0,
        },
        {
          id: 2,
          title: 'Strength',
          count: 0,
        },
        {
          id: 3,
          title: 'Intelligence',
          count: 0,
        },
        {
          id: 4,
          title: 'Endurance',
          count: 0,
        },
        {
          id: 5,
          title: 'Mana',
          count: 0,
        },
        {
          id: 6,
          title: 'Armor',
          count: 0,
        },
        {
          id: 7,
          title: 'Speed',
          count: 0,
        },
      ],
      availableCount: 10,
    }
  },
  computed: {
    sumCharacterCount() {
      return this.characteristics.reduce((acc, item) => acc + item.count, 0);
    },
  },
  methods: {
    onChangeCharacter(character) {
      const index = this.characteristics.findIndex(item => item.id === character.id);
      if (index !== -1) {
        this.characteristics[index] = character;
      }
    },
  },
  watch: {
    sumCharacterCount(newCount, oldCount) {
      if (newCount > oldCount) {
        this.availableCount--;
      } else {
        this.availableCount++;
      }
    }
  },
  mounted() {
    document.title = "ДЗ 23. Основи компонентів";
    document.head.insertAdjacentHTML(
      "beforeend",
      '<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">'
    );

    this.$refs.maxCount.innerText = this.availableCount;
  },
}
</script>


