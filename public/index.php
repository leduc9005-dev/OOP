<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$user = $_SESSION['user'] ?? null;
include '../layouts/header.php';
?>

<style>
    .mySwiper {
        width: 100%;
        margin-top: 0;
    }

    .mySwiper img {
        width: 100%;
        height: auto;
        display: block;
    }

    .ticker-wrap {
        width: 100%;
        overflow: hidden;
        background-color: #fdf5e8;
        padding: 25px 0;
        border-top: 1px solid #f1e4d0;
        border-bottom: 1px solid #f1e4d0;
        display: flex;
        align-items: center;
    }

    .ticker {
        display: flex;
        white-space: nowrap;
        animation: ticker-move 20s linear infinite;
    }

    .ticker__item {
        display: inline-block;
        padding: 0 60px;
        font-size: 18px;
        font-weight: 800;
        color: #53382c;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    @keyframes ticker-move {
        0% {
            transform: translate3d(0, 0, 0);
        }

        100% {
            transform: translate3d(-50%, 0, 0);
        }
    }

    .home-story {
        padding: 80px 0;
        background-color: #fff;
        text-align: center;
        font-family: 'Segoe UI', sans-serif;
    }

    .story-header h2 {
        font-size: 38px;
        font-weight: 900;
        margin-bottom: 20px;
        color: #000;
        letter-spacing: -1px;
    }

    .story-header p {
        font-size: 16px;
        line-height: 1.7;
        color: #333;
        max-width: 750px;
        margin: 0 auto 30px;
    }

    .btn-story {
        display: inline-block;
        padding: 12px 35px;
        background-color: #000;
        color: #fff;
        text-decoration: none;
        border-radius: 30px;
        font-weight: bold;
        font-size: 14px;
        transition: 0.3s ease;
        margin-bottom: 60px;
        text-transform: uppercase;
    }

    .story-collage {
        position: relative;
        height: 550px;
        margin-top: 20px;
    }

    .collage-main-img {
        width: 500px;
        height: 350px;
        object-fit: cover;
        border-radius: 12px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 2;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
    }

    .collage-sub-img-top {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        position: absolute;
        top: 5%;
        left: 15%;
        z-index: 1;
        object-fit: cover;
    }

    .collage-sub-img-bottom {
        width: 180px;
        height: 180px;
        border-radius: 12px;
        position: absolute;
        bottom: 5%;
        right: 15%;
        z-index: 3;
        object-fit: cover;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }

    .story-tag {
        position: absolute;
        padding: 8px 18px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: bold;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        z-index: 4;
        white-space: nowrap;
    }

    .tag-hashtag {
        top: 25%;
        right: 25%;
        background: #fb8d19;
        color: #fff;
    }

    .tag-dzui {
        bottom: 5%;
        left: 35%;
        background: #ffeb3b;
        font-size: 14px;
        padding: 15px 25px;
        border-radius: 50px 50px 0 50px;
        color: #000;
    }

    .featured-product-section {
        background-color: #fdf5e8;
        padding: 80px 0;
        text-align: center;
    }

    .featured-product-section .sub-title {
        color: #53382c;
        font-size: 14px;
        font-weight: 700;
        letter-spacing: 2px;
        margin-bottom: 10px;
    }

    .featured-product-section .main-title {
        color: #e57905;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 40px;
    }

    .product-categories {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-bottom: 50px;
        list-style: none;
        padding: 0;
    }

    .product-categories li a {
        text-decoration: none;
        color: #000;
        font-weight: 700;
        font-size: 15px;
        padding-bottom: 8px;
        transition: 0.3s;
        position: relative;
    }

    .product-categories li a.active,
    .product-categories li a:hover {
        color: #e57905;
    }

    .product-categories li a.active::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 2px;
        background-color: #e57905;
    }

    .product-collection-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 40px;
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .collection-item {
        transition: transform 0.4s ease;
        cursor: pointer;
    }

    .collection-item:hover {
        transform: translateY(-10px);
    }

    .collection-img-wrapper {
        width: 100%;
        height: 250px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }

    .collection-img-wrapper img {
        max-width: 80%;
        max-height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 20px 20px rgba(0, 0, 0, 0.15));
    }

    .collection-info .cat-name {
        font-size: 12px;
        color: #888;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .collection-info .prod-name {
        font-size: 18px;
        font-weight: 700;
        color: #000;
        margin-bottom: 10px;
    }

    .collection-info .prod-price {
        font-size: 17px;
        color: #e57905;
        font-weight: 800;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 10000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .modal-content {
        background-color: #fff;
        margin: 5% auto;
        width: 90%;
        max-width: 800px;
        border-radius: 16px;
        position: relative;
        overflow: hidden;
        display: flex;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        animation: zoomIn 0.3s ease-out;
    }

    .modal-body {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    .modal-img-side {
        flex: 1;
        background-color: #fdf5e8;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .modal-img-side img {
        max-width: 100%;
        height: auto;
        filter: drop-shadow(0 15px 30px rgba(0, 0, 0, 0.08));
    }

    .modal-info-side {
        flex: 1.2;
        padding: 40px 50px;
        background-color: #fff;
        display: flex;
        flex-direction: column;
        justify-content: center;
        text-align: left;
    }

    .modal-info-side h2 {
        font-size: 26px;
        font-weight: 800;
        margin: 0 0 8px 0;
        color: #000;
    }

    .modal-price {
        color: #e57905;
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .modal-desc {
        font-size: 14px;
        color: #555;
        line-height: 1.6;
        margin-bottom: 30px;
    }

    .size-selector p {
        font-size: 14px;
        font-weight: bold;
        margin-bottom: 12px;
    }

    .size-buttons {
        display: flex;
        gap: 12px;
        margin-bottom: 30px;
    }

    .btn-size {
        flex: 1;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: #fff;
        cursor: pointer;
        font-size: 14px;
        color: #333;
        transition: 0.3s;
    }

    .size-icon {
        width: 16px;
        height: 16px;
        object-fit: contain;
    }

    .btn-size.active {
        border-color: #e57905;
        color: #e57905;
        background-color: #fffaf5;
    }

    .btn-buy-now {
        width: 100%;
        padding: 16px;
        background: #e57905;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-weight: 800;
        font-size: 16px;
        cursor: pointer;
        transition: 0.3s;
    }

    /* --- LAYOUT INSTAGRAM & NEWS (Khôi phục chuẩn) --- */
    .bottom-layout-grid {
        display: grid;
        grid-template-columns: 1.3fr 1fr;
        gap: 40px;
        margin-top: 50px;
        padding: 0 20px;
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
    }

    .insta-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
    }

    .insta-link {
        display: block;
        overflow: hidden;
        border-radius: 8px;
        transition: all 0.4s ease;
    }

    .insta-link img {
        width: 100%;
        height: 180px;
        object-fit: cover;
        display: block;
        transition: transform 0.6s ease;
    }

    .insta-link:hover img {
        transform: scale(1.1);
    }

    .news-box img {
        width: 100%;
        border-radius: 8px;
        height: 250px;
        object-fit: cover;
    }

    @media (max-width: 992px) {
        .bottom-layout-grid {
            grid-template-columns: 1fr;
        }
    }

header {
    z-index: 99999;
    pointer-events: auto;
}

/* FIX CLICK HEADER TRÊN INDEX */
#main-nav {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 999999;
    pointer-events: auto;
}

/* Banner chỉ là nền */
.banner,
.swiper,
.hero,
.slider {
    z-index: 1;
}

</style>

<div class="swiper mySwiper">
    <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="images/slide_1_img.jpg" alt="Banner 1"></div>
        <div class="swiper-slide"><img src="images/slide_2_img.jpg" alt="Banner 2"></div>
    </div>
    <div class="swiper-pagination"></div>
</div>

<div class="ticker-wrap">
    <div class="ticker">
        <div class="ticker__item">LOCAL ESPRESSO CHAIN</div>
        <div class="ticker__item">•</div>
        <div class="ticker__item">FROM A LEADING LOCAL ESPRESSO CHAIN</div>
        <div class="ticker__item">•</div>
        <div class="ticker__item">THE COFFEE HOUSE - DELIVERED</div>
        <div class="ticker__item">•</div>
        <div class="ticker__item">LOCAL ESPRESSO CHAIN</div>
        <div class="ticker__item">•</div>
        <div class="ticker__item">FROM A LEADING LOCAL ESPRESSO CHAIN</div>
        <div class="ticker__item">•</div>
        <div class="ticker__item">THE COFFEE HOUSE - DELIVERED</div>
        <div class="ticker__item">•</div>
    </div>
</div>

<section class="home-story">
    <div class="story-content">
        <div class="story-header">
            <h2 data-i18n="story_title">CHUYỆN “NHÀ”</h2>
            <p data-i18n="story_desc">The Coffee House tin rằng, nụ cười là hương vị ngọt ngào nhất trong mỗi ngày
                mới...</p>
            <a href="#" class="btn-story" data-i18n="story_btn">TÌM HIỂU</a>
        </div>
        <div class="story-collage">
            <img src="images/story/banner-main-aboutus.png" class="collage-main-img" alt="Main Story">
            <img src="images/story/sticker-top-rectangle_17.png" class="collage-sub-img-top" alt="Sub Story Top">
            <img src="images/story/sticker-bottom-rectangle_18.png" class="collage-sub-img-bottom"
                alt="Sub Story Bottom">
            <div class="story-tag tag-hashtag">#chuyệnnhà</div>
            <div class="story-tag tag-dzui" data-i18n="story_tag">MỘT MIẾNG DZUI ZẺ</div>
        </div>
    </div>
</section>

<section class="featured-product-section">
    <div class="sub-title">FEATURED PRODUCT</div>
    <div class="main-title" data-i18n="collection_title">“NHÀ” COLLECTION</div>

    <ul class="product-categories">
        <li><a href="#" class="active" data-i18n="cat_coffee">CÀ PHÊ</a></li>
        <li><a href="#" data-i18n="cat_tea">TRÀ</a></li>
        <li><a href="#" data-i18n="cat_latte">LATTE & FRAPPE</a></li>
    </ul>

    <div class="product-collection-grid">
        <?php
        $featured_list = [
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'A-Mê Classic',
                'name_en' => 'A-Me Classic',
                'price' => 39000,
                'img' => 'images/products/sp1.png',
                'desc' => 'Thức uống Americano nguyên bản...',
                'desc_en' => 'Original Americano drink from 100% Arabica...'
            ],
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'A-Mê Mơ',
                'name_en' => 'A-Me Apricot',
                'price' => 49000,
                'img' => 'images/products/sp2.png',
                'desc' => 'Mê say với Americano kết hợp cùng Mơ...',
                'desc_en' => 'Be enchanted with Americano combined with Apricot...'
            ],
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'Cold Brew Kim Quất',
                'name_en' => 'Cold Brew Kumquat',
                'price' => 49000,
                'img' => 'images/products/sp3.png',
                'desc' => 'Vị chua ngọt của Kim Quất...',
                'desc_en' => 'Sweet and sour taste of Kumquat...'
            ],
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'Cappuccino Đá',
                'name_en' => 'Iced Cappuccino',
                'price' => 55000,
                'img' => 'images/products/sp4.png',
                'desc' => 'Capuchino là thức uống hòa quyện...',
                'desc_en' => 'Cappuccino is a blend of milk...'
            ],
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'Cappuccino Nóng',
                'name_en' => 'Hot Cappuccino',
                'price' => 55000,
                'img' => 'images/products/sp5.png',
                'desc' => 'Capuchino hòa quyện hương thơm sữa...',
                'desc_en' => 'Cappuccino blending milk aroma...'
            ],
            [
                'cat' => 'Cà Phê',
                'cat_en' => 'Coffee',
                'name' => 'Americano Nóng',
                'name_en' => 'Hot Americano',
                'price' => 45000,
                'img' => 'images/products/sp6.png',
                'desc' => 'Americano pha chế từ Espresso...',
                'desc_en' => 'Americano prepared from Espresso...'
            ],
        ];

        foreach ($featured_list as $item): ?>
            <div class="collection-item"
                onclick="openProductModal('<?= $item['name'] ?>', '<?= $item['name_en'] ?>', <?= $item['price'] ?>, '<?= $item['img'] ?>', '<?= addslashes($item['desc']) ?>', '<?= addslashes($item['desc_en']) ?>')">
                <div class="collection-img-wrapper">
                    <img src="<?= $item['img'] ?>" alt="<?= $item['name'] ?>">
                </div>
                <div class="collection-info">
                    <div class="cat-name" data-vi="<?= $item['cat'] ?>" data-en="<?= $item['cat_en'] ?>"><?= $item['cat'] ?>
                    </div>
                    <div class="prod-name" data-vi="<?= $item['name'] ?>" data-en="<?= $item['name_en'] ?>">
                        <?= $item['name'] ?>
                    </div>
                    <div class="prod-price"><?= number_format($item['price'], 0, ',', '.') ?> đ</div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<div id="productDetailModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <div class="modal-body">
            <div class="modal-img-side">
                <img id="m-img" src="" alt="">
            </div>
            <div class="modal-info-side">
                <h2 id="m-name">Tên sản phẩm</h2>
                <div id="m-price" class="modal-price">0 đ</div>
                <p id="m-desc" class="modal-desc">Mô tả chi tiết...</p>

                <div class="size-selector">
                    <p data-i18n="modal_size_title">Chọn size (bắt buộc):</p>
                    <div class="size-buttons">
                        <button class="btn-size active" onclick="updatePrice(0, this)">
                            <img src="https://q8laser.com/wp-content/uploads/2021/08/ly-cafe-vector.jpg"
                                class="size-icon">
                            <span data-i18n="size_small">Nhỏ</span> + 0đ
                        </button>
                        <button class="btn-size" onclick="updatePrice(6000, this)">
                            <img src="https://q8laser.com/wp-content/uploads/2021/08/ly-cafe-vector.jpg"
                                class="size-icon">
                            <span data-i18n="size_medium">Vừa</span> + 6.000đ
                        </button>
                    </div>
                </div>
                <button class="btn-buy-now" data-i18n="modal_buy_btn">MUA NGAY</button>
            </div>
        </div>
    </div>
