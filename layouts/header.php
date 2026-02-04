<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Coffee House Clone</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <style>
        :root {
            --tch-orange: #4dabf7;
            --tch-black: #000000d9;
            --white: #fff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 90px;
        }

        /* ===== HEADER ===== */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            background: rgba(19, 19, 19, 0.95);
            backdrop-filter: blur(6px); 
            transition: all 0.3s ease-in-out;
            padding: 16px 0;
        }

        header.scrolled {
            background: #161616;
            padding: 12px 0;
            box-shadow: 0 4px 12px #f4ebeb14;
            border-bottom: 1px solid #f4ebeb14;
        }

        .header-container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-size: 20px;
            font-weight: 900;
            color: #4dabf7;
            text-decoration: none;
            text-shadow: 1px 1px 3px rgba(0,0,0,.3);
        }

        header.scrolled .logo {
            color: #4dabf7;
            text-shadow: none;
        }

        nav {
            display: flex;
            align-items: center;
        }

        nav a {
            color: #4dabf7;
            margin: 0 12px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            text-transform: uppercase;
            transition: .3s;
            text-shadow: 1px 1px 3px rgba(0,0,0,.3);
        }

        header.scrolled nav a {
            color: #4dabf7;
            text-shadow: none;
        }

        nav a:hover {
            color: var(--tch-orange);
        }

        /* ===== AUTH BUTTON ===== */
        .auth-group {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 8px 22px;
            border-radius: 25px;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
            transition: .3s;
            border: 1px solid #fff;
            color: #fff;
            background: rgba(255,255,255,.15);
        }

        .btn:hover {
            background: #fff;
            color: var(--tch-orange);
        }

        header.scrolled .btn {
            border: 1px solid var(--tch-orange);
            background: transparent;
            color: var(--tch-orange);
        }

        header.scrolled .btn:hover {
            background: var(--tch-orange);
            color: #fff;
        }

        /* ===== LANGUAGE ===== */
        .lang-switch {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-left: 15px;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }

        header.scrolled .lang-switch {
            color: #418aaa;
        }

        .lang-btn {
            cursor: pointer;
            opacity: .5;
        }

        .lang-btn.active {
            opacity: 1;
            color: var(--tch-orange);
        }
    </style>
</head>

<body>

<header id="main-nav">
    <div class="header-container">
        <a href="/Thecoffeehouse-main/public/index.php" class="logo">
            THE COFFEE HOUSE
        </a>

        <nav>
            <a href="/Thecoffeehouse-main/public/index.php" data-i18n="nav_home">Trang chủ</a>
            <a href="#" data-i18n="nav_news">Tin tức</a>
            <a href="#" data-i18n="nav_stores">Cửa hàng</a>
            <a href="#" data-i18n="nav_contact">Liên hệ</a>

            <div class="lang-switch">
                <span id="lang-vi" class="lang-btn active" onclick="changeLanguage('vi')">VI</span>
                <span>|</span>
                <span id="lang-en" class="lang-btn" onclick="changeLanguage('en')">EN</span>
            </div>
        </nav>

        <div class="auth-group">
            <a href="/Thecoffeehouse-main/views/auth/login.php" class="btn">Đăng nhập</a>
            <a href="/Thecoffeehouse-main/views/auth/register.php" class="btn">Đăng ký</a>
        </div>
    </div>
</header>

<script>
/* ===== SCROLL HEADER ===== */
window.addEventListener('scroll', () => {
    document.getElementById('main-nav')
        .classList.toggle('scrolled', window.scrollY > 50);
});

/* ===== I18N ===== */
const translations = {
    vi: {
        nav_home: "Trang chủ",
        nav_news: "Tin tức",
        nav_stores: "Cửa hàng",
        nav_contact: "Liên hệ"
    },
    en: {
        nav_home: "Home",
        nav_news: "News",
        nav_stores: "Stores",
        nav_contact: "Contact"
    }
};

function changeLanguage(lang) {
    localStorage.setItem('lang', lang);
    document.querySelectorAll('.lang-btn')
        .forEach(btn => btn.classList.remove('active'));
    document.getElementById(`lang-${lang}`).classList.add('active');

    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (translations[lang][key]) {
            el.innerText = translations[lang][key];
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    changeLanguage(localStorage.getItem('lang') || 'vi');
});
</script>
