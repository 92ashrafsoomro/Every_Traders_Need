<style>
    .dotstats-box {
        width: 50px;
        height: 50px;
        background-color: #75797a;
        /* Dark blue box */
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 10px;
        opacity: 0.5;

    }

    .bg-primary-subtle {
        background-color: rgba(13, 110, 253, 0.1);
        /* Bootstrap blue with 10% opacity */
    }

    .dotstats {
        width: 30px;
        height: 30px;
        background-color: #000000;
        border-radius: 30%;
        box-shadow: 0 0 6px rgba(76, 77, 78, 0.6);
        box-shadow: 0 0 20px rgb(86, 89, 94), 0 0 30px rgba(96, 97, 100, 0.8);
    }

    .chart-container {
        width: 280px;
    }

    .center-label {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 28px;
        font-weight: bold;
        color: white;
    }

    /* Custom scrollbar for overall page if content overflows */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #161b22;
    }

    ::-webkit-scrollbar-thumb {
        background: #30363d;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #444c56;
    }

    /* Custom style for the Refer & Earn card background pattern */
    .refer-earn-card-bg {
        background-image: radial-gradient(#3b82f6 1px, transparent 1px);
        background-size: 20px 20px;
        opacity: 0.2;
    }



    /* Styles for active interest button */
    .interest-button.active {
        background-color: #090a0c !important;
        /* Bootstrap primary blue */
        /* border-color: #000000 !important; */
        color: white !important;
    }

    /* Ensure the scrollable wrapper has a defined height if needed, or relies on content */
    .interest-buttons-scroll-wrapper {
        white-space: nowrap;
        /* Prevent wrapping when overflow-x is auto */
        /* Add this if you want a fixed height for the scrollable area: */
        /* height: 50px; */
        /* line-height: 50px; */
        /* Adjust if needed for vertical alignment */
        align-items: center;
        /* Vertically align items in the scrollable row */
    }

    .toggle-btn {
        background: none;
        border: none;
        font-size: 1.2rem;
        cursor: pointer;
        color: red;
    }

    .info-card {
        border-radius: 8px;
        /* margin-top: 20px; */
        font-family: sans-serif;

    }

    .info-card .toggle-btn {
        transition: transform 0.4s ease;
    }

    .info-card.active .toggle-btn {
        transform: rotate(180deg);
    }

    .info-card.active {
        margin-top: 20px;
        background: #0f1c2c;
        padding-bottom: 20px;
        margin: 10px;


    }

    .toggle-btn.minus-icon::before {
        content: '+';
        font-size: var(--font-h5);

        display: inline-block;
    }

    .info-card.active .toggle-btn.minus-icon::before {
        content: '-';
        color: #ffffff !important;
    }


    .auction-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 20px;
        border-bottom: 1px solid #2d3748;
        /* Slightly lighter border */
    }

    .auction-item:last-child {
        border-bottom: none;
    }

    .auction-item .logo-text {
        display: flex;
        align-items: center;
    }

    .auction-item .logo-text img {
        height: 30px;
        /* Adjust logo size */
        margin-right: 10px;
    }

    .auction-item .price {
        font-size: var(--font-h6);
        font-weight: bold;
    }

    .auction-item .change {
        display: flex;
        align-items: center;
        font-size: 1.1rem;
        font-weight: bold;
    }

    .auction-item .change span {
        color: var(--bs-primary) !important;
        /* Green for up */

    }

    .auction-item .change.down {
        color: #dc3545;
        /* Red for down */
    }

    .chart-section {
        border-radius: 8px;
        margin: 10px;
        margin-top: 20px;
        padding: 20px;
        /* background: rgba(0, 140, 255, 0.226); */
    }



    .chart-section h5 {
        color: #a0aec0;
    }

    .chart-placeholder {
        background: rgba(0, 140, 255, 0);
        height: 200px;
        /* Placeholder height */
        margin-top: 15px;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #4a5568;
    }

    .plus-icon {
        font-size: 1.5rem;
        color: #ffffff;
        margin-left: 15px;
        cursor: pointer;
    }

    .minus-icon {
        font-size: 1.5rem;
        color: #ffffff;
        margin-left: 15px;
        cursor: pointer;
    }

    .toggle-btn {
        background: none;
        border: none;
        cursor: pointer;
        color: inherit;
    }


    .dashboard-card {
        background-color: #252836;
        border-radius: 16px;
        border: none;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        max-width: 400px;
        margin: 0 auto;
    }


    /* Ring chart */

    .Ring-chart-container {
        position: relative;
        width: 300px;
        height: 300px;
    }

    .progress-ring {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .segment {
        position: absolute;
        width: 20px;
        height: 35px;
        border-radius: 4px;
        transform-origin: 9px 140px;
    }

    .center-content {
        position: absolute;
        top: 0%;
        left: 35%;
        text-align: center;
    }


    .select2-selection {
        background: #0F1C2C !important;
        display: flex !important;
        border: 1px solid #1d2938 !important;
        overflow-y: hidden;
        height: 33px;
    }

    .select2-container--default .select2-results__option--selected {
        background: var(--bs-primary)
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background-color: transparent !important;
    }



    .vehicleStates #chart-container {
        position: relative;
        width: 360px;
        height: 360px;
    }

    .vehicleStates #center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }

    .vehicleStates #center-text h2 {
        margin: 0;
        font-size: 2rem;
    }

    .vehicleStates #center-text p {
        margin: 0;
        font-size: 1rem;
        color: #aaa;
    }

    .tab-content:not(.doc-example-content) {
        padding: 0;
    }

    .dashbord .nav-tabs .active {
        padding-bottom: 10px;
        color: white !important;
        box-shadow: none !important;
        border: none !important;

    }

    .dashbord .nav-link:hover {
        color: white !important;
    }

    .dashbord .nav-tabs:hover .active:hover {
        color: white !important;
        box-shadow: none !important;


    }

    .nav-tabs .active .borders {

        border-bottom: 3px solid var(--bs-primary) !important;
        padding-top: 0px !important;
        display: block;
        width: 53px;
        margin: auto;
        padding-top: 5px !important;
    }

    .tb-data-fonts tr td {
        font-size: var(--font-p1) !important;
    }



</style>
