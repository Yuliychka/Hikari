document.addEventListener('DOMContentLoaded', function () {
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

            if (response.status === 401) {
                showHikariToast('LOG IN TO ACCESS HEART', 'error');
                return;
            }

            const data = await response.json();
            if (data.status === 'added') {
                btn.classList.add('active');
                btn.querySelector('i').className = 'bi bi-heart-fill';
                btn.setAttribute('data-tooltip', 'Remove from Heart');
                showHikariToast('ADDED TO HEART');
            } else {
                btn.classList.remove('active');
                btn.querySelector('i').className = 'bi bi-heart';
                btn.setAttribute('data-tooltip', 'Add to Heart');
                showHikariToast('REMOVED FROM HEART');

                if (window.location.pathname.includes('/wishlist')) {
                    const card = btn.closest('.col-sm-6, .col-md-4, .col-lg-3');
                    if (card) {
                        card.style.opacity = '0';
                        setTimeout(() => card.remove(), 500);
                    }
                }
            }
        } catch (error) { console.error(error); }
    });

    // Cart Add/Toggle (for Index/Products pages)
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

            if (response.status === 401) {
                showHikariToast('LOG IN TO ACCESS VAULT', 'error');
                return;
            }

            const data = await response.json();
            if (data.status === 'added') {
                btn.classList.add('active');
                btn.querySelector('i').className = 'bi bi-cart-check-fill';
                btn.setAttribute('data-tooltip', 'Remove from Vault');
                showHikariToast('SEALED IN VAULT');
            } else if (data.status === 'removed') {
                btn.classList.remove('active');
                btn.querySelector('i').className = 'bi bi-cart-plus';
                btn.setAttribute('data-tooltip', 'Add to Vault');
                showHikariToast('REMOVED FROM VAULT');
            }
            if (data.cart_count !== undefined) {
                const badge = document.querySelector('.cart-count');
                if (badge) badge.textContent = data.cart_count;
            }
        } catch (error) { console.error(error); }
    });

    // AJAX Cart Page Removal
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.ajax-cart-remove');
        if (!btn) return;
        e.preventDefault();

        const id = btn.dataset.id;
        const panel = document.getElementById(`cart-item-${id}`);

        try {
            const response = await fetch(`/cart/remove/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            const data = await response.json();
            if (data.success) {
                if (panel) {
                    panel.style.transition = 'all 0.4s ease';
                    panel.style.transform = 'translateX(100%)';
                    panel.style.opacity = '0';
                    setTimeout(() => {
                        panel.remove();
                        if (document.querySelectorAll('.cart-item-panel').length === 0) {
                            window.location.reload(); // Show empty state
                        }
                    }, 400);
                }
                updateSummary(data);
                showHikariToast('REMOVED FROM VAULT');
            }
        } catch (error) { console.error(error); }
    });

    // AJAX Quantity Update
    document.addEventListener('click', async function (e) {
        const btn = e.target.closest('.qty-btn');
        if (!btn) return;

        const id = btn.dataset.id;
        const action = btn.dataset.action;
        const input = document.getElementById(`qty-${id}`);
        if (!input) return;

        let qty = parseInt(input.value);
        if (action === 'increase') qty++;
        else if (action === 'decrease' && qty > 1) qty--;
        else return;

        input.value = qty;

        try {
            const response = await fetch(`/cart/update/${id}`, {
                method: 'PATCH',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ quantity: qty })
            });

            const data = await response.json();
            if (data.status === 'success') {
                const subEl = document.getElementById(`subtotal-${id}`);
                if (subEl) subEl.textContent = `$${data.item_subtotal}`;
                updateSummary(data);
                showHikariToast('VAULT SYNCHRONIZED');
            }
        } catch (error) { console.error(error); }
    });

    function updateSummary(data) {
        if (document.getElementById('cart-subtotal')) document.getElementById('cart-subtotal').textContent = `$${data.cart_subtotal}`;
        if (document.getElementById('cart-total')) document.getElementById('cart-total').textContent = `$${data.total}`;
        const ships = document.getElementById('cart-shipping');
        if (ships) {
            ships.textContent = data.shipping;
            if (data.shipping === 'FREE') ships.classList.add('text-success', 'fw-bold');
            else ships.classList.remove('text-success', 'fw-bold');
        }
        if (document.getElementById('cart-discount')) document.getElementById('cart-discount').textContent = `-$${data.discount}`;
        const badge = document.querySelector('.cart-count');
        if (badge && data.cart_count !== undefined) badge.textContent = data.cart_count;
    }

    function showHikariToast(message, type = 'success') {
        if (window.showHikariToast) window.showHikariToast(message, type);
        else console.log(message);
    }
});
