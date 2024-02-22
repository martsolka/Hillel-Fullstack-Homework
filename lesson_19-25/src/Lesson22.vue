<template>
  <div
    class="vh-100 bg-primary-subtle bg-gradient px-3 py-5 transition-bg-color"
    :data-bs-theme="theme"
  >
    <transition name="scale-up-top" mode="out-in" appear>
      <div
        v-if="isLoading"
        class="fixed-top h-100 hstack justify-content-center gap-2 text-body"
      >
        <div class="spinner-border" aria-hidden="true"></div>
        <strong role="status">Loading...</strong>
      </div>
      <div
        v-else
        class="card bg-body-tertiary bg-opacity-25 w-100 h-100 mx-auto shadow rounded-4 overflow-hidden"
      >
        <div class="card-header p-0">
          <div
            class="hstack justify-content-center gap-2 px-3 shadow-sm small text-body-secondary"
          >
            {{ currentDateTime }}
          </div>
          <div
            class="hstack justify-content-between bg-gradient shadow-sm p-3 mb-1"
          >
            <h2 class="mb-0">Daily TODO List</h2>
            <button
              class="btn btn-translucent fs-5 bg-gradient shadow-sm"
              type="button"
              @click="changeTheme()"
            >
              {{ themeIcon }}
            </button>
          </div>
          <nav
            class="nav nav-underline nav-fill px-3 flex-nowrap text-nowrap overflow-auto"
          >
            <button
              type="button"
              :class="['nav-link link-body-emphasis', { active: filter === 1 }]"
              @click="filter = 1"
            >
              📝 Today's TODOs
              <sup
                class="shadow-sm bg-body bg-opacity-10 bg-gradient px-1 rounded"
              >
                {{ todaysTODOs.length }}
              </sup>
            </button>
            <button
              type="button"
              :class="['nav-link link-body-emphasis', { active: filter === 2 }]"
              @click="filter = 2"
            >
              ⏳ In Progress
              <sup
                class="shadow-sm bg-body bg-opacity-10 bg-gradient px-1 rounded"
              >
                {{ inProgressTODOs.length }}
              </sup>
            </button>
            <button
              type="button"
              :class="['nav-link link-body-emphasis', { active: filter === 3 }]"
              @click="filter = 3"
            >
              ✔ Completed
              <sup
                class="shadow-sm bg-body bg-opacity-10 bg-gradient px-1 rounded"
              >
                {{ completedTODOs.length }}
              </sup>
            </button>
            <button
              type="button"
              :class="['nav-link link-body-emphasis', { active: filter === 4 }]"
              @click="filter = 4"
            >
              📅 Past TODOs
              <sup
                class="shadow-sm bg-body bg-opacity-10 bg-gradient px-1 rounded"
              >
                {{ pastTODOs.count }}
              </sup>
            </button>
          </nav>
        </div>
        <div class="card-body overflow-y-scroll overflow-x-hidden shadow-sm">
          <transition-group
            class="list-group h-100 rounded-0 gap-2 flex-fill"
            name="slide"
            tag="ul"
          >
            <li
              v-if="filteredTODOs.count === 0"
              class="list-group-item m-auto bg-transparent"
            >
              <p class="lead text-muted text-center">
                {{ filteredTODOs.emptyMsg }}
              </p>
            </li>
            <li
              v-else-if="filter === 4"
              v-for="(pastTodos, pastDate) in filteredTODOs.data"
              :key="pastDate"
              class="list-group-item list-group-item-action bg-transparent shadow-sm rounded-3"
            >
              <div class="d-flex gap-3">
                <div class="vr position-relative">
                  <span
                    class="position-absolute top-0 start-100 translate-middle-x p-2 bg-secondary rounded-circle"
                  ></span>
                </div>
                <div class="vstack align-items-start gap-3">
                  <span
                    class="badge bg-gradient shadow-sm text-body-secondary"
                    >{{ pastDate }}</span
                  >
                  <ul class="list-group rounded-0 gap-2 w-100">
                    <li
                      v-for="todo in pastTodos"
                      :key="todo.uuid"
                      :class="[
                        'list-group-item list-group-item-action bg-transparent shadow-sm rounded-3 disabled',
                        { 'opacity-50 bg-gradient': todo.completed },
                      ]"
                    >
                      <div class="hstack gap-2">
                        <input
                          class="form-check-input fs-4"
                          type="checkbox"
                          :id="`todo-${todo.uuid}`"
                          :checked="todo.completed"
                          @change="toggleTodoCompletion(todo)"
                        />
                        <div
                          class="position-relative flex-grow-1 lh-sm"
                          :class="{
                            'text-decoration-line-through': todo.completed,
                          }"
                        >
                          <label
                            class="form-label fs-5 fw-medium d-block stretched-link mb-0"
                            :for="`todo-${todo.uuid}`"
                            role="button"
                            tabindex="0"
                          >
                            {{ todo.title }}
                          </label>
                          <p
                            class="text-body-secondary mb-2"
                            v-if="todo.description"
                          >
                            {{ todo.description }}
                          </p>
                        </div>
                        <div class="d-flex gap-1">
                          <button
                            class="btn btn-translucent shadow-sm pe-auto"
                            type="button"
                            title="Edit"
                            v-if="filter !== 4"
                            @click="showTodoForm(todo)"
                          >
                            ✏️<span class="visually-hidden">Edit</span>
                          </button>
                          <button
                            class="btn btn-translucent shadow-sm pe-auto"
                            type="button"
                            title="Delete"
                            @click="showDeleteTodoConfirm(todo)"
                          >
                            ❌<span class="visually-hidden">Delete</span>
                          </button>
                        </div>
                      </div>
                      <div class="hstack gap-1 small text-muted ps-4 ms-2">
                        <small>Created at {{ todo.createdDT.time }}</small>
                        <small v-if="todo.updatedDT">
                          | Updated at {{ todo.updatedDT.time }}</small
                        >
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </li>
            <li
              v-else
              v-for="todo in filteredTODOs.data"
              :key="todo.uuid"
              :class="[
                'list-group-item list-group-item-action bg-transparent shadow-sm rounded-3',
                { 'opacity-50 bg-gradient': todo.completed },
              ]"
            >
              <div class="hstack gap-2">
                <input
                  class="form-check-input fs-4"
                  type="checkbox"
                  :id="`todo-${todo.uuid}`"
                  :checked="todo.completed"
                  @change="toggleTodoCompletion(todo)"
                />
                <div
                  class="position-relative flex-grow-1 lh-sm"
                  :class="{
                    'text-decoration-line-through': todo.completed,
                  }"
                >
                  <label
                    class="form-label fs-5 fw-medium d-block stretched-link mb-0"
                    :for="`todo-${todo.uuid}`"
                    role="button"
                    tabindex="0"
                  >
                    {{ todo.title }}
                  </label>
                  <p class="text-body-secondary mb-2" v-if="todo.description">
                    {{ todo.description }}
                  </p>
                </div>
                <div class="d-flex gap-1">
                  <button
                    class="btn btn-translucent shadow-sm pe-auto"
                    type="button"
                    title="Edit"
                    v-if="filter !== 4"
                    @click="showTodoForm(todo)"
                  >
                    ✏️<span class="visually-hidden">Edit</span>
                  </button>
                  <button
                    class="btn btn-translucent shadow-sm pe-auto"
                    type="button"
                    title="Delete"
                    @click="showDeleteTodoConfirm(todo)"
                  >
                    ❌<span class="visually-hidden">Delete</span>
                  </button>
                </div>
              </div>
              <div class="hstack gap-1 small text-muted ps-4 ms-2">
                <small>Created at {{ todo.createdDT.time }}</small>
                <small v-if="todo.updatedDT">
                  | Updated at {{ todo.updatedDT.time }}</small
                >
              </div>
            </li>
          </transition-group>
        </div>
        <div class="card-footer bg-gradient p-2 position-relative">
          <transition name="collapse" mode="out-in">
            <div v-if="isTodoFormVisible">
              <div class="card bg-transparent">
                <div class="card-body">
                  <div class="hstack justify-content-between mb-3">
                    <h4 class="mb-0 me-auto">
                      {{ filledTodo.uuid ? "Edit TODO" : "New TODO" }}
                    </h4>
                    <button
                      class="btn-close"
                      type="button"
                      aria-label="Close"
                      @click="hideTodoForm()"
                    ></button>
                  </div>
                  <div
                    class="vstack gap-2 overflow-y-auto p-1"
                    style="max-height: 200px"
                  >
                    <div class="form-floating">
                      <input
                        :class="[
                          'form-control bg-body bg-opacity-25',
                          { 'is-invalid': titleError },
                        ]"
                        id="todoTitle"
                        type="text"
                        placeholder="Enter title"
                        v-model="filledTodo.title"
                      />
                      <label for="todoTitle">
                        Title<sup class="text-danger">*</sup>
                      </label>
                      <div class="invalid-feedback">{{ titleError }}</div>
                    </div>
                    <div class="form-floating bg-transparent">
                      <textarea
                        :class="[
                          'form-control bg-body bg-opacity-25',
                          { 'is-invalid': descriptionError },
                        ]"
                        id="todoDescription"
                        placeholder="Enter description"
                        v-model="filledTodo.description"
                      >
                      </textarea>
                      <label for="todoDescription">
                        Description<small class="text-muted">(optional)</small>
                      </label>
                      <div class="invalid-feedback">{{ descriptionError }}</div>
                    </div>
                    <div class="form-check" v-if="filledTodo.uuid">
                      <input
                        class="form-check-input"
                        type="checkbox"
                        id="markCompleted"
                        v-model="filledTodo.completed"
                      />
                      <label class="form-check-label" for="markCompleted">
                        Mark as completed
                      </label>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div v-else-if="isDeleteTodoConfirmVisible">
              <div class="card bg-transparent">
                <div class="card-body">
                  <div class="hstack justify-content-between mb-3">
                    <h4 class="mb-0">Confirm Deletion</h4>
                    <button
                      class="btn-close"
                      type="button"
                      aria-label="Close"
                      @click="hideDeleteTodoConfirm()"
                    ></button>
                  </div>
                  <div class="vstack gap-1 text-center">
                    <span class="mb-0">
                      Are you sure you want to delete this TODO:
                    </span>
                    <strong>"{{ deletedTodo.title }}" ?</strong>
                    <span>This action cannot be undone.</span>
                  </div>
                </div>
              </div>
            </div>
          </transition>
          <button
            type="button"
            :class="['btn fw-medium fs-5 shadow-sm w-100', footerBtn.class]"
            @click="footerBtn.onClick"
          >
            {{ footerBtn.text }}
          </button>
        </div>
      </div>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      todoList: [],
      filledTodo: {},
      deletedTodo: {},
      theme: "", // dark, light
      time: "",
      filter: 1, // 1 - todays all, 2 - todays in progress, 3 - todays completed, 4 - past all
      isTodoFormVisible: false,
      isDeleteTodoConfirmVisible: false,
      titleError: "",
      descriptionError: "",
      isLoading: true,
    };
  },
  computed: {
    //#region FILTERS
    todaysTODOs() {
      return this.todoList.filter((todo) => {
        return todo.createdDT.dateMillis === this.getTodayDateTime().dateMillis;
      });
    },
    inProgressTODOs() {
      return this.todoList.filter((todo) => {
        return (
          !todo.completed &&
          todo.createdDT.dateMillis === this.getTodayDateTime().dateMillis
        );
      });
    },
    completedTODOs() {
      return this.todoList.filter((todo) => {
        return (
          todo.completed &&
          todo.createdDT.dateMillis === this.getTodayDateTime().dateMillis
        );
      });
    },
    pastTODOs() {
      let count = 0;
      const todosByDate = this.todoList.reduce((acc, todo) => {
        if (todo.createdDT.dateMillis < this.getTodayDateTime().dateMillis) {
          const pastDate = this.formatDate(todo.createdDT);
          if (!acc[pastDate]) {
            acc[pastDate] = [];
          }
          acc[pastDate].push(todo);
          count++;
        }
        return acc;
      }, {});
      return { count, todosByDate };
    },
    filteredTODOs() {
      switch (this.filter) {
        case 2:
          return {
            count: this.inProgressTODOs.length,
            data: this.inProgressTODOs,
            emptyMsg: "Nothing in progress yet 🤷",
          };
        case 3:
          return {
            count: this.completedTODOs.length,
            data: this.completedTODOs,
            emptyMsg: "Nothing completed yet 😅",
          };
        case 4:
          return {
            count: this.pastTODOs.count,
            data: this.pastTODOs.todosByDate,
            emptyMsg: "Your past TODOs will be here 😉",
          };
        default:
          return {
            count: this.todaysTODOs.length,
            data: this.todaysTODOs,
            emptyMsg: "No TODOs for today. Try to add some 🙂",
          };
      }
    },
    //#endregion FILTERS
    //#region UTILS & HELPERS
    currentDateTime() {
      return this.formatDate(this.getTodayDateTime(), true);
    },
    themeIcon() {
      return this.theme === "dark" ? "🌞" : "🌙";
    },
    footerBtn() {
      const data = {
        text: "➕ New TODO",
        onClick: () => this.showTodoForm(),
        class: "btn-translucent",
      };
      if (this.isTodoFormVisible) {
        data.text = "✅ Save Changes";
        data.onClick = () => this.saveTodo();
        data.class = "btn-success";
        return data;
      }
      if (this.isDeleteTodoConfirmVisible) {
        data.text = "🗑️ Delete TODO";
        data.onClick = () => this.deleteTodo();
        data.class = "btn-danger";
        return data;
      }
      return data;
    },
    //#endregion UTILS & HELPERS
  },
  methods: {
    // #region LOCAL STORAGE
    getLocal(key) {
      return JSON.parse(localStorage.getItem(key));
    },
    saveLocal(key, value) {
      localStorage.setItem(key, JSON.stringify(value));
    },
    // #endregion LOCAL STORAGE
    // #region TODOS MANAGEMENT:
    // #region - Popups visibility & data processing
    showTodoForm(todo = null) {
      if (this.isDeleteTodoConfirmVisible) return;
      this.filledTodo = todo
        ? { ...todo }
        : {
            uuid: null,
            title: null,
            description: null,
            completed: false,
            createdDT: null,
            updatedDT: null,
          };
      this.isTodoFormVisible = true;
    },
    showDeleteTodoConfirm(todo) {
      if (this.isTodoFormVisible) return;
      this.deletedTodo = todo;
      this.isDeleteTodoConfirmVisible = true;
    },
    hideTodoForm() {
      this.isTodoFormVisible = false;
      this.filledTodo = {};
      this.titleError = "";
      this.descriptionError = "";
    },
    hideDeleteTodoConfirm() {
      this.isDeleteTodoConfirmVisible = false;
      this.deletedTodo = {};
    },
    // #endregion - Popups visibility & data processing
    // #region - Todos actions & validation
    saveTodo() {
      this.validateTodo();
      if (this.titleError || this.descriptionError) {
        return;
      }

      const index = this.todoList.findIndex(
        (todo) => todo.uuid === this.filledTodo.uuid
      );

      if (index !== -1) {
        this.todoList[index] = {
          ...this.filledTodo,
          updatedDT: this.getTodayDateTime(),
        };
      } else {
        this.todoList.unshift({
          ...this.filledTodo,
          uuid: this.generateUUID(),
          createdDT: this.getTodayDateTime(),
        });
      }

      this.saveLocal("todoList", this.todoList);
      this.hideTodoForm();
    },
    deleteTodo() {
      const index = this.todoList.findIndex(
        (todo) => todo.uuid === this.deletedTodo.uuid
      );
      if (index !== -1) {
        this.todoList.splice(index, 1);
      }
      this.saveLocal("todoList", this.todoList);
      this.hideDeleteTodoConfirm();
    },
    toggleTodoCompletion(todo) {
      this.filledTodo = { ...todo, completed: !todo.completed };
      this.saveTodo();
    },
    validateTodo() {
      const { title, description } = this.filledTodo;

      this.titleError = !title
        ? "Title is required"
        : !title.trim()
        ? "Title cannot be empty"
        : title.length < 3
        ? "Title cannot be less than 3 characters"
        : title.length > 100
        ? "Title cannot be more than 100 characters"
        : "";

      this.descriptionError =
        description &&
        (!description.trim()
          ? "Description cannot be empty"
          : description.length > 255
          ? "Description cannot be more than 255 characters"
          : "");
    },
    // #endregion Todos actions & validation
    // #endregion TODOS MANAGEMENT
    // #region UTILS & HELPERS
    generateUUID() {
      return Math.random().toString(16).slice(2);
    },
    changeTheme() {
      this.theme = this.theme === "dark" ? "light" : "dark";
      this.saveLocal("theme", this.theme);
    },
    getTodayDateTime(locale = "en-US") {
      // locale: 'uk-UA' | undefined
      const date = new Date();
      const weekday = date.toLocaleDateString(locale, { weekday: "long" }),
        day = date.toLocaleDateString(locale, { day: "numeric" }),
        month = date.toLocaleDateString(locale, { month: "long" }),
        year = date.toLocaleDateString(locale, { year: "numeric" }),
        time = date.toLocaleTimeString(locale, {
          hour: "numeric",
          minute: "numeric",
        });

      return {
        weekday,
        day,
        month,
        year,
        time,
        dateMillis: date.setHours(0, 0, 0, 0),
      };
    },
    formatDate({ day, month, year, weekday }, addCurrTime = false) {
      return `${weekday.toUpperCase()} • ${month} ${day}, ${year}${
        addCurrTime ? ` • ${this.time}` : ""
      }`;
    },
    // #endregion UTILS & HELPERS
  },
  created() {
    this.todoList = this.getLocal("todoList") || [
      {
        uuid: this.generateUUID(),
        title: "Learn Vue.js",
        description: "Create a TODO app with Vue. This task is generated automatically.",
        completed: false,
        createdDT: this.getTodayDateTime(),
        updatedDT: null,
      },
    ];
    this.theme = this.getLocal("theme") || "light";
    this.time = this.getTodayDateTime().time;
    setInterval(() => (this.time = this.getTodayDateTime().time), 1000);
  },
  mounted() {
    document.title = "ДЗ 22. ToDO ліст на Vue";
    setTimeout(() => (this.isLoading = false), 1000);
  },
};
</script>

