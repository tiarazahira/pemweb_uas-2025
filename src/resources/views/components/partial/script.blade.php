
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const products = @json($products, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
        const productListContainer = document.getElementById('product-list');

        function displayProducts() {
            productListContainer.innerHTML = '';

            if (products.length === 0) {
                productListContainer.innerHTML = '<p>Tidak ada produk tersedia saat ini.</p>';
                return;
            }

            products.forEach(product => {
                const isOutOfStock = product.stok === 0;
                const stockClass = isOutOfStock ? 'product-stock out-of-stock' : 'product-stock';
                const stockText = isOutOfStock ? 'Stok Habis' : `Stok: <strong>${product.stok}</strong>`;
                const buttonDisabled = isOutOfStock ? 'disabled' : '';
                const buttonText = isOutOfStock ? 'Stok Habis' : 'Beli Sekarang';

                const productCard = document.createElement('div');
                productCard.className = 'product-card';

                productCard.innerHTML = `
                 <img src="/storage/${product.image || 'default.jpg'}" alt="${product.nama_bunga}">
                    <div class="product-info">
                        <h3>${product.nama_bunga}</h3>
                        <p class="price">Rp ${parseFloat(product.harga_satuan).toLocaleString('id-ID')}</p>
                        <div class="${stockClass}">${stockText}</div>
                        <p>${product.deskripsi || ''}</p>
                        <button class="buy-button" ${buttonDisabled}>${buttonText}</button>
                    </div>
                `;

                productListContainer.appendChild(productCard);
            });
        }

        displayProducts();

        productListContainer.addEventListener('click', function (event) {
            if (event.target.classList.contains('buy-button') && !event.target.disabled) {
                const sellerPhoneNumber = '0812-3456-7890';
                alert(`Terima kasih! Untuk memesan, silakan hubungi penjual di nomor:\n\n📞 ${sellerPhoneNumber}`);
            }
        });
    });
</script>