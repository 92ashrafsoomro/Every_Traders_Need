<template>
    <v-container fluid  max-width="1400px">

        <div class="mt-16 mx-auto content d-flex w-100 ga-12">

            <div class="position-sticky d-none d-md-block"  style="min-width: 200px; top: 120px; align-self: flex-start;">
                <sidebar/>
            </div>

            <div class="flex-grow-1 mt-10">
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mb-10">Frequently Asked Questions</h1>
                    <p class="mb-5">What is Autoboli?</p>
                    <p class="my-5 text-body-1">Autoboli is an auction insights platform designed for car dealers and traders. It helps you track live auctions, compare vehicle valuations, and identify reauction vehicles before you bid.</p>

                    <!-- <p class="my-5 text-body-1">This Privacy Policy relates to information collected by Mango
                        Technologies, Inc.
                        DBA ClickUp (referred to in this Privacy Policy as "ClickUp" "we" or "us" or "our") through
                        your use of our website and our Services, features, browser extensions, integrations, API,
                        mobile or desktop applications, information available on our website or app, or when you
                        otherwise interact with us (which are collectively referred to in this Privacy Policy as the
                        "ClickUp Service").</p>

                    <p class="font-weight-bold text-body-1">
                        If you do not agree to our use of your personal data in line with this policy, please do not
                        use the ClickUp Services.
                    </p> -->
                </div>

                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">Who is Autoboli for?</h1>
                    <p class="my-5 text-body-1">Autoboli is built for independent dealers, trade buyers, and high-volume vehicle traders who want better data before making auction purchases.</p>
                    <!-- <ul>
                        <li class="text-body-1 my-5"> <span class="font-weight-bold">Your use of the Services:</span>
                            We keep track of certain information about you when you visit and interact with any of our
                            Services. This information includes the features you use; the tasks, projects, teams and
                            other
                            links you click on; the type, size and filenames of attachments you upload to the Services;
                            frequently used search terms; and how you interact with others on the Services. We also
                            collect
                            information about the teams and people you work with and how you interact with them, like
                            who
                            you collaborate and communicate with most frequently.
                        </li>
                        <li class="text-body-1 my-5"> <span class="font-weight-bold">Device and Connection
                                Information:</span>
                            We collect information about your computer, phone, tablet, or other devices you use to
                            access the Services. This device information includes your connection type and settings when
                            you install, access, update, or use our Services. We also collect information through your
                            device about your operating system, browser type, IP address, URLs of referring/exit pages,
                            device identifiers, and crash data. We use your IP address and/or country preference in
                            order to approximate your location to provide you with a better Service experience. How much
                            of this information we collect depends on the type and settings of the device you use to
                            access the Services.
                        </li>
                    </ul> -->
                </div>
                
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">What auction data do I get access to?</h1>
                    <p class="my-5 text-body-1">You can access live auctions, completed and remaining lots, reauction data, vehicle details, inspection summaries, and valuation comparisons including CAP and AutoTrader values (depending on your plan).</p>
                </div>
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">What is the Reauction Tracker?</h1>
                    <p class="my-5 text-body-1">The Reauction Tracker identifies vehicles that return to auction. You can review past sale attempts and compare previous prices to avoid overpaying.</p>
                </div>
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">Can I compare vehicle values before bidding?</h1>
                    <p class="my-5 text-body-1">Yes. Autoboli allows you to compare CAP, trade, and retail values side by side so you understand true market value before placing a bid.</p>
                </div>
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">Is there a free trial?</h1>
                    <p class="my-5 text-body-1">Yes. You can start with a trial plan to explore key features before upgrading to a paid subscription.</p>
                </div>
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">Can I upgrade or cancel anytime?</h1>
                    <p class="my-5 text-body-1">You can upgrade your plan at any time. Subscription management is simple and flexible from your account settings.</p>
                </div>
                <div>
                    <h1 class="text-h6 text-lg-h4  text-md-h5 font-weight-bold mt-12 mb-10">How do I get support?</h1>
                    <p class="my-5 text-body-1">                        You can access live auctions, completed and remaining lots, reauction data, vehicle details, inspection summaries, and valuation comparisons including CAP and AutoTrader values (depending on your plan).</p>
                </div>

            </div>



        </div>
    </v-container>
</template>


<script>
import Sidebar from './Sidebar.vue';

export default {
    components : {
        Sidebar
    }
}
</script>