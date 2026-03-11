<template>
    <v-container fluid class="pa-0 mt-12" style="padding: 0 !important;">

        <div class="mb-12 rounded-lg py-10 px-0" style="background-color: rgb(var(--v-theme-surface));">
            <div class="mx-auto d-flex flex-wrap align-center justify-space-between"
                style="max-width:1400px; gap:40px;">

                <div style="flex:1; min-width:300px;">
                    <h4 class="text-h5 font-weight-bold mb-6">
                        {{ data.title }}
                    </h4>

                    <div class="text-body-1 mb-6 text-light_text_on" style="line-height:1.9;" v-html="data.description">
                        
                    </div>

                    <v-chip style="background-color: rgb(var(--v-theme-primary));" class="text-body-1">
                        Updated: {{ data.date }} • 12 min read
                    </v-chip>
                </div>

                <div class="text-center" style="flex:1; min-width:300px;">
                    <v-img
                        :src="data.image_preview"
                        alt="Smartphones 2026" class="rounded-lg elevation-6 mx-auto" max-width="520" />
                </div>

            </div>
        </div>
        <v-container fluid class="pa-0 mt-12">
            <v-container style="max-width:1400px;">
                <div class="d-flex" style="gap:40px; align-items:flex-start; position:relative;">

                    <!-- LEFT ARTICLE -->
                    <div style="flex:1; min-width:700px;">
                        <section v-for="section in sections" :key="section.id" :id="section.id" class="mb-12">
                            <h2 class="text-h5 font-weight-bold mb-4">{{ section.title }}</h2>
                            <div v-for="(block, i) in section.blocks" :key="i">
                                <p v-if="block.type === 'paragraph'" class="mb-3">{{ block.text }}</p>
                                <ul v-if="block.type === 'list'" class="mb-3 pl-6" style="list-style: none;">
                                    <li v-for="(item, idx) in block.items" :key="idx"> <v-icon color="primary"
                                            class="mr-2" small>mdi-check-circle</v-icon> {{ item }}</li>
                                </ul>
                                <ol v-if="block.type === 'list' && block.style === 'number'" class="mb-3 pl-6">
                                    <li v-for="(item, idx) in block.items" :key="idx">{{ item }}</li>
                                </ol>
                                <table v-if="block.type === 'table'" class="mb-3  w-full border">
                                    <thead class="bg-gray-200 border">
                                        <tr>
                                            <th v-for="header in block.headers" :key="header" class=" px-3 py-1">
                                                {{ header }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(row, idx) in block.rows" :key="idx">
                                            <td v-for="cell in row" :key="cell" class=" px-3 py-1">{{ cell }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                    </div>

                    <!-- RIGHT SIDEBAR -->
                    <div style="width:400px; position:sticky; top:60px;">
                        <div>
                            <h4 class="mb-4">SHARE THIS POST</h4>
                            <div class="d-flex  mb-6">
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-facebook</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-whatsapp</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-twitter</v-icon>
                                <v-icon class="rounded-xl pa-4 bg-primary text-white">mdi-instagram</v-icon>
                            </div>

                            <v-expansion-panels class="bg-transparent elevation-0">
                                <v-expansion-panel class="bg-transparent elevation-0">
                                    <v-expansion-panel-title ripple="false">
                                        <h3>Content</h3>
                                    </v-expansion-panel-title>
                                    <v-expansion-panel-text>
                                        <div v-for="section in sections" :key="section.id" @click="scrollTo(section.id)"
                                        class="hoverElement"
                                            :class="activeSection === section.id ? 'text-primary font-weight-bold cursor-pointer mb-2' : 'text-disabled cursor-pointer mb-2'">
                                            {{ section.title }}
                                        </div>
                                    </v-expansion-panel-text>
                                </v-expansion-panel>
                            </v-expansion-panels>
                        </div>
                    </div>

                </div>
            </v-container>
        </v-container>
    </v-container>
</template>

<script>
import General from '@/models/general.model';
export default {

    data() {
        return {
            activeSection: null,
            data : [],
            sections: [
                {
                    id: "intro",
                    title: "Introduction",
                    blocks: [
                        { type: "paragraph", text: "Vehicle auctions are one of the most important sourcing channels for used car dealers. Every week, thousands of vehicles pass through auction houses across the UK, offering dealers opportunities to buy stock below retail market value." },
                        { type: "paragraph", text: "But successful dealers don’t just attend auctions and hope for bargains. They rely on data, market knowledge, and smart buying strategies to identify vehicles that can generate strong profit margins." },
                        { type: "paragraph", text: "Understanding how car dealers actually make money from vehicle auctions can help both new and experienced traders improve their buying strategy and avoid costly mistakes. In this guide, we’ll explain how dealers generate profit at auctions, what strategies they use, and how tools like Autoboli help them make smarter purchasing decisions." }
                    ]
                },
                {
                    id: "challenge",
                    title: "The Common Challenge Dealers Face at Auctions",
                    blocks: [
                        { type: "paragraph", text: "Vehicle auctions move fast. Dealers often have just seconds to make a bidding decision. Without proper data and preparation, traders can easily face several risks:" },
                        {
                            type: "list", items: [
                                "Overpaying for vehicles",
                                "Buying cars with low retail demand",
                                "Misjudging true market value",
                                "Purchasing vehicles that need expensive repairs",
                                "Competing in aggressive bidding wars"
                            ]
                        },
                        { type: "paragraph", text: "Many new traders assume auctions automatically mean cheap cars. In reality, prices can quickly climb close to retail value if demand is high. Successful dealers avoid these problems by focusing on margin opportunities, data analysis, and disciplined buying strategies." }
                    ]
                },
                {
                    id: "profit-model",
                    title: "Understanding the Dealer Profit Model",
                    blocks: [
                        { type: "paragraph", text: "Car dealers typically make money from auctions through the price difference between purchase cost and retail sale price. This difference is known as the dealer margin." },
                        { type: "paragraph", text: "Total vehicle cost includes:" },
                        {
                            type: "list", items: [
                                "Auction purchase price",
                                "Auction fees",
                                "Transport costs",
                                "Preparation and repair costs",
                                "Advertising costs",
                                "Warranty costs"
                            ]
                        },
                        { type: "paragraph", text: "Only after all these expenses are considered can a dealer see the true profit margin." },
                        { type: "paragraph", text: "Example Dealer Profit Scenario:" },
                        {
                            type: "table", headers: ["Item", "Amount"], rows: [
                                ["Auction purchase price", "£6,200"],
                                ["Auction fees", "£350"],
                                ["Transport", "£150"],
                                ["Repairs & prep", "£500"],
                                ["Total vehicle cost", "£7,200"],
                                ["Retail sale price", "£8,495"],
                                ["Dealer profit", "£1,295"]
                            ]
                        },
                        { type: "paragraph", text: "This is a typical profit range for many used car dealers. However, not every vehicle produces the same margin. The key is finding vehicles with strong resale demand and realistic pricing gaps." }
                    ]
                },
                {
                    id: "profit-opportunities",
                    title: "Where the Best Auction Profit Opportunities Come From",
                    blocks: [
                        { type: "paragraph", text: "Experienced traders know that not all auction vehicles offer the same profit potential. Some vehicles consistently provide better margins." },
                        {
                            type: "list", style: "number", items: [
                                "Fleet and Lease Returns: Predictable maintenance history, good condition, popular specifications, strong resale demand. Commonly sold by leasing companies.",
                                "Part-Exchange Vehicles: Lower competition, slightly undervalued vehicles, quick resale potential. Inspection and data checks are essential.",
                                "Reauction Vehicles: Previously failed to sell, sellers may lower reserve prices, pricing expectations adjusted.",
                                "Older but High-Demand Vehicles: Small hatchbacks, reliable Japanese models, affordable family cars, low insurance group vehicles. Sell quickly on retail platforms."
                            ]
                        }
                    ]
                },
                {
                    id: "market-data",
                    title: "The Role of Market Data in Auction Profitability",
                    blocks: [
                        { type: "paragraph", text: "One of the biggest mistakes dealers make is relying purely on instinct when bidding. Modern vehicle trading is increasingly data-driven." },
                        { type: "paragraph", text: "Dealers now use multiple valuation sources to estimate vehicle value before bidding:" },
                        {
                            type: "list", items: [
                                "CAP Clean value",
                                "CAP Average value",
                                "AutoTrader Trade Value",
                                "AutoTrader Retail Value"
                            ]
                        },
                        { type: "paragraph", text: "Auction price history provides a more realistic picture of what similar vehicles actually sell for." }
                    ]
                },
                {
                    id: "tips",
                    title: "Practical Tips for Making Money at Vehicle Auctions",
                    blocks: [
                        {
                            type: "list", style: "number", items: [
                                "Set a Maximum Bid Before the Auction: Calculate expected retail price, total costs, and minimum profit margin, then stick to it.",
                                "Focus on High-Demand Models: Small city cars, reliable Japanese brands, diesel estate cars for fleets, affordable SUVs.",
                                "Avoid Unusual Specifications: Neutral colours, standard trim levels, automatic gearboxes.",
                                "Inspect Vehicles Carefully: Check bodywork, interior, service history, warning lights, tyres.",
                                "Track Reauction History: Vehicles that failed to sell previously may have reduced reserve prices."
                            ]
                        }
                    ]
                },
                {
                    id: "autoboli",
                    title: "How Autoboli Helps Dealers Make Smarter Auction Decisions",
                    blocks: [
                        { type: "paragraph", text: "Autoboli is designed specifically to help dealers identify profitable auction vehicles using data-driven insights. Instead of guessing vehicle value, traders can rely on real market intelligence." },
                        {
                            type: "list", items: [
                                "Auction Price History: See how similar vehicles have performed across multiple auction houses.",
                                "CAP and AutoTrader Valuation Comparisons: Quickly compare CAP Clean, CAP Average, and AutoTrader values.",
                                "Reauction Tracking: Identify vehicles that have failed to sell previously.",
                                "VIN and Registration Search: Access vehicle information quickly using registration or VIN.",
                                "Auction Schedules: Stay updated with upcoming auctions across 30+ UK auction houses.",
                                "Market Insights: Understand which vehicles are currently in demand.",
                                "Benefits: Avoid overpaying, identify undervalued vehicles, improve profit margins, reduce auction risk."
                            ]
                        }
                    ]
                },
                {
                    id: "conclusion",
                    title: "Conclusion",
                    blocks: [
                        { type: "paragraph", text: "Vehicle auctions remain one of the most profitable sourcing channels for used car dealers. However, making money consistently requires more than luck." },
                        {
                            type: "list", items: [
                                "Market knowledge",
                                "Data analysis",
                                "Smart bidding strategies",
                                "Strong understanding of vehicle values"
                            ]
                        },
                        { type: "paragraph", text: "By combining experience with auction intelligence tools like Autoboli, dealers can reduce risk, identify profitable vehicles, and build a more efficient stock sourcing strategy. The dealers who win at auctions are not the ones who bid the most — they are the ones who buy the smartest." }
                    ]
                },
                {
                    id: "faq",
                    title: "FAQ Section",
                    blocks: [
                        {
                            type: "list", items: [
                                "How much profit do car dealers make from auction vehicles? Typical dealer margins range between £800 and £2,000 per vehicle, depending on the car type, preparation costs, and retail demand.",
                                "Are vehicles always cheaper at auctions? Not always. High-demand vehicles can sometimes sell close to retail price if multiple dealers compete.",
                                "What types of cars sell best for dealers? Small hatchbacks, affordable SUVs, reliable Japanese models, low mileage family cars.",
                                "Why do some vehicles appear multiple times at auction? These are reauction vehicles, meaning they failed to sell previously. Sellers may reduce reserve prices in later auctions.",
                                "Is auction data important for dealers? Yes. Auction price history helps dealers understand real market value and avoid overpaying during bidding."
                            ]
                        }
                    ]
                }
            ]
        }
    },
    mounted() {

        const observer = new IntersectionObserver(
            (entries) => {

                entries.forEach(entry => {

                    if (entry.isIntersecting) {
                        this.activeSection = entry.target.id
                    }

                })

            },
            {
                threshold: 0.4
            }
        )

        this.sections.forEach(section => {

            const el = document.getElementById(section.id)

            if (el) {
                observer.observe(el)
            }

        })

         this.load();

    },

    methods: {

        scrollTo(id) {

            document.getElementById(id).scrollIntoView({
                behavior: "smooth"
            })

        },
        async load() {

            try {
                const slug = this.$route.params.slug;
                let res = await General.get(`/api/web/getBlogdetail/${slug}`);
                this.data = res.data;
            } catch (error) {
                console.error("Dashboard load failed:", error);
            } finally {
             
            }
        },

    }

}
</script>
<style scoped>
.d-flex {
    align-items: flex-start;
    gap: 40px;
}

.d-flex>div:first-child {
    flex: 1;
}

.d-flex>div:last-child {
    width: 400px;
}
.hoverElement:hover{
    text-decoration: underline;
}
</style>