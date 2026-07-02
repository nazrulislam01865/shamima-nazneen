<div class="work-modal" id="workModal" aria-hidden="true" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
    <div class="work-modal-box" role="document">
        <button class="close-modal" type="button" aria-label="Close work details">Close</button>
        <div class="modal-hero" id="modalHero">
            <span class="media-fallback film-background-fallback" id="modalHeroFallback"><?php echo e($siteSettings->image_fallback_text); ?></span>
            <div class="modal-title">
                <div class="work-meta">
                    <span class="badge dark" id="modalType">Work</span>
                    <span class="badge" id="modalYear">Year</span>
                </div>
                <h2 id="modalTitle">Work Title</h2>
            </div>
        </div>
        <div class="modal-body">
            <div class="modal-info-grid">
                <div class="modal-info"><span>Name</span><div id="infoTitle">Work Title</div></div>
                <div class="modal-info"><span>Year</span><div id="infoYear">Year</div></div>
                <div class="modal-info"><span>Type</span><div id="infoType">Work</div></div>
                <div class="modal-info"><span>Credit</span><div id="infoCredit">—</div></div>
                <div class="modal-info"><span>Role</span><div id="infoRole">—</div></div>
                <div class="modal-info"><span>Channel / Platform</span><div id="infoPlatform">—</div></div>
            </div>
            <h3>About This Work</h3>
            <div id="modalDescription" class="rich-content"></div>
            <div class="modal-links" id="modalLinks"></div>
        </div>
    </div>
</div>
<?php /**PATH /Applications/XAMPP/xamppfiles/htdocs/laravel/shamima-nazneen/resources/views/frontend/partials/work-modal.blade.php ENDPATH**/ ?>