</div>

<script>
    // --- BIẾN TOÀN CỤC ĐỂ LƯU THÔNG TIN MODAL ĐANG MỞ ---
    let basePrice = 0;
    let currentModalData = { name_vi: '', name_en: '', desc_vi: '', desc_en: '' };

    Object.assign(translations.vi, {
        story_title: "CHUYỆN “NHÀ”",
        story_desc: "The Coffee House tin rằng, nụ cười là hương vị ngọt ngào nhất trong mỗi ngày mới...",
        story_btn: "TÌM HIỂU",
        story_tag: "MỘT MIẾNG DZUI ZẺ",
        collection_title: "“NHÀ” COLLECTION",
        cat_coffee: "CÀ PHÊ",
        cat_tea: "TRÀ",
        cat_latte: "LATTE & FRAPPE",
        modal_size_title: "Chọn size (bắt buộc):",
        size_small: "Nhỏ",
        size_medium: "Vừa",
        modal_buy_btn: "MUA NGAY"
    });

    Object.assign(translations.en, {
        story_title: "“HOUSE” STORIES",
        story_desc: "The Coffee House believes that a smile is the sweetest flavor for every new day...",
        story_btn: "LEARN MORE",
        story_tag: "A PIECE OF JOY",
        collection_title: "“HOUSE” COLLECTION",
        cat_coffee: "COFFEE",
        cat_tea: "TEA",
        cat_latte: "LATTE & FRAPPE",
        modal_size_title: "Select size (required):",
        size_small: "Small",
        size_medium: "Medium",
        modal_buy_btn: "BUY NOW"
    });

    function openProductModal(nameVi, nameEn, price, img, descVi, descEn) {
        basePrice = price;
        currentModalData = { name_vi: nameVi, name_en: nameEn, desc_vi: descVi, desc_en: descEn };

        const lang = localStorage.getItem('preferred_lang') || 'vi';
        document.getElementById('m-name').innerText = (lang === 'vi') ? nameVi : nameEn;
        document.getElementById('m-desc').innerText = (lang === 'vi') ? descVi : descEn;
        document.getElementById('m-price').innerText = price.toLocaleString('vi-VN') + " đ";
        document.getElementById('m-img').src = img;

        document.querySelectorAll('.btn-size').forEach(b => b.classList.remove('active'));
        document.querySelectorAll('.btn-size')[0].classList.add('active');
        document.getElementById('productDetailModal').style.display = "block";
        document.body.style.overflow = "hidden";
    }

    const originalChangeLanguage = window.changeLanguage;
    window.changeLanguage = function (lang) {
        originalChangeLanguage(lang);

        document.querySelectorAll('.cat-name, .prod-name').forEach(el => {
            el.innerText = el.getAttribute(`data-${lang}`);
        });

        if (document.getElementById('productDetailModal').style.display === "block") {
            document.getElementById('m-name').innerText = (lang === 'vi') ? currentModalData.name_vi : currentModalData.name_en;
            document.getElementById('m-desc').innerText = (lang === 'vi') ? currentModalData.desc_vi : currentModalData.desc_en;
        }
    };

    function updatePrice(extra, element) {
        let totalPrice = basePrice + extra;
        document.getElementById('m-price').innerText = totalPrice.toLocaleString('vi-VN') + " đ";
        document.querySelectorAll('.btn-size').forEach(b => b.classList.remove('active'));
        element.classList.add('active');
    }

    function closeModal() {
        document.getElementById('productDetailModal').style.display = "none";
        document.body.style.overflow = "auto";
    }

    window.onclick = function (e) {
        if (e.target == document.getElementById('productDetailModal')) closeModal();
    }
