<template>
  <div class="card bg-transparent border-0">
    <ul class="list-group list-group-flush">
      <li class="list-group-item bg-body bg-opacity-10">
        <h4 class="card-title text-uppercase">About me</h4>
        <p class="card-text lead">
          {{ account.about }}
        </p>
      </li>
      <template v-for="(value, key) in account.additional" :key="key">
        <li class="list-group-item bg-body bg-opacity-10" v-if="key && value">
          <strong class="text-muted me-2 text-capitalize">{{ key }}:</strong>
          {{ value }}
        </li>
      </template>
    </ul>
  </div>
</template>

<script>
import { mapState } from "pinia";
import { useAccountStore } from "@/stores/account";
export default {
  computed: {
    ...mapState(useAccountStore, ["account"]),
  }
};
</script>