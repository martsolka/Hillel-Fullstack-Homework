import { defineStore } from 'pinia';
import axios from 'axios';

export const useAccountStore = defineStore('account', {
  state: () => ({
    account: {
      fullName: null,
      nickName: null,
      about: null,
      avatar: null,
      cover: null,
      additional: null,
      stats: null
    }
  }),
  getters: {
    firstName: (state) => {
      return state.account.fullName?.split(' ')[0];
    },
    lastName: (state) => {
      return state.account.fullName?.split(' ')[1];
    }
  },
  actions: {
    async fetchAccount() {
      try {
        const response = await axios.get('https://randomuser.me/api/');
        const data = response.data.results[0];
        this.account = {
          fullName: `${data.name.first} ${data.name.last}`,
          nickName: data.login.username,
          avatar: data.picture.large,
          cover: 'https://source.unsplash.com/random/1920x1080/?landscape,wallpapers',
          about: "👋 Welcome to my profile! I'm a passionate adventurer, ☕ coffee lover, and 🐾 pets enthusiast.Let's connect and discover the wonders of the world side by side!",
          additional: {
            gender: data.gender,
            birth: new Date(data.dob.date).toLocaleDateString(),
            email: data.email,
            phone: data.phone,
            location: `${data.location.city}, ${data.location.country}`,
            joined: new Date(data.registered.date).toLocaleDateString(),
          },
          stats: [
            { label: 'followers', count: Math.floor(Math.random() * 1000) },
            { label: 'following', count: Math.floor(Math.random() * 1000) },
            { label: 'posts', count: Math.floor(Math.random() * 50) },
          ]
        };
      } catch (error) {
        console.error(error);
      }
    },
    setFullName(firstName, lastName) {
      this.account.fullName = `${firstName} ${lastName}`;
    }
  },
})