</script>

<div class="bottom-layout-grid">
    <div class="instagram-section">
        <div class="section-title"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="color: #fb8d19; font-weight: 800; margin: 0;" data-i18n="insta_title">INSTAGRAM</h3>
            <a href="https://www.instagram.com/thecoffeehousevn/" target="_blank"
                style="color: #000; text-decoration: none; font-weight: bold; font-size: 14px;">FOLLOW NGAY →</a>
        </div>
        <div class="insta-grid">
            <?php for ($i = 1; $i <= 6; $i++): ?>
                <a href="https://www.instagram.com/thecoffeehousevn/" target="_blank" class="insta-link">
                    <img src="images/insta/instagram<?= $i ?>.png" alt="Insta <?= $i ?>">
                </a>
            <?php endfor; ?>
        </div>
    </div>

    <div class="news-sidebar">
        <div class="section-title"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
            <h3 style="color: #fb8d19; font-weight: 800; margin: 0;" data-i18n="news_title">NEWS</h3>
            <a href="#" style="color: #000; text-decoration: none; font-weight: bold; font-size: 14px;">XEM THÊM →</a>
        </div>
        <div class="news-box" style="background: #fff5e6; padding: 20px; border-radius: 12px;">
            <img src="https://picsum.photos/600/400?coffee" alt="News Image">
            <h4 style="margin: 15px 0 10px; font-size: 18px;" data-i18n="news_h4">Bắt gặp Sài Gòn xưa trong món uống
                hiện đại</h4>
            <p style="font-size: 14px; line-height: 1.6; color: #444;" data-i18n="news_p">
                Dẫu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài
                Gòn xưa cũ qua hương vị ẩm thực...
            </p>
        </div>
    </div>
</div>

<script>
    var swiper = new Swiper(".mySwiper", {
        loop: true,
        autoplay: { delay: 4000, disableOnInteraction: false },
        pagination: { el: ".swiper-pagination", clickable: true }
    });

    if (typeof translations !== 'undefined') {
        Object.assign(translations.vi, {
            insta_title: "INSTAGRAM",
            news_title: "NEWS",
            news_h4: "Bắt gặp Sài Gòn xưa trong món uống hiện đại",
            news_p: "Dẫu qua bao nhiêu lớp sóng thời gian, người ta vẫn có thể tìm lại những dấu ấn thăng trầm của một Sài Gòn xưa cũ qua hương vị ẩm thực..."
        });

        Object.assign(translations.en, {
            insta_title: "INSTAGRAM",
            news_title: "NEWS",
            news_h4: "Discover Old Saigon in Modern Drinks",
            news_p: "Through many waves of time, people can still find the ups and downs of an old Saigon through culinary flavors..."
        });
    }
</script>

<?php include '../layouts/footer.php'; ?>