<template>
  <div>
            <!-- TEXT -->
            <v-text-field
             v-bind="$attrs"
             v-if="field === 'text'"
            />

            <v-textarea
             v-bind="$attrs"
             v-if="field === 'textarea'"
            />

            <v-select
             v-bind="$attrs"
             v-if="field === 'select'"
            />
  </div>
</template>

<script>
export default {
  props: {
        field: {
          default:'text'
        }
  },
  methods: {
   
  },
  
};
</script>
