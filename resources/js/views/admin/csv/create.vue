<template>
    <v-container max-width="1400px" class="m-auto">
        <v-card title="Create Auction" >
            <v-card-text>
                <v-row>
                    <v-col cols="12" sm="4">  
                          <v-text-field 
                            v-model="form.table_id" 
                            variant="outlined" 
                            label="ID"
                            base-color="white" 
                            color="primary"
                            density="compact" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4">
                          <v-text-field 
                            v-model="form.name" 
                            variant="outlined" 
                            label="Name"
                            base-color="white" 
                            color="primary"
                            density="compact" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4">
                          <v-select 
                            v-model="form.auction_type" 
                            variant="outlined" 
                            label="Auction Type"
                            :items="['Online','Live']"
                            base-color="white"
                            density="compact" 
                            color="primary"  
                                />
                    </v-col>
                    <v-col cols="12" sm="4" >
                          <v-text-field 
                            v-model="form.auction_date" 
                            variant="outlined" 
                            label="Auction Date"
                            type="date"
                            density="compact"
                            base-color="white" 
                            color="primary"  
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4" >
                          <v-text-field 
                            v-model="form.end_date" 
                            variant="outlined" 
                            label="End Date"
                            type="date"
                            density="compact"
                            base-color="white" 
                            color="primary" 
                            clearable />
                    </v-col>
                    <v-col cols="12" sm="4" >
                        <PlateformDropdown 
                            v-model="form.platform_id"
                            label="Auction House"
                            variant="outlined" 
                            base-color="white"
                            density="compact" 
                            />
                    </v-col>
                </v-row>
            </v-card-text>

        </v-card>
    </v-container>
</template>

<script>
import PlateformDropdown from '@/components/PlateformDropdown.vue';


export default {

    components:{PlateformDropdown},
    data() {

        return {
            form: {
                name: '',
                auction_date: '',
                table_id: '',
                end_date: '',
                auction_type:'Online',
                platform_id: '',
                status: '',
            }
        }

    }
    
}

</script>