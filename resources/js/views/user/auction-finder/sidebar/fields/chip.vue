<template>
  <div class="d-flex flex-wrap ">
    <span
      v-for="item in myData"
      :key="item.id"
      class="text-center"
    >
      <v-chip
        class=" ma-3 pa-4  "
        style="border: 1px solid rgb(var(--v-theme-primary));"
        size="x-small"
      >
      <span class="text-body-2 mt-1">  {{ item.label }}</span>
        <v-icon
          @click="removeValue(removeKey, item.id)"
          icon="mdi-close"
          
          class="crossIcon"
          end
          style="margin-left: 12px;"
        />
      </v-chip>
    </span>
  </div>
</template>


<script>

export default {
    props: {
        data: {
            type: Array,
            default: () => [],
            required: true,
        },
        compareValue: {
            type: Array,
            default: () => [],
            required: true,
        },
        removeKey: {
            type: String,
        }, 
        removeValue: {
            type: Function,
        },  
    },
    data() {
        return {
        }
    },
    methods: {
      
    },
    computed: {
        myData() {

            return this.data.map((item) => {
               
                return {
                    label:item.label,
                    id: item?.id ?  item.id:item.label
                }

            }).filter((item) => {
                if (this.compareValue.includes(item.id)) {
                    return true;
                }
            })

        },
    },
};

</script>

<style scoped>
    .crossIcon{
        color: rgb(var(--v-theme-danger));
        padding: 8px ;
        border-radius: 30px;
  
    }
    .crossIcon:hover{
        background-color: rgb(var(--v-theme-dangerlite));
        color: white;
    }
</style>