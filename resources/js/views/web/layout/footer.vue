<template>
    <v-container>
        <h1>AUTOBOLI Ltd</h1>
        <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Accusantium mollitia alias perferendis maxime
            voluptatum veritatis, aspernatur ab soluta debitis modi eveniet, similique esse quia laborum omnis illum
            ipsa molestias consequatur!</p>
            <v-btn v-for="(item, index) in footerAutoboli" :key="index" :to="item.path" variant="outlined">
                {{ item.label }}
            </v-btn>

        <v-container></v-container>
        <v-container></v-container>
        <v-container></v-container>
        <hr>
        <p>&copy; AUTOBOLI Ltd 2025. All rights reserved.</p>
        <p>Proudly built & hosted with secure infrastructure in the UK & EU.</p>
    </v-container>

</template>

<script>
import { getFooterAutoBoli , getConnect , getLearn , getResources } from '@/services/footerServices';
export default {
    name: "Footer"
}
const footerAutoboli = getFooterAutoBoli()
const footerConnect = getConnect()
const footerLearn = getLearn()
const resources = getResources()
</script>