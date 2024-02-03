<template>
  <div class="card">
    <div class="card-header text-center">
      <h3 class="card-title mb-0">Full Name Builder</h3>
      <small class="text-muted">(using custom input component and two-way binding)</small>
    </div>
    <div class="card-body">
      <!-- 1st method(custom prop + custom event) -->
      <full-name-input v-if="method === 1" :method="method" :full-name="fullName" @updateFullName="onUpdateFullName" />
      <!-- 2nd method(modelValue prop with data) or 3rd method(modelValue prop with computed): -->
      <full-name-input v-if="method === 2 || method === 3" v-model="fullName" :method="method" />
      <div class="input-group shadow-sm mt-3">
        <div class="form-floating" style="min-width: 50%;">
          <select class="form-select" id="method" v-model.number="method">
            <option value="1">custom prop + custom event</option>
            <option value="2">modelValue prop with data</option>
            <option value="3">modelValue prop with computed</option>
          </select>
          <label for="method">Method</label>
        </div>
        <span class="input-group-text flex-grow-1 overflow-auto">{{ fullName }}</span>
      </div>
    </div>
  </div>
</template>

<script>
import FullNameInput from './FullNameInput.vue';

export default {
  components: { FullNameInput },
  data() {
    return {
      fullName: 'Solomia Martyniuk',
      method: 1,
    }
  },
  methods: {
    onUpdateFullName(updatedFullName) {
      this.fullName = updatedFullName;
    }
  },
}
</script>