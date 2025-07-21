// Menunggu hingga seluruh halaman HTML selesai dimuat
document.addEventListener('DOMContentLoaded', function() {

    // --- DATA PRODUK BUNGA ---
    const products = [
        {
            id: 1,
            name: 'Buket Mawar Merah',
            price: 'Rp 250.000',
            description: 'Rangkaian mawar merah segar yang melambangkan cinta dan gairah. Sempurna untuk hadiah valentine atau ulang tahun.',
            imageUrl: 'https://images.unsplash.com/photo-1533038590840-1cde6e668a91?q=80&w=1887&auto=format&fit=crop',
            stock: 15
        },
        {
            id: 2,
            name: 'Bunga Lili Putih',
            price: 'Rp 180.000',
            description: 'Bunga lili putih yang elegan, simbol dari kemurnian dan ketulusan. Cocok untuk acara formal atau ucapan selamat.',
            imageUrl: 'https://images.unsplash.com/photo-1562690868-c68991df1641?q=80&w=1887&auto=format&fit=crop',
            stock: 8
        },
        {
            id: 3,
            name: 'Anggrek Bulan',
            price: 'Rp 350.000',
            description: 'Tanaman anggrek bulan yang anggun dan tahan lama. Menjadi hiasan indah untuk rumah atau kantor.',
            imageUrl: 'https://images.unsplash.com/photo-1591987159273-5a7a4035651c?q=80&w=1887&auto=format&fit=crop',
            stock: 0
        },
        {
            id: 4,
            name: 'Buket Bunga Matahari',
            price: 'Rp 210.000',
            description: 'Buket bunga matahari ceria yang membawa kebahagiaan dan semangat. Hadiah terbaik untuk teman atau keluarga.',
            imageUrl: 'https://images.unsplash.com/photo-1563241527-540e1b84958c?q=80&w=1887&auto=format&fit=crop',
            stock: 12
        },
        {
            id: 5,
            name: 'Tulip Aneka Warna',
            price: 'Rp 275.000',
            description: 'Rangkaian bunga tulip dengan berbagai warna cerah yang menawan, cocok untuk merayakan momen spesial.',
            imageUrl: 'https://images.unsplash.com/photo-1520763185298-1b434c919c27?q=80&w=1887&auto=format&fit=crop',
            stock: 20
        },
        {
            id: 6,
            name: 'Baby\'s Breath',
            price: 'Rp 150.000',
            description: 'Buket bunga Baby\'s Breath yang simpel namun menawan, melambangkan cinta abadi dan kemurnian.',
            imageUrl: 'https://images.unsplash.com/photo-1620576324892-2973b36994e4?q=80&w=1887&auto=format&fit=crop',
            stock: 5
        }
    ];

    const productListContainer = document.getElementById('product-list');

    function displayProducts() {
        productListContainer.innerHTML = '';

        products.forEach(product => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card';

            const isOutOfStock = product.stock === 0;
            const stockClass = isOutOfStock ? 'product-stock out-of-stock' : 'product-stock';
            const stockText = isOutOfStock ? 'Stok Habis' : `Stok: <strong>${product.stock}</strong>`;
            const buttonDisabled = isOutOfStock ? 'disabled' : '';
            const buttonText = isOutOfStock ? 'Stok Habis' : 'Beli Sekarang';

            productCard.innerHTML = `
                <img src="${product.imageUrl}" alt="${product.name}">
                <div class="product-info">
                    <h3>${product.name}</h3>
                    <p class="price">${product.price}</p>
                    <div class="${stockClass}">${stockText}</div>
                    <p>${product.description}</p>
                    <button class="buy-button" ${buttonDisabled}>${buttonText}</button>
                </div>
            `;

            productListContainer.appendChild(productCard);
        });
    }

    // Memanggil fungsi untuk menampilkan produk
    displayProducts();

    // --- LOGIKA POP-UP ---
    // DITAMBAHKAN: Event listener untuk memunculkan pop-up
    productListContainer.addEventListener('click', function(event) {
        
        // Cek apakah yang diklik adalah tombol "Beli Sekarang" dan tombol itu tidak sedang disabled
        if (event.target.classList.contains('buy-button') && !event.target.disabled) {
            
            // Nomor telepon penjual (bisa Anda ganti)
            const sellerPhoneNumber = '0812-3456-7890';
            
            // Tampilkan pop-up menggunakan alert()
            alert(`Terima kasih! Untuk memesan, silakan hubungi penjual di nomor:\n\n📞 ${sellerPhoneNumber}`);
        }
    });

});