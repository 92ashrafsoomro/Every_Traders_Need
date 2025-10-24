


<style>
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .modal-content {
        background: #0A1527;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.6);
        max-width: 700px;
        width: 100%;
        overflow: hidden;
        animation: slideIn 0.3s ease-out;
        border: 1px solid rgba(135, 206, 235, 0.2);
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .modal-header {
        background: linear-gradient(135deg, #000F21, #051a33);
        color: #87CEEB;
        padding: 30px;
        text-align: center;
        border-bottom: 2px solid #87CEEB;
    }

    .modal-header h5 {
        font-size: 24px;
        font-weight: 700;
        margin: 0;
        color: #ffffff;
    }

    .modal-body {
        padding: 0;
        min-height: 400px;
    }

    .carousel {
        position: relative;
        width: 100%;
    }

    .carousel-inner {
        width: 100%;
        overflow: hidden;
    }

    .carousel-item {
        display: none;
        padding: 60px 40px;
        text-align: center;
        animation: fadeIn 0.5s ease-in;
        color: #f3f4f6;
    }

    .carousel-item.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .carousel-item h4 {
        color: #87CEEB;
        font-size: 22px;
        font-weight: 700;
        margin-bottom: 20px;
    }

    .carousel-item p {
        color: #d1d5db;
        font-size: 16px;
        line-height: 1.7;
        margin-bottom: 30px;
    }

    .carousel-item strong {
        color: #ffffff;
        font-weight: 600;
    }

    .carousel-item img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 15, 33, 0.4);
        margin: 20px 0;
        border: 1px solid rgba(135, 206, 235, 0.2);
    }

    .carousel-indicators {
        display: flex;
        justify-content: center;
        gap: 10px;
        padding: 20px 0;
        background: #0d182c;
        border-top: 1px solid rgba(135, 206, 235, 0.1);
    }

    .indicator {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: #1e293b;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .indicator.active {
        background: #87CEEB;
        width: 30px;
        border-radius: 6px;
        box-shadow: 0 0 8px #87CEEB;
    }

    .modal-footer {
        padding: 30px;
        text-align: center;
        background: #0d182c;
        border-top: 1px solid rgba(135, 206, 235, 0.1);
    }

    .btn-primary {
        background: #87CEEB;
        color: #000F21;
        border: none;
        padding: 14px 40px;
        font-size: 16px;
        font-weight: 700;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-primary:hover {
        background: #ffffff;
        color: #000F21;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(135, 206, 235, 0.4);
    }

    @media (max-width: 600px) {
        .modal-content { border-radius: 16px; }
        .modal-header { padding: 20px; }
        .modal-header h5 { font-size: 20px; }
        .carousel-item { padding: 40px 20px; }
        .carousel-item h4 { font-size: 18px; }
        .carousel-item p { font-size: 14px; }
        .btn-primary { padding: 12px 30px; font-size: 14px; }
    }
</style>

<div id="interestGuideModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h5>🚗 How to Create Your Interest</h5>
        </div>

        <div class="modal-body">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h4>Step 1: Go to "My Interests"</h4>
                        <p>From your dashboard, open the <strong>My Interests</strong> tab to start creating your first interest.</p>
                        <img src="{{ asset('public/theme/assets/guide/interest/step1.png') }}" alt="Go to My Interests">
                    </div>
                    <div class="carousel-item">
                        <h4>Step 2: Select Your Vehicle Make & Model</h4>
                        <p>Pick your preferred <strong>make</strong> and <strong>model</strong> to track related auctions and valuations.</p>
                        <img src="{{ asset('public/theme/assets/guide/interest/step2.png') }}" alt="Select Make & Model">
                    </div>
                    <div class="carousel-item">
                        <h4>Step 3: Save and Start Tracking</h4>
                        <p>Click <strong>Save</strong> and your interest will appear on your dashboard. You'll now get automatic updates!</p>
                        <img src="{{ asset('public/theme/assets/guide/interest/step3.png') }}" alt="Save Interest">
                    </div>
                </div>
            </div>



            <div class="carousel-indicators">
                <span class="indicator active" onclick="goToSlide(0)"></span>
                <span class="indicator" onclick="goToSlide(1)"></span>
                <span class="indicator" onclick="goToSlide(2)"></span>
            </div>
        </div>

        <div class="modal-footer">
            <a href="{{ url('/interest/create') }}" class="btn-primary">Create Interest</a>
        </div>
    </div>
</div>

<script>
let currentSlide = 0;

function initSlides() {
    const slides = document.querySelectorAll('.carousel-item');
    const indicators = document.querySelectorAll('.indicator');

    if (!slides.length) return;

    function showSlide(n) {
        slides.forEach(slide => slide.classList.remove('active'));
        indicators.forEach(indicator => indicator.classList.remove('active'));
        slides[n].classList.add('active');
        indicators[n].classList.add('active');
    }

    // ✅ Public function (indicator onclick se accessible)
    window.goToSlide = function (n) {
        currentSlide = n;
        showSlide(currentSlide);
    };

    function nextSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide);
    }

    function previousSlide() {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide);
    }

    // ✅ Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (e.key === 'ArrowRight') nextSlide();
        if (e.key === 'ArrowLeft') previousSlide();
    });

    // ✅ Auto slide every 5s (optional)
    setInterval(nextSlide, 5000);
}

// ✅ Initialize after DOM ready
document.addEventListener('DOMContentLoaded', initSlides);
</script>


