<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn size="small"
                :icon="this.vuetify.global.name == 'adminDark' ? 'mdi-brightness-4' : 'mdi-brightness-4'"
                v-bind="props"></v-btn>
        </template>

        <v-list style="
                background-color: #000f21;
                color: #b2c0ce;
                margin-left: -100px;
            ">
            <v-list-item color="primary" :variant="this.vuetify.global.name == 'adminLight' ? 'tonal' : 'plain'"
                prepend-icon="mdi-lightbulb-on-90" @click="toggleTheme()" link>
                <v-list-item-title class="cursor-pointer">Light Theme </v-list-item-title>
            </v-list-item>
            <v-list-item color="primary" :variant="this.vuetify.global.name == 'adminDark' ? 'tonal' : 'plain'"
                prepend-icon="mdi-lightbulb" @click="toggleTheme()" link>
                <v-list-item-title class="cursor-pointer">Dark Theme </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
import { useTheme } from "vuetify";

export default {
    name: "IconMenu",
    components: {

    },
    data() {
        return {
            vuetify: useTheme(),
        };
    },
    methods: {
        toggleTheme() {
            if (this.vuetify.global.name == "adminDark") {
                this.vuetify.change("adminLight");
            } else {
                this.vuetify.change("adminDark");
            }
        },
    }
};
</script>
<style></style>
