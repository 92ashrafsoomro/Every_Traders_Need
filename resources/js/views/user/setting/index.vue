<template>
    <v-container max-width="1300px" fluid>
        <v-row>
            <v-col cols="12">
                <div class="d-flex flex-wrap">
                    <div class="px-2 py-2">
                        <v-btn to="/user/settings/profile" class="buttonBorder text-capitalize"
                            :class="{ 'bg-primary': this.$route.params.id == 'profile' } " variant="flat"
                            prepend-icon="mdi-eye" style="height: 50px;" > <span class="text-capitalize text-body-1 "  >Account</span></v-btn>
                    </div>
                    <div class="px-2 py-2">
                        <v-btn to="/user/settings/security" class="buttonBorder text-capitalize" variant="flat"
                        :class="{ 'bg-primary': this.$route.params.id == 'security' }"
                            prepend-icon="mdi-lock" style="height: 50px;"> <span class="text-capitalize text-body-1 "  >Security</span></v-btn>
                    </div>
                    <div class="px-2 py-2">
                        <v-btn to="/user/settings/billing" class="text-capitalize" variant="flat" 
                        :class="{ 'bg-primary': this.$route.params.id == 'billing' }"
                        prepend-icon="mdi-card-text" style="height: 50px;"><span class="text-capitalize text-body-1 "  >Billing </span>
                            & Plans</v-btn>
                    </div>
                    <!-- <div class="px-2 py-2">
                        <v-btn to="/user/settings/notification" class="text-capitalize" variant="flat"
                        :class="{ 'bg-primary': this.$route.params.id == 'notification' }"
                            prepend-icon="mdi-bell">Notifications</v-btn>
                    </div> -->
                </div>
            </v-col>
        </v-row>
    </v-container>

    <v-container max-width="1300px" fluid>
        <v-row>
             <component :is="currentComponent" />
        </v-row>
    </v-container>
</template>

<script>

import profile from "./profile.vue";
import security from "./security.vue";
import billing from "./billing.vue";
import notification from "./notification.vue";


export default {
    components: {
        profile,
        security,
        billing,
        notification
    },
    data() {
        return {
            activeTab: this.$route.params.id,
        };
    },
    watch: {
        '$route.params.id'(newVal) {
            this.activeTab = newVal;
        }
    },
    computed: {
        currentComponent() {
            switch (this.activeTab) {
                case "profile":
                    return profile
                case "security":
                    return security
                case "billing":
                    return billing;
                case "notification":
                    return notification
                default:
                    return profile
            }
        },
    },
};
</script>

<style scoped>
    .buttonBorder{
    border-radius: 2px;
}

</style>