<style>
    /* ===== STYLE FOOTER ĐỒNG BỘ ===== */
    footer {
        background-color: #000;
        /* Nền đen nguyên bản */
        color: #fff;
        padding: 60px 0 30px;
        margin-top: 80px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 40px;
        padding: 0 20px;
        text-align: left;
    }

    .footer-col h4 {
        color: var(--tch-orange);
        margin-bottom: 25px;
        font-size: 16px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .footer-col ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-col ul li {
        margin-bottom: 12px;
    }

    .footer-col ul li a {
        color: #ccc;
        text-decoration: none;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .footer-col ul li a:hover {
        color: #fff;
        padding-left: 5px;
    }

    .footer-col p {
        color: #ccc;
        font-size: 14px;
        line-height: 1.8;
        margin: 0;
    }

    .social-links {
        display: flex;
        gap: 20px;
        margin-top: 15px;
    }

    .social-links a {
        color: #fff;
        font-size: 22px;
        transition: 0.3s;
    }

    .social-links a:hover {
        color: var(--tch-orange);
        transform: translateY(-3px);
    }

    .footer-bottom {
        border-top: 1px solid #333;
        max-width: 1200px;
        margin: 50px auto 0;
        padding: 25px 20px 0;
        color: #777;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    @media (max-width: 600px) {
        .footer-bottom {
            flex-direction: column;
            gap: 10px;
            text-align: center;
        }
    }
</style>

<footer>
    <div class="footer-container">
        <div class="footer-col">
            <h4>GIỚI THIỆU</h4>
            <ul>
                <li><a href="#">Về chúng tôi</a></li>
                <li><a href="#">Sản phẩm</a></li>
                <li><a href="#">Khuyến mãi</a></li>
                <li><a href="#">Chuyện Nhà</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>ĐIỀU KHOẢN</h4>
            <ul>
                <li><a href="#">Điều khoản sử dụng</a></li>
                <li><a href="#">Chính sách bảo mật</a></li>
                <li><a href="#">Chính sách vận chuyển</a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>LIÊN HỆ</h4>
            <p>
                <i class="fas fa-phone-alt" style="margin-right: 8px;"></i> Đặt hàng: 1800 6936<br>
                <i class="fas fa-envelope" style="margin-right: 8px;"></i> support@thecoffeehouse.vn<br>
                <i class="fas fa-map-marker-alt" style="margin-right: 8px;"></i> Tòa nhà Toyota, Quận 2, TP.HCM
            </p>
        </div>

        <div class="footer-col">
            <h4>THE COFFEE HOUSE</h4>
            <p>Theo dõi chúng tôi để nhận những tin tức mới nhất về ưu đãi và sản phẩm.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div>© 2026 <strong>The Coffee House Clone</strong>. All rights reserved.</div>
        <div>Thiết kế bởi: Software Engineer Student</div>
    </div>
</footer>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

</body>

</html>
