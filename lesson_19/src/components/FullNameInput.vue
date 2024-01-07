<template>
  <div class="row g-2">
    <div class="col">
      <div class="form-floating shadow-sm">
        <input v-if="method === 3" class="form-control" id="name" type="text" placeholder="Enter name (computed)"
          v-model="nameComputed">
        <input v-else class="form-control" id="name" type="text" placeholder="Enter name" v-model="name">
        <label for="name">Name</label>
      </div>
    </div>
    <div class="col">
      <div class="form-floating shadow-sm">
        <input v-if="method === 3" class="form-control" id="surname" type="text" placeholder="Enter surname (computed)"
          v-model="surnameComputed">
        <input v-else class="form-control" id="surname" type="text" placeholder="Enter surname" v-model="surname">
        <label for="surname">Surname</label>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: '',
      surname: ''
    }
  },
  props: {
    method: {
      required: true,
      type: Number
    },
    fullName: {
      required: true,
      type: String
    },
    // modelValue: {
    //   required: true,
    //   type: String
    // },
  },
  computed: {
    nameComputed: {
      get() {
        if (this.method !== 3) {
          return '';
        }
        return this.modelValue.split(' ')[0] || '';
      },
      set(value) {
        this.fire(`${value} ${this.surnameComputed}`);
      }
    },
    surnameComputed: {
      get() {
        if (this.method !== 3) {
          return '';
        }
        return this.modelValue.split(' ')[1] || '';
      },
      set(value) {
        this.fire(`${this.nameComputed} ${value}`);
      }
    }
  },
  methods: {
    fire(value = null) {
      const updatedFullName = `${this.name} ${this.surname}`;
      if (this.method === 1) {
        this.$emit('updateFullName', updatedFullName);
      } else {
        this.$emit('update:modelValue', value || updatedFullName);
      }
    }
  },
  watch: {
    name() {
      this.fire();
    },
    surname() {
      this.fire();
    },
  },
  created() {
    if (this.method === 3) {
      return;
    }
    [this.name, this.surname] = (this.fullName || this.modelValue).split(' ');
  }
}
</script>