<style scoped>
@import url("https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css");

/* #region CARD */
.card {
  --bs-card-border-color: transparent;
  --bs-border-color: transparent;
  max-width: 400px;

  & ::-webkit-scrollbar {
    width: 4px;
    height: 4px;
  }

  & ::-webkit-scrollbar-track {
    background: rgba(var(--bs-body-color-rgb), 0.05);
  }

  & ::-webkit-scrollbar-thumb {
    background: rgba(var(--bs-body-color-rgb), 0.1);
  }
}
/* #endregion CARD */
/* #region BUTTON */
.btn-translucent {
  --bs-btn-bg: rgba(var(--bs-body-color-rgb), 0.03);
  --bs-btn-border-width: 0;
  --bs-btn-hover-bg: rgba(var(--bs-body-color-rgb), 0.06);
  --bs-btn-active-bg: rgba(var(--bs-body-color-rgb), 0.1);
  --bs-btn-border-radius: 12px;
  --bs-btn-padding-x: 8px;
  --bs-btn-padding-y: 8px;
  --bs-btn-line-height: 1.2;
}
/* #endregion BUTTON */
/* #region LIST */
.list-group {
  --bs-list-group-action-hover-bg: rgba(var(--bs-body-color-rgb), 0.03);
  --bs-list-group-disabled-color: rgba(var(--bs-body-color-rgb), 0.5);
  --bs-list-group-disabled-bg: transparent;
}
/* #endregion LIST */
/* #region FORM */
.form-floating > .form-control-plaintext ~ label::after,
.form-floating > .form-control:focus ~ label::after,
.form-floating > .form-control:not(:placeholder-shown) ~ label::after,
.form-floating > .form-select ~ label::after {
  background: transparent;
}

