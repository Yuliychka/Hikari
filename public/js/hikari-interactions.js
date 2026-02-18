document.addEventListener('DOMContentLoaded', function () {
    // CSRF Token setup for Fetch
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

    // Wishlist Toggle
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.ajax-wishlist');
        if (!btn) return;

        const productId = btn.dataset.id;
        try {
            const response = await fetch(`/wishlist/toggle/${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            });

            if (response.redirected || response.status === 401) {
                showHikariToast('LOG IN TO ACCESS HEART', 'error');
                return;
            }

            const data = await response.json();
            if (data.status === 'added') {
                btn.classList.add('active');
                btn.querySelector('i').classList.replace('bi-heart', 'bi-heart-fill');
                btn.setAttribute('data-tooltip', 'Remove from Heart');
                showHikariToast('ADDED TO HEART');
            } else {
                btn.classList.remove('active');
                btn.querySelector('i').classList.replace('bi-heart-fill', 'bi-heart');
                btn.setAttribute('data-tooltip', 'Add to Heart');
                showHikariToast('REMOVED FROM HEART');

                // Instant Removal on Wishlist Page
                if (window.location.pathname.includes('/wishlist')) {
                    const card = btn.closest('.col-sm-6, .col-md-4, .col-lg-3');
                    if (card) {
                        card.style.transition = 'all 0.5s ease';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8)';
                        setTimeout(() => card.remove(), 500);
                    }
                }
            }

            console.log(data.message);
        } catch (error) {
            console.error('Wishlist Error:', error);
        }
    });

    // Cart Add/Update
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.ajax-cart');
        if (!btn) return;

        const productId = btn.dataset.id;
        try {
            const response = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: 1 })
            });

            if (response.redirected || response.status === 401) {
                showHikariToast('LOG IN TO ACCESS VAULT', 'error');
                return;
            }

            const data = await response.json();
            if (data.status === 'added') {
                btn.classList.add('active');
                btn.querySelector('i').classList.replace('bi-cart-plus', 'bi-cart-check-fill');
                btn.setAttribute('data-tooltip', 'Remove from Vault');
                showHikariToast('SEALED IN VAULT');
            } else {
                btn.classList.remove('active');
                btn.querySelector('i').classList.replace('bi-cart-check-fill', 'bi-cart-plus');
                btn.setAttribute('data-tooltip', 'Add to Vault');
                showHikariToast('REMOVED FROM VAULT');
            }

            // Trigger a tactile scale effect
            const icon = btn.querySelector('i');
            icon.style.transform = 'scale(1.4)';
            setTimeout(() => icon.style.transform = 'scale(1)', 200);

            console.log(data.message);
        } catch (error) {
            console.error('Cart Error:', error);
        }
    });
});
