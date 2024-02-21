<template>
  <div :class="['modal', { 'd-block': isVisible }]" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Your Profile</h4>
          <button
            type="button"
            class="btn-close"
            aria-label="Close"
            @click="isVisible = false"
          ></button>
        </div>
        <div class="modal-body">
          <form action="#">
            <fieldset>
              <legend class="h6 text-muted">General Information:</legend>
              <div class="input-group mb-3">
                <span class="input-group-text fs-5">
                  <i class="bi bi-person"></i>
                </span>
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    id="firstName"
                    placeholder="First Name"
                    v-model="firstName"
                  />
                  <label for="firstName">First Name</label>
                </div>
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    id="lastName"
                    placeholder="Last Name"
                    v-model="lastName"
                  />
                  <label for="lastName">Last Name</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text fs-5">
                  <i class="bi bi-at"></i
                ></span>
                <div class="form-floating">
                  <input
                    type="text"
                    class="form-control"
                    id="nickname"
                    placeholder="Nickname"
                    v-model="nickName"
                  />
                  <label for="nickname">Nickname</label>
                </div>
              </div>
              <div class="input-group mb-3">
                <span class="input-group-text fs-6">
                  <i class="bi bi-info-circle"></i>
                </span>
                <div class="form-floating">
                  <textarea
                    class="form-control h-auto"
                    id="about"
                    rows="3"
                    placeholder="About You"
                    v-model="about"
                  ></textarea>
                  <label for="about">About You</label>
                </div>
              </div>
            </fieldset>
            <button
              class="btn btn-dark fw-medium fs-5 shadow-sm w-100"
              type="submit"
              @click.prevent="updateAccount()"
            >
              <i class="bi bi-floppy me-2"></i>
              <span>Save Changes</span>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div v-if="isVisible" class="modal-backdrop show"></div>
</template>

<script>
import { mapStores } from "pinia";
import { useAccountStore } from "@/stores/account";

export default {
  data() {
    return {
      nickName: "",
      firstName: "",
      lastName: "",
      about: "",
    };
  },
  props: {
    modelValue: {
      type: Boolean,
      required: true,
    },
  },
  computed: {
    ...mapStores(useAccountStore),
    isVisible: {
      get() {
        return this.modelValue;
      },
      set(value) {
        this.fillForm();
        this.$emit("update:modelValue", value);
      },
    },
  },
  methods: {
    fillForm() {
      this.firstName = this.accountStore.firstName;
      this.lastName = this.accountStore.lastName;
      this.nickName = this.accountStore.account.nickName;
      this.about = this.accountStore.account.about;
    },
    updateAccount() {
      const updated = {
        ...this.accountStore.account,
        fullName: `${this.firstName} ${this.lastName}`,
        nickName: this.nickName,
        about: this.about,
      };
      this.accountStore.account = updated;
      this.isVisible = false;
    },
  },
  mounted() {
    this.fillForm();
  },
};
</script>
