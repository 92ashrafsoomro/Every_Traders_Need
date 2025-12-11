<template>
  
            <v-btn size="small" :icon="isDark ? 'mdi-lightbulb-off' : 'mdi-lightbulb-on'" @click="toggleTheme"/>
     

      
            <!-- Dark Theme -->
         
   

</template>
<script>
import { useTheme } from "vuetify";

export default {
    name: "IconMenu",
    data() {
        return {
            vuetify: useTheme(),
        };
    },
    computed: {
        isDark() {
            return this.vuetify.global.name === "adminDark";
        },
        isLight() {
            return this.vuetify.global.name === "adminLight";
        },
    },
    methods: {
        toggleTheme() {
            this.vuetify.change(this.isDark ? "adminLight" : "adminDark");
        },
    },
};
</script>
