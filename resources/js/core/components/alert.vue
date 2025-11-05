<template>
  <v-snackbar
    v-model="alert.show"
    :color="alert.current?.color"
    location="top right"
    rounded="lg"
    variant="flat"
    multi-line
    class="text-white"
  >
    <div class="d-flex align-center justify-between w-100">
      <span>{{ alert.current?.message }}</span>
      <v-btn
        icon="mdi-close"
        variant="text"
        size="small"
        @click="alert.show = false"
      />
    </div>
  </v-snackbar>
</template>

<script setup>
    import { useAlertStore } from '@/stores/alertStore'
    const alert = useAlertStore()
</script>
