<template>
  <span
    class="d-block ratio ratio-1x1 border border-4 border-light border-opacity-10 rounded-circle overflow-hidden"
    :style="{ width: size }"
  >
    <img
      class="object-fit-cover rounded-circle"
      :src="imageSrc || account.avatar"
      :alt="`${userFullName || account.fullName} Avatar`"
    />
  </span>
</template>

<script>
import { mapState } from "pinia";
import { useAccountStore } from "@/stores/account";
export default {
  props: {
    size: {
      type: String,
      default: "100%",
    },
    imageSrc: {
      type: String,
      default: "",
    },
    userFullName: {
      type: String,
      default: "",
    },
  },
  computed: {
    ...mapState(useAccountStore, ["account"]),
  },
};
</script>
