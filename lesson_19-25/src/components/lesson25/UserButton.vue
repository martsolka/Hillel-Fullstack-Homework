<template>
  <button class="btn btn-dark-transparent shadow-sm btn-sm hstack gap-2 ms-auto">
    <user-avatar size="32px" />
    <span class="small text-start lh-sm text-nowrap">
      <strong>Hi, {{ accountStore.firstName }}</strong>
      <small class="d-block text-muted">
        {{ accountStore.account.nickName }}
      </small>
    </span>
  </button>
</template>

<script>
import { mapStores } from 'pinia';
import { useAccountStore } from '@/stores/account';
import UserAvatar from './UserAvatar.vue';

export default {
  components: { UserAvatar },
  computed: {
    ...mapStores(useAccountStore),
  },
};
</script>
