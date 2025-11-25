<template>
     <v-card :class="['bg-surface', 'border', 'card', this.class ]">
        <div v-if="title || $slots.toolbar" class="card-header d-flex justify-space-between" >
            <div v-if="title" >
                   <h3 v-if="title" class="card-title text-h5">{{ title }}</h3>
                    <p v-if="subtitle" class="text-body-1 subtitle">{{ subtitle }}</p>
            </div> 
         
             <slot name="toolbar"/>
        </div>
        <div class="card-body">
            <slot></slot>
        </div>

        <div v-if="$slots.footer" class="card-footer">
            <slot name="footer"/>
        </div>
     </v-card>
</template>

<script>

export default {
    props: {
        class: {
          type:String,
          default: "",
        },
        title: {
          type:String,
          default: "",
        },
        subtitle: {
          type:String,
          default: "",
        },
    },
    data() {
        return {

        }
    },
    computed: {

    },
    methods: {

    }
};

</script>

<style scoped >

.card-header{
    padding: 24px 24px;
    border-bottom: 1px solid rgb(var(--v-theme-border));
}

.card-footer{
 padding: 24px 24px;
    border-top: 1px solid rgb(var(--v-theme-border));
}

.card-title{

}

.subtitle{
    color:rgb(var(--v-theme-light))
}


</style>
