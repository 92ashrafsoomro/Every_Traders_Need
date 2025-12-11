<template>

    <div>
            <v-text-field 
            v-bind="$attrs" 
            v-if="feild === 'text'"
            />

            <v-text-field 
            v-bind="$attrs"
            v-if="feild === 'file'"
            />
    </div>

</template>

<script>
    export default {
        props :{
            feild:{
                default : "text"
            }
        },
        methods:{

        }
    }
</script>