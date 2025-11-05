<template>
    <v-menu class="menuLabel" location="bottom" transition="fade-transition">
        <template #activator="{ props }">
            <v-btn icon v-bind="props">
                <svg-icon type="mdi" :path="mdiCeilingLight"></svg-icon>
            </v-btn>
        </template>

        <v-list style="
                background-color: #000f21;
                color: #b2c0ce;
                margin-left: -100px;
            ">
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2 text-white">
                        <svg-icon type="mdi" :path="mdiGlobeLightOutline"></svg-icon>
                        <div>Light Theme</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
            <v-list-item link>
                <v-list-item-title class="cursor-pointer">
                    <div class="d-flex align-center ga-2 text-white">
                        <svg-icon type="mdi" :path="mdiGlobeLight"></svg-icon>
                        <div>Dark Theme</div>
                    </div>
                </v-list-item-title>
            </v-list-item>
        </v-list>
    </v-menu>
</template>
<script>
import SvgIcon from "@jamescoyle/vue-icon";
import {
    mdiCeilingLight,
    mdiGlobeLightOutline,
    mdiGlobeLight,
    mdiLaptop,
} from "@mdi/js";

export default {
    name: "IconMenu",
    components: {
        SvgIcon,
    },
    data() {
        return {
            mdiCeilingLight,
            mdiGlobeLightOutline,
            mdiGlobeLight,
            mdiLaptop,
        };
    },
};
</script>
<style></style>
