<template>
  <div class="bg-light vh-100">
    <div class="row w-75 h-100 align-items-center mx-auto">
      <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto h-75">
        <div class="card h-100 shadow border-0 rounded-5 overflow-hidden text-center">
          <div class="card-header p-3 border-0">
            <h1 class="card-title">Трекер оцінок</h1>
            <h6 class="card-subtitle">Всього студентів: {{ students.length }}</h6>
          </div>
          <ul class="card-body overflow-auto list-unstyled">
            <li class="text-muted hstack h-100 justify-content-center" v-show="!students.length">Загрузка...</li>
            <li class="hstack justify-content-between p-2 gap-2 border-bottom rounded"
              v-for="{ id, name, score } in students" :key="id">
              <h4>{{ name }}</h4>
              <span class="badge d-inline-flex text-bg-dark bg-opacity-75">
                {{ score }} балів
              </span>
            </li>
          </ul>
          <div class="card-footer border-0 fw-medium">
            Середній бал -
            <span :class="averageBadgeClass">
              {{ averageScore }}
              <span v-show="students.length">
                <span v-if="isAverageScoreIncreasing">&#129045;</span>
                <span v-else>&#129047;</span>
              </span>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      students: [],
      isAverageScoreIncreasing: true,
      averageBadgeClass: '',
    };
  },
  computed: {
    averageScore() {
      if (this.students.length === 0) return 0;
      return (this.students.reduce((acc, student) => acc + student.score, 0) / this.students.length).toFixed(1);
    },
  },
  methods: {
    generateStudent() {
      let nameList = [
        'Time', 'Past', 'Future', 'Dev', 'Fly', 'Flying', 'Soar', 'Soaring', 'Power', 'Falling', 'Fall', 'Jump', 'Cliff',
        'Mountain', 'Rend', 'Red', 'Blue', 'Green', 'Yellow', 'Gold', 'Demon', 'Demonic', 'Panda', 'Cat', 'Kitty', 'Kitten',
        'Zero', 'Memory', 'Trooper', 'Bandit', 'Fear', 'Light', 'Glow', 'Tread', 'Deep', 'Deeper', 'Deepest', 'Mine', 'Your',
      ];

      return {
        id: (new Date()).getTime(),
        name: nameList[Math.floor(Math.random() * nameList.length)],
        score: Math.floor(Math.random() * 100)
      };
    },
  },
  watch: {
    averageScore(newScore, oldScore) {
      this.isAverageScoreIncreasing = newScore > oldScore;
      this.averageBadgeClass = this.isAverageScoreIncreasing ? 'badge text-bg-success' : 'badge text-bg-danger';
    },
  },
  created() {
    setInterval(() => {
      this.students.push(this.generateStudent());
    }, 5000)
  },
  mounted() {
    document.title = "ДЗ 21. VUE: v-for, computed, watchers";
    document.head.insertAdjacentHTML(
      "beforeend",
      '<link  href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">'
    );
  },
};
</script>

<style scoped></style>