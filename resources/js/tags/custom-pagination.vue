<template>
  <div class="d-flex justify-end pt-2 align-end flex-wrap">

    <!-- First Page Button -->
    <v-btn icon :disabled="page === 1 || loading" @click="changePage(1)">
      <v-icon>mdi-page-first</v-icon>
    </v-btn>

    <!-- Previous Button -->
    <v-btn icon :disabled="page === 1 || loading" @click="changePage(page - 1)">
      <v-icon>mdi-chevron-left</v-icon>
    </v-btn>

    <!-- Page Numbers -->
    <v-btn
      icon
      v-for="(n, i) in displayedPages"
      :key="n"
      :disabled="loading"
      :color="n === page ? 'primary' : ''"
      @click="changePage(n)"
    >
      {{ n }}
    </v-btn>

    <!-- Next Button -->
    <v-btn icon :disabled="page === lastPage || loading" @click="changePage(page + 1)">
      <v-icon>mdi-chevron-right</v-icon>
    </v-btn>

    <!-- Last Page Button -->
    <v-btn icon :disabled="page === lastPage || loading" @click="changePage(lastPage)">
      <v-icon>mdi-page-last</v-icon>
    </v-btn>

  </div>
</template>

<script>
export default {
  props: {
    page: { default: 1 },
    lastPage: { default: 0 },
    loading: { default: false },
  },
  data() {
    return {
      windowWidth: window.innerWidth,
    };
  },
  computed: {
    maxVisiblePages() {
    
      if (this.windowWidth < 600) return 2;
      return 5;
    },
    displayedPages() {
      const pages = [];
      const max = this.maxVisiblePages;

      let start = Math.max(this.page - Math.floor(max / 2), 1);
      let end = Math.min(start + max - 1, this.lastPage);

      start = Math.max(end - max + 1, 1);

      for (let i = start; i <= end; i++) {
        pages.push(i);
      }
      return pages;
    },
  },
  methods: {
    changePage(i) {
      if (i < 1 || i > this.lastPage) return;
      this.$emit("update:page", i);
      this.$emit("page-changed", i);
    },
    handleResize() {
      this.windowWidth = window.innerWidth;
    },
  },
  mounted() {
    window.addEventListener("resize", this.handleResize);
  },
  beforeUnmount() {
    window.removeEventListener("resize", this.handleResize);
  },
};
</script>
