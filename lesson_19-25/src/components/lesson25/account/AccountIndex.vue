<template>
  <div class="d-flex flex-column row-gap-2 h-100">
    <div
      class="flex-shrink-0 h-20vh rounded-top-3 bg-secondary-subtle overflow-hidden"
    >
      <img
        class="d-block w-100 h-100 object-fit-cover"
        :src="accountStore.account.cover"
        :alt="`${accountStore.account.fullName} Profile Cover`"
      />
    </div>
    <div
      class="row align-items-center justify-content-center g-0 gap-2 px-sm-3 negative-offset shadow-sm rounded-bottom-3"
    >
      <div class="col-4 col-md-3">
        <user-avatar />
      </div>
      <div
        class="col-12 col-sm text-center text-sm-start align-self-end mb-md-3"
      >
        <h5 class="mb-0">
          {{ accountStore.account.fullName }}
        </h5>
        <span class="text-muted">
          {{ accountStore.account.nickName }}
        </span>
      </div>
      <div
        class="col-12 col-md-auto d-flex flex-wrap justify-content-around align-items-center flex-md-column gap-3"
      >
        <button
          v-if="isUserProfile"
          class="btn btn-light fw-medium shadow-sm"
          @click="showForm = true"
        >
          <i class="bi bi-pencil me-2"></i>
          <span>Edit Profile</span>
        </button>
        <div v-else class="d-inline-flex gap-2">
          <button class="btn btn-dark fw-medium shadow-sm">
            <i class="bi bi-person-plus"></i>
            <span class="ms-2">Follow</span>
          </button>
          <button class="btn btn-light fw-medium shadow-sm">
            <i class="bi bi-chat-text"></i>
            <span class="ms-2">Message</span>
          </button>
        </div>
        <ul class="list-inline d-inline-flex small mb-0">
          <template
            v-for="({ label, count }, index) in accountStore.account.stats"
            :key="title"
          >
            <li
              class="list-inline-item d-flex align-items-end align-items-sm-center flex-sm-column column-gap-1 lh-sm"
            >
              <strong>{{ count }}</strong>
              <small class="text-muted">{{ label }}</small>
            </li>
            <li
              class="list-inline-item vr"
              v-if="index < accountStore.account.stats.length - 1"
            ></li>
          </template>
        </ul>
      </div>
      <ul class="nav nav-underline nav-justified">
        <li
          class="nav-item"
          v-for="({ title, icon }, index) in tabs"
          :key="title"
        >
          <a
            :class="[
              'nav-link link-body-emphasis fs-5',
              { active: activeTabIndex === index },
            ]"
            href="#"
            :title="title"
            @click.prevent="activeTabIndex = index"
          >
            <i :class="icon"></i>
          </a>
        </li>
      </ul>
    </div>
    <div class="col-12">
      <component :is="tabs[activeTabIndex].component" />
    </div>
  </div>
  <account-form v-model="showForm" />
</template>

<script>
import { mapStores } from "pinia";
import { useAccountStore } from "@/stores/account";
import UserAvatar from "../UserAvatar.vue";
import AccountForm from "./AccountForm.vue";
import AccountTabBodyAbout from "./AccountTabBodyAbout.vue";

export default {
  components: { UserAvatar, AccountForm, AccountTabBodyAbout },
  data() {
    return {
      activeTabIndex: 0,
      showForm: false,
      isUserProfile: true,
    };
  },
  computed: {
    ...mapStores(useAccountStore),
    tabs() {
      return [
        {
          title: "About",
          icon: "bi bi-file-earmark-person",
          component: "AccountTabBodyAbout",
        },
        { title: "Posts", icon: "bi bi-file-earmark-post" },
        { title: "Collections", icon: "bi bi-collection" },
        { title: "Likes", icon: "bi bi-heart" },
        { title: "Followers", icon: "bi bi-people" },
        { title: "Following", icon: "bi bi-person-check" },
      ];
    },
  },
};
</script>

<style scoped>
.negative-offset {
  margin-top: -20%;

  @media (min-width: 576px) {
    margin-top: -15%;
  }

  @media (min-width: 768px) {
    margin-top: -10%;
  }
}

.h-20vh {
  height: 20vh;
}
</style>
