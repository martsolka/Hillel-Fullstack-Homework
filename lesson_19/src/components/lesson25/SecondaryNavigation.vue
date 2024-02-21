<template>
  <ul class="nav nav-underline small me-2">
    <li class="nav-item" v-for="{ label, href } in links" :key="label">
      <a class="nav-link link-body-emphasis fw-medium py-0" :href="href || '#'">
        <small>{{ label }}</small>
      </a>
    </li>
  </ul>
</template>

<script>
export default {
  data() {
    return {
      links: [
        { label: "About" },
        { label: "Help Center" },
        { label: "Terms & Conditions" },
        { label: "Privacy Policy" },
        { label: "Cookies" },
      ],
    };
  },
};
</script>
