<template>
  <v-container fluid max-width="1400px">
    <div class="mt-16 mx-auto content d-flex w-100 ga-12">
      <!-- Sidebar -->
      <div
        class="position-sticky d-none d-md-block"
        style="min-width: 200px; top: 120px; align-self: flex-start;"
      >
        <Sidebar />
      </div>

      <!-- Content -->
      <div class="flex-grow-1 mt-10">
        <!-- Title -->
        <div>
          <h1 class="text-h6 text-lg-h4 text-md-h5 font-weight-bold mb-4">
            Disclaimer
          </h1>
          <p class="mb-6">Last Updated: [Insert Date]</p>
        </div>

        <!-- 1. General Information -->
        <div>
          <h2 class="text-h6 font-weight-bold mb-3">1. General Information</h2>
          <p class="text-body-1 mb-4">
            The information provided by
            <strong>:contentReference[oaicite:0]{index=0}</strong>
            (“we”, “our”, “us”) on this website and platform is for general
            informational and business purposes only.
          </p>
          <p class="text-body-1 mb-4">
            While we aim to provide accurate and up-to-date auction and vehicle
            data, we make no guarantees regarding completeness, reliability, or
            accuracy.
          </p>
          <p class="text-body-1 font-weight-bold">
            Your use of the platform and reliance on any information is strictly
            at your own risk.
          </p>
        </div>

        <!-- 2. No Financial or Legal Advice -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            2. No Financial or Legal Advice
          </h2>
          <p class="text-body-1 mb-3">
            Autoboli provides auction insights, valuation comparisons, and
            vehicle data tools. We do not:
          </p>
          <ul class="ml-6">
            <li>Provide financial advice</li>
            <li>Provide investment advice</li>
            <li>Provide legal advice</li>
            <li>Guarantee profitability</li>
          </ul>
          <p class="text-body-1 mt-3">
            Any purchasing or bidding decisions made based on our data are your
            sole responsibility.
          </p>
        </div>

        <!-- 3. Auction & Vehicle Data Accuracy -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            3. Auction & Vehicle Data Accuracy
          </h2>
          <p class="text-body-1 mb-3">
            Auction listings, vehicle details, valuations (including CAP, trade,
            and retail values), and historical sale information are sourced from
            third-party providers and market data.
          </p>
          <p class="text-body-1 mb-3">We do not guarantee:</p>
          <ul class="ml-6">
            <li>That data is error-free</li>
            <li>That vehicles are accurately described</li>
            <li>That previous auction results reflect future outcomes</li>
            <li>That valuations reflect real-time market conditions</li>
          </ul>
          <p class="text-body-1 mt-3">
            Market prices may fluctuate rapidly.
          </p>
        </div>

        <!-- 4. No Guarantee of Results -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            4. No Guarantee of Results
          </h2>
          <p class="text-body-1 mb-3">
            Autoboli does not guarantee:
          </p>
          <ul class="ml-6">
            <li>Auction success</li>
            <li>Profit margins</li>
            <li>Vehicle resale value</li>
            <li>Bid acceptance</li>
          </ul>
          <p class="text-body-1 mt-3 font-weight-bold">
            All trading activity involves risk.
          </p>
        </div>

        <!-- 5. Third-Party Links & Services -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            5. Third-Party Links & Services
          </h2>
          <p class="text-body-1 mb-3">
            Our platform may include links to third-party websites, auction
            houses, or service providers. We are not responsible for:
          </p>
          <ul class="ml-6">
            <li>Third-party content</li>
            <li>External website policies</li>
            <li>Auction house terms</li>
            <li>Third-party errors or omissions</li>
          </ul>
          <p class="text-body-1 mt-3">
            You access third-party services at your own risk.
          </p>
        </div>

        <!-- 6. Platform Availability -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            6. Platform Availability
          </h2>
          <p class="text-body-1 mb-3">
            We aim to provide reliable service, but we do not guarantee
            uninterrupted access.
          </p>
          <p class="text-body-1 mb-3">We are not liable for:</p>
          <ul class="ml-6">
            <li>Temporary downtime</li>
            <li>Technical errors</li>
            <li>Data delays</li>
            <li>Service interruptions</li>
          </ul>
          <p class="text-body-1 mt-3">
            We may update or modify features without prior notice.
          </p>
        </div>

        <!-- 7. Limitation of Liability -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            7. Limitation of Liability
          </h2>
          <p class="text-body-1 mb-3">
            To the fullest extent permitted by law, Autoboli shall not be liable
            for:
          </p>
          <ul class="ml-6">
            <li>Indirect or consequential losses</li>
            <li>Loss of profits</li>
            <li>Loss of business opportunities</li>
            <li>Decisions made based on platform data</li>
          </ul>
          <p class="text-body-1 mt-3 font-weight-bold">
            Your use of the platform is at your own risk.
          </p>
        </div>

        <!-- 8. Professional Responsibility -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            8. Professional Responsibility
          </h2>
          <p class="text-body-1 mb-3">
            You are responsible for conducting your own:
          </p>
          <ul class="ml-6">
            <li>Due diligence</li>
            <li>Vehicle inspections</li>
            <li>Market research</li>
            <li>Financial assessments</li>
          </ul>
          <p class="text-body-1 mt-3">
            Autoboli tools are intended to support decision-making, not replace
            professional judgment.
          </p>
        </div>

        <!-- 9. Changes -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">
            9. Changes to This Disclaimer
          </h2>
          <p class="text-body-1">
            We may update this Disclaimer at any time. Continued use of the
            platform after updates constitutes acceptance of the revised terms.
          </p>
        </div>

        <!-- 10. Contact -->
        <div class="mt-10">
          <h2 class="text-h6 font-weight-bold mb-4">10. Contact Us</h2>
          <p class="text-body-1">
            Company Name: Autoboli <br />
            Email: [Insert Support Email] <br />
            Address: [Insert Business Address]
          </p>
        </div>
      </div>
    </div>
  </v-container>
</template>

<script>
import Sidebar from "./Sidebar.vue";

export default {
  components: {
    Sidebar,
  },
};
</script>
