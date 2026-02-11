import { defineStore } from 'pinia';

export const usePlanStore = defineStore('plan', {
  state: () => ({
    selectedPlanId: null,
  }),

  actions: {
    setPlanId(id) {
      this.selectedPlanId = id;
    },
    clearPlan() {
      this.selectedPlanId = null;
    }
  }
});
