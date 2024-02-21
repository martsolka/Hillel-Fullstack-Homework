<template>
  <template v-for="({ title, links }, index) in navListGroups" :key="title">
    <ul
      class="nav nav-pills flex-column flex-nowrap row-gap-1 pb-2 small px-md-2"
    >
      <li
        v-if="title"
        class="nav-item small d-none d-sm-block text-center text-md-start"
      >
        <small class="text-uppercase fw-medium text-muted">
          {{ title }}
        </small>
      </li>
      <li class="nav-item" v-for="link in links" :key="link.label">
        <a
          href="#"
          :class="[
            'btn btn-dark-transparent d-flex flex-column flex-md-row align-items-center column-gap-2 fw-medium shadow-sm lh-sm',
            { active: link.pageComponent === activePageComponent },
          ]"
          @click.prevent="
            $emit('change-page', link.pageComponent || 'EmptyPlaceholder')
          "
        >
          <i :class="[link.icon, 'fs-5']"></i>
          <small class="d-none d-sm-block">{{ link.label }}</small>
        </a>
      </li>
    </ul>
    <hr v-if="index < navListGroups.length - 1" />
  </template>
</template>

<script>
export default {
  data() {
    return {
      navListGroups: [
        {
          title: "Navigation",
          links: [
            { label: "Feed", icon: "bi bi-rss", pageComponent: "FeedIndex" },
            { label: "Discover", icon: "bi bi-globe" },
            { label: "Trending", icon: "bi bi-fire" },
            { label: "Friends", icon: "bi bi-people" },
            { label: "Events", icon: "bi bi-calendar-event" },
            { label: "Market", icon: "bi bi-shop" },
          ],
        },
        {
          title: "Account",
          links: [
            {
              label: "My Profile",
              icon: "bi bi-person-vcard",
              pageComponent: "AccountIndex",
            },
            { label: "Activity", icon: "bi bi-activity" },
            { label: "Saved", icon: "bi bi-bookmark" },
            { label: "Collections", icon: "bi bi-collection" },
            { label: "Settings", icon: "bi bi-person-gear" },
          ],
        },
      ],
    };
  },
  props: {
    activePageComponent: {
      type: String,
      required: true,
    },
  },
};
</script>
