/**
 * SDC Charity & Community Platform - Interactive JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Sticky Header
    const header = document.querySelector('.site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 40) {
                header.classList.add('is-sticky');
            } else {
                header.classList.remove('is-sticky');
            }
        });
    }

    // 1b. Mobile Offcanvas Navigation Handler
    const mobileToggler = document.querySelector('.custom-hamburger-toggler');
    const offcanvasDrawer = document.getElementById('mainNavbarOffcanvas');
    if (mobileToggler && offcanvasDrawer && typeof bootstrap !== 'undefined') {
        mobileToggler.addEventListener('click', function (e) {
            e.preventDefault();
            const bsOffcanvas = bootstrap.Offcanvas.getOrCreateInstance(offcanvasDrawer);
            bsOffcanvas.show();
        });
    }
    const presetButtons = document.querySelectorAll('.btn-preset-amount');
    const customAmountInput = document.getElementById('amount_custom');
    const hiddenAmountOption = document.getElementById('amount_option');

    if (presetButtons.length > 0) {
        presetButtons.forEach(button => {
            button.addEventListener('click', function () {
                presetButtons.forEach(b => b.classList.remove('active', 'btn-blue'));
                presetButtons.forEach(b => b.classList.add('btn-outline-navy'));

                this.classList.remove('btn-outline-navy');
                this.classList.add('active', 'btn-blue');

                const selectedVal = this.getAttribute('data-amount');
                if (hiddenAmountOption) hiddenAmountOption.value = selectedVal;
                if (customAmountInput) customAmountInput.value = selectedVal;
                updateDonationSummary(selectedVal);
            });
        });
    }

    if (customAmountInput) {
        customAmountInput.addEventListener('input', function () {
            presetButtons.forEach(b => {
                b.classList.remove('active', 'btn-blue');
                b.classList.add('btn-outline-navy');
            });
            if (hiddenAmountOption) hiddenAmountOption.value = '';
            updateDonationSummary(this.value);
        });
    }

    function updateDonationSummary(amount) {
        const summaryDisplay = document.getElementById('summary-donation-amount');
        if (summaryDisplay) {
            const formatted = parseFloat(amount || 0).toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            summaryDisplay.textContent = 'Rs. ' + formatted;
        }
    }

    // 3. Lightbox Modal Trigger for Gallery
    const galleryItems = document.querySelectorAll('.gallery-item');
    const lightboxModal = document.getElementById('galleryLightboxModal');
    const lightboxImg = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');

    if (galleryItems.length > 0 && lightboxModal && lightboxImg) {
        galleryItems.forEach(item => {
            item.addEventListener('click', function () {
                const fullSrc = this.getAttribute('data-img-src') || this.querySelector('img').src;
                const title = this.getAttribute('data-img-title') || '';
                const desc = this.getAttribute('data-img-desc') || '';

                lightboxImg.src = fullSrc;
                if (lightboxCaption) {
                    lightboxCaption.innerHTML = `<strong>${title}</strong><p class="mb-0 text-muted small">${desc}</p>`;
                }
                const modalInstance = new bootstrap.Modal(lightboxModal);
                modalInstance.show();
            });
        });
    }
});
