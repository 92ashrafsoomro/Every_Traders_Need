<template>
    <user-title-bar title="Auction Schedule" >
        <div>
            <v-btn variant="text" style="border-bottom: 2px solid rgb(var(--v-theme-primary));">
                All
            </v-btn>
            <v-btn variant="text " class="text-text_light ">
                Inprogress
            </v-btn>
        </div>
        <div class="d-flex align-center ga-8 mt-5 flex-wrap">
            <div class="d-flex align-center " style="width: 250px; ">
                <p class="mr-3 text-text_light">Plateform:</p>
              <PlateformDropdown  v-model="dropdown" variant="outlined" density="compact"/>
            </div>
            <div class="d-flex align-center " style="width:250px;">
                <p class="mr-3 text-text_light">Center:</p>
                <CenterDropdown v-model="center"  variant="outlined" density="compact"/>
                 
            </div>
        </div>
        <div class="d-flex flex-wrap justify-center w-100 ga-3 mt-5">


            <div class="bg-primary h-50  pa-2 rounded-sm" style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>

            
            <div class="auctionSchdulerCard h-50 pa-2 rounded-sm" style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>


            
            <div class="auctionSchdulerCard h-50 pa-2 rounded-sm"style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>


            
            <div class="auctionSchdulerCard h-50 pa-2 rounded-sm"style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>


            
            <div class="auctionSchdulerCard h-50 pa-2 rounded-sm" style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>


            
            <div class="auctionSchdulerCard h-50  pa-2 rounded-sm" style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>


            
            <div class="auctionSchdulerCard h-50  pa-2 rounded-sm" style="width: 180px;">

                <div class="d-flex justify-center pa-1 " style="border-bottom:  1px solid gray;">
                    <p class="" style="font-size: 20px;">Today</p>
                </div>

                <div class="d-flex justify-space-between pa-1">
                    <p>6</p>
                    <p>6541</p>
                </div>
            </div>
        </div>
    </user-title-bar>

    
    <div class="w-100 h-auto d-flex justify-center">
      <div class="mt-10 mb-10 w-75 " > 
     <v-table fixed-header class="rounded-lg">
    <thead>
      <tr>
           <th class="text-left text-subtitle-1">
                Platfrom
            </th>

            <th  class="text-left text-subtitle-1">
                Center
            </th>

            <th class="text-left text-subtitle-1">
                Total Vahicls
            </th>

            <th class="text-left text-subtitle-1">
                time
            </th>

            <th class="text-left text-subtitle-1">
                Status
            </th>
            <th class="text-left text-subtitle-1">
                Action
            </th>
      </tr>
    </thead>
    <tbody>

      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham, Bristol, Thurleigh </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
            <td>
                <div class="rounded h-50 bg-danger d-flex justify-center align-center" style="width:100px ;">
                In Progress
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
             <td><div class="rounded h-50 bg-warning d-flex justify-center align-center" style="width:100px ;">
                Cancel
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
            <td><div class="rounded h-50 bg-danger d-flex justify-center align-center" style="width:100px ;">
                In Progress
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
            <td><div class="rounded h-50 bg-primary d-flex justify-center align-center" style="width:100px ;">
                Planned
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
            <td><div class="rounded h-50 bg-danger d-flex justify-center align-center" style="width:100px ;">
                In Progress
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
            <td><div class="rounded h-50 bg-danger d-flex justify-center align-center" style="width:100px ;">
                In Progress
                </div></td>
            <td>View/Alert/</td>
      </tr>

             
      <tr >
        <td>
            <p class="text-primary" >BCA</p>
        </td>
            <td>Birmingham </td>
            <td>225</td>
            <td>14/8/2025_10:00</td>
             <td><div class="rounded h-50 bg-warning d-flex justify-center align-center " style="width:100px ;">
                Cancel
                </div></td>    
            <td>View/Alert/</td>
      </tr>     
    </tbody>
  </v-table>
</div> 
</div>
    <div style="max-width: 1400px;" class="mx-auto">
       
        
        
</div>
</template>

<script>


import CenterDropdown from '@/components/CenterDropdown.vue';
import PlateformDropdown from '@/components/PlateformDropdown.vue';

export default {
    name: "auctionsolution",
    components: {
        CenterDropdown,
        PlateformDropdown
   
    },
    data() {
        return {
            center:null,
            dropdown:null

          }
}
}

</script>
<style scoped>
    .auctionSchdulerCard {
  background-color: rgb(var(--v-theme-border));
  transition: background-color 0.2s ease;
}

.auctionSchdulerCard:hover {
  background-color: rgb(var(--v-theme-primary));
}
</style>