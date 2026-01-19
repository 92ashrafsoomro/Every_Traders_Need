<template>
    <v-navigation-drawer class="pa-0" app dark color="" :width="menuWidth" v-model="themeStore.menuOpen">
        <div class="v-navigation-drawer__content">
           <v-list density="compact"   class="" nav>

                <v-list-item class="d-flex " style="height: 57px; ">
                    <img v-if="menuWidth == 258" :src="logo" style="width: auto; height: 40px; margin-left: -1px;" class="d-flex justify-center align-center" />
                    <img v-else :src="newLogo" 
                        style="width: 40px; height: 40px; " />
                </v-list-item>
               <v-divider class="ps-0 pe-0"></v-divider>


                <!-- Dynamic Menu Items -->
                <template v-for="(item, index) in userMenu" :key="index">

                    <v-list-item v-if="item.type == 'group'" class="ml-n1 mt-8"  title="" :subtitle="item.label">
                        <v-divider class="mt-2"></v-divider>
                    </v-list-item>

                    <v-list-group :value="item.label" v-else-if="item.hasOwnProperty('children')">
                        <template #activator="{ props }">
                            <v-list-item 
                            v-bind="props" 
                            :title="item.label" 
                            :prepend-icon="item.icon" class="text-body-2" />
                        
                        </template>

                        <v-list-item style="margin-left: -60px;" v-for="child in item.children" :prepend-icon="child.icon"  :title="child.label" :to="child.path" active-class="bg-primary on-primary  rounded my-active-menu hide-overlay"></v-list-item>
                    </v-list-group>
                
                    <v-list-item v-else-if="!item.hasOwnProperty('children')"     
                        :to="item.path" 
                        link 
                        :prepend-icon="item.icon" 
                        :ripple="false"
                        :hide-overlay="false"
                        class="text-subtitle-1 "
                        active-class="bg-primary on-primary  rounded my-active-menu hide-overlay">
                        <template #title>
                            <span :ripple="false" class="text-body-1 ">{{ item.label }}</span>
                        </template>
                    </v-list-item>

                    <v-list-item class=" mt-8" v-else title="" :subtitle="item.label">
                        <v-divider class="mt-2"></v-divider>
                    </v-list-item>
                </template>


            <div class="d-flex ga-6 ml-2"> <v-icon size="24" class="mt-2 text-text_light_on">mdi-shield-crown</v-icon>
                <v-list-item active-class="bg-primary on-primary  rounded my-active-menu hide-overlay " >
                 <router-link to="/user/dashboard" style="text-decoration: none ; color: white;" class="text-body-1"> Back To User</router-link></v-list-item>
            </div>
           </v-list>
        </div>
    </v-navigation-drawer>
</template>

<script>
import newLogo from "@assets/images/logo/newLogo.png" 
import { useDisplay } from "vuetify";
import { useThemeStore } from "@stores/themeStore";
import  userMenu  from "./adminMenu.json";
import logo from "@assets/images/logo/logo.png"
export default {
    data() {
        return {
            userMenu,
            themeStore: useThemeStore(),
            display: useDisplay(),
            logo: logo,
            newLogo 
        };
    },
    computed: {
        menuWidth() {
            
            // md, sm, xs
            if (this.display.mdAndDown) {
                return  "258";
            } else {
                //for: lg, xl
                return this.themeStore.menuType == "expanded" ? "258" : "68";
            }

        },
    },
    methods: {

    },
    mounted() { 

    },
};
</script>
<style >

.my-active-menu  .v-list-item__overlay {
  display: none !important;
}

.v-list-item--nav .v-list-item-title{
    font-size: 16px !important;
}
.v-navigation-drawer__content {
  overflow-y: auto;

  /* hide scrollbar */
  scrollbar-width: none;     
  -ms-overflow-style: none; 
}

.v-navigation-drawer__content::-webkit-scrollbar {
  display: none; 
}

</style>