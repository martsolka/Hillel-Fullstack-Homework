<template>
  <div class="card text-center">
    <h3 class="card-header">Random GIF</h3>
    <div class="card-body position-relative">
      <figure>
        <img class="figure-img img-fluid rounded" :src="gifImage" :alt="gifCaption">
        <figcaption class="figure-caption">{{ gifCaption }}</figcaption>
      </figure>
      <button class="btn btn-dark fw-medium w-100 mb-1 position-relative z-3" type="button" @click="fetchGif"
        :disabled="isLoading">✨ {{ isLoading ? 'Loading...' : 'Get Another GIF' }} ✨</button>
      <a class="stretched-link link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover small"
        :href="gifUrl" target="_blank">
        View on GIPHY &rarr;
      </a>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      giphy: {
        apiKey: 'vw4LUmpjLvqSTFaLvFKedzH6GwK7h1jP',
        endpoint: 'https://api.giphy.com/v1/gifs/random',
      },
      gif: null,
      isLoading: false,
    }
  },
  computed: {
    gifUrl() {
      return this.gif?.url || 'https://giphy.com';
    },
    gifCaption() {
      return this.gif?.title.trim() || 'No gif title';
    },
    gifImage() {
      return this.gif?.images.fixed_height.url || 'https://placehold.co/300x200.png?text=No+image';
    }
  },
  methods: {
    fetchGif() {
      this.isLoading = true;
      setTimeout(() => {
        axios.get(`${this.giphy.endpoint}?api_key=${this.giphy.apiKey}`)
          .then(response => this.gif = response.data.data)
          .catch(error => console.error(error))
          .finally(() => this.isLoading = false);
      }, 500);
    }
  },
  created() {
    this.fetchGif();
  }
}
</script>