<li class="nav-item">
    <a class="nav-link hide-arrow btn btn-icon btn-text-secondary rounded-pill" id="btn-fullscreen"
        href="javascript:void(0);">
        <i class="icon-base ti tabler-arrows-maximize icon-22px text-heading" id="fullscreen-icon"></i>
        <span class="d-none ms-2">Toggle Fullscreen</span>
    </a>
</li>

<script>
    const fullscreenBtn = document.getElementById('btn-fullscreen');
    const fullscreenIcon = document.getElementById('fullscreen-icon');

    fullscreenBtn.addEventListener('click', async () => {
        if (!document.fullscreenElement) {
            try {
                await document.documentElement.requestFullscreen();
                fullscreenIcon.classList.replace('tabler-arrows-maximize', 'tabler-arrows-minimize');
            } catch (err) {
                console.error('Error attempting to enter fullscreen:', err);
            }
        } else {
            await document.exitFullscreen();
            fullscreenIcon.classList.replace('tabler-arrows-minimize', 'tabler-arrows-maximize');
        }
    });

    // Optional: update icon if user exits fullscreen via ESC
    document.addEventListener('fullscreenchange', () => {
        if (!document.fullscreenElement) {
            fullscreenIcon.classList.replace('tabler-arrows-minimize', 'tabler-arrows-maximize');
        }
    });
</script>
