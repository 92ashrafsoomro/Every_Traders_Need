<template>
  
        <v-card class="pa-4 text-center">
            <v-icon size="48" color="primary">mdi-lock-outline</v-icon>

            <v-card-title class="mt-2">
                Upgrade Required
            </v-card-title>

            <v-card-text class="text-body-2">
                {{ upgradeMessage }}
            </v-card-text>

            <v-card-actions class="justify-center mt-4">
                <v-btn color="primary" to="/user/settings/billing">
                    Upgrade Plan
                </v-btn>

                <v-btn variant="text" @click="$router.back()">
                    Go Back
                </v-btn>
            </v-card-actions>
        </v-card>

</template>

<script>
import { useUserStore } from "@/stores/userStore";
export default {
    name : 'Restriction',
    data(){
      return{
          userStore:useUserStore()
      }
    },
    computed:{
   
    }
}
</script>