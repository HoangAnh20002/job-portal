<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>

*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
    body {
    font-family: Arial, sans-serif;
    background-color: #f5f5f5;
    margin: 0;
    padding: 0;
    color: #333
}
li {
    list-style: none;
}
.footer {
    background-color: #f5f5f5;
    color: white;
    padding: 20px 0;
    color: #333
}

.footer-container {
    display: flex;
    justify-content: space-between;
    max-width: 1440px;
    margin: 0 auto;
    padding: 0 20px;
}

.footer-section {
    margin: 0 20px;
    
}

.footer-section h2 {
    font-size: 18px;
    margin-bottom: 10px;
}

.footer-section p, .footer-section a {
    font-size: 14px;
    margin-bottom: 8px;
    color: white;
    text-decoration: none;
    color: #333
}
.footer-section p:hover{
    cursor: pointer;
}
.footer-section a:hover {
    text-decoration: underline;
    cursor: pointer;
}

.social-icons {
    display: flex;
    gap: 10px;
}

.social-icons img {
    width: 24px;
    height: 24px;
}

.certification img {
    margin-top: 10px;
    width: 100px;
    height: auto;
}

.footer-bottom {
    text-align: center;
    padding: 10px 0;
    border-top: 1px solid #5d35b1;
    margin-top: 20px;
}
@media (max-width: 768px) {
    .footer-container {
    display: flex;
    flex-direction: column;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
    

}

@media (max-width: 480px) {
  .footer-container{
    display: flex;
    flex-direction: column;
  }
}


</style>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h2>Về chúng tôi</h2>
            <p>Jobportal.vn - Công Ty Cổ Phần Hoang Anh Group</p>
            <p>Phòng 102, Tòa nhà 20-20B Trần Cao Vân, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh</p>
            <p>Chi nhánh: Tầng 4, tòa nhà Times Tower, 35 Lê Văn Lương, Thanh Xuân, Hà Nội.</p>
            <p>Giấy phép hoạt động dịch vụ việc làm số: 4938/SLĐTBXH-GP do Sở Lao Động Thương Binh & Xã Hội TP.HCM cấp
            </p>
            <p>Điện thoại: 0988776699 | 034568999</p>
            <p>Email hỗ trợ người tìm việc: hoanganh@jobportal.vn</p>
            <p>Email hỗ trợ nhà tuyển dụng: hoanganh@td.vn</p>
        </div>
        <div class="footer-section">
            <h2>Thông tin</h2>
            <div>
                <li><a href="#">Cẩm nang nghề nghiệp</a></li>
                <li><a href="#">Báo giá dịch vụ</a></li>
                <li><a href="#">Điều khoản sử dụng</a></li>
                <li><a href="#">Quy định bảo mật</a></li>
                <li><a href="#">Sơ đồ trang web</a></li>
                <li><a href="#">Chính sách dữ liệu cá nhân</a></li>
                <li><a href="#">Tuân thủ và sự đồng ý của Khách Hàng</a></li>
            </div>
        </div>
        <div class="footer-section">
            <h2>Kết nối với chúng tôi</h2>
            <div class="social-icons">
                <a href="https://www.youtube.com/?app=desktop&hl=vi"><i class="bi bi-youtube"></i></a>
                <a href="https://www.facebook.com/"><i class="bi bi-facebook"></i></a>
                <a href="https://x.com/?lang=vi"><i class="bi bi-twitter"></i></a>
                <a href="https://www.instagram.com/"><i class="bi bi-instagram"></i></a>
                <a href=""><i class="bi bi-zalo"></i></a>
                <a href="https://www.tiktok.com/"><i class="bi bi-tiktok"></i></a>
            </div>
           
        </div>
    </div>
    <div class="footer-bottom">
        <p>© 2024 - Bản quyền thuộc về HoangAnh Group</p>
    </div>
</footer>