.form-contol {
  --bs-border-color: transparent;
}
/* #endregion FORM */
/* #region TRANSITIONS & ANIMATIONS:  */
/* #region - Default */
.transition-bg-color {
  transition: color 0.3s ease-in-out, background-color 0.3s ease-in-out;
}
/* #endregion Default */
/* #region - Collapse */
.collapse-enter-active,
.collapse-leave-active {
  display: grid;
  grid-template-rows: 1fr;
  transition: grid-template-rows 0.3s ease-in-out;

  & > * {
    overflow: hidden;
  }
}

.collapse-enter-from,
.collapse-leave-to {
  grid-template-rows: 0fr;
}
/* #endregion Collapse */
/* #endregion Fade */
/* #region - Scale Up Top */
.scale-up-top-enter-active {
  animation: scale-up-top 0.5s ease;
}

.scale-up-top-leave-active {
  animation: scale-up-top 0.5s ease reverse;
}

@keyframes scale-up-top {
  0% {
    opacity: 0.5;
    transform: scale(0.5);
    transform-origin: 50% 0%;
  }

  100% {
    opacity: 1;
    transform: scale(1);
    transform-origin: 50% 0%;
  }
}
/* #endregion Scale Up Top */
/* #region - Slide Horizontal */
.slide-move,
.slide-enter-active,
.slide-leave-active {
  transition: all 0.5s ease-in-out;
}
.slide-leave-active {
  position: absolute;
}

.slide-enter-from {
  transform: translateX(-100%);
  opacity: 0;
}
.slide-leave-to {
  transform: translateX(100%);
  opacity: 0;
}
/* #endregion Slide Horizontal */
/* #endregion TRANSITIONS & ANIMATIONS  */
</style>
