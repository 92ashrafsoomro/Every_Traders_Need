<template>
       <v-dialog
        @update:model-value="onChange($event)"
        :model-value="dailog"
        width="600px"
        >
            <v-card
                prepend-icon="mdi-update"
                title="Vehicle Type"
            >
            <v-card-text>
                
            </v-card-text>
            </v-card>
        </v-dialog>

</template>


<script>

export default {
    props: {
        dailog: {
            type: Boolean,
            default:false,
        },
        onChange: {
            type: Function,
            default: () => {}
        }
    },
    watch: {
        dailog(newVal) {     
            if (newVal) {
                this.onLoad();
            } else {
                this.onClose();
            }
        
        },
    },
    emits: ['update:dailog'],
    data() {
        return {
          
         
        }

    },
    mounted() {
        console.log('Event Loaded....');
        
    },
    methods: {
        onLoad() {
        
        },
        onClose() {
            
        }
    }




}


</script>