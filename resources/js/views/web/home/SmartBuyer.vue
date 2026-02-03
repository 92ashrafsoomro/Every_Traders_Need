<template>
    <div class="mx-auto  d-flex align-center mt-lg-0 mt-16" style="max-width: 1400px;min-height: 800px; ">
      <div>
          <div class="text-center">

            <h2 class="text-lg-h3 text-md-h3 text-h4  font-weight-bold"> Why smart dealers start with Autoboli</h2>
            <p class="d-flex w-lg-75 w-md-75 w-100    mx-auto text-lg-h6 pa-4" style="font-weight: 400; ">Autoboli gives you the
                clarity you need to decide what’s worth bidding on, what’s worth avoiding, and what delivers real margin
                — before the auction hammer falls.</p>
        </div>
        <div class="d-flex w-100 flex-column flex-md-row flex-lg-row
         ga-4 mt-10
         align-center align-md-start"
         >

            <div v-for="(item, i) in smartData" :key="i" cols="12" md="4" class="h-75 w-lg-75 w-100 text-center">
                <div rounded="xl" class="pa-8">
                    <!-- ICON -->
                     <div class="mb-6 d-flex align-center justify-center mx-auto" style="width:100px; height:100px;">
                            <img :src="item.icon" alt="icon" style="max-width:100%;"/>
                        </div>
                  


                    <!-- TITLE -->
                    <h4 class="text-h6 font-weight-bold mb-">
                        {{ item.title }}
                    </h4>

                    <!-- DESCRIPTION -->
                   
                    <p class="text-body-2 text-medium-emphasis ">
                        {{ item.description }}
                    </p>
                </div>

            </div>

        </div>
      </div>
    </div>
</template>

<script>
import image1 from "@/assets/images/icons/Asset 9.png"
import image2 from "@/assets/images/icons/Asset 10.png"
import image3 from "@/assets/images/icons/Asset 7.png"
export default {
    data() {
        return {
            smartData: [
                {
                    title: "  Avoid costly auction mistakes",
                    description: "Spot reauctions, unsold vehicles, and risk signals early. Autoboli helps you walk away from stock that looks cheap today — but costs thousands later.",
                    icon:image1, 
                },
                {
                    title: "Find the right vehicles faster",
                    description: "Stop wasting time on poor-quality lots. Filter auctions, compare valuations instantly, and focus only on vehicles that truly fit your buying strategy.",
                     icon:image2, 
                },
                {
                    title: "  Know more. Buy better.",
                    description: "See CAP, AutoTrader, trade, and retail values alongside auction history. When you know more than the competition, you bid with confidence — not emotion.",
                     icon:image3,
                }]
        }
    }
}

</script>