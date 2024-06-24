@extends('interface.layouts.home')
@php
    $role_id = null;
 @endphp
@section('content')
    <style>
        .side-bar {
            display: none;
        }
        body {
            background: linear-gradient(270deg, rgba(135, 170, 255, 0.5) 0%, rgba(135, 150, 180, 0.5) 73.72%);
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            padding: 20px;
        }
        .container {
            margin-top: 20px;
            margin-bottom: 50px;
            margin-left: 13%;
            max-width: 1100px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #007bff;
        }
        p {
            margin-bottom: 1.2em;
        }
        .address {
            margin-bottom: 20px;
        }
        .contact-info {
            margin-bottom: 20px;
        }
        .core-values {
            margin-bottom: 20px;
        }
        .achievements {
            margin-bottom: 20px;
        }
    </style>

    <div class="container">
        <h1>Giới thiệu về Jobportal.vn - Công Ty Cổ Phần Hoàng Anh Group</h1>

        <div class="address">
            <h3>Địa chỉ:</h3>
            <p><strong>Trụ sở chính:</strong> Phòng 102, Tòa nhà 20-20B Trần Cao Vân, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh</p>
            <p><strong>Chi nhánh:</strong> Tầng 4, tòa nhà Times Tower, 35 Lê Văn Lương, Thanh Xuân, Hà Nội</p>
        </div>

        <div class="contact-info">
            <h3>Thông tin liên hệ:</h3>
            <p><strong>Điện thoại:</strong> 0988 776 699 | 0345 689 999</p>
            <p><strong>Email hỗ trợ người tìm việc:</strong> <a href="mailto:hoanganh@jobportal.vn">hoanganh@jobportal.vn</a></p>
            <p><strong>Email hỗ trợ nhà tuyển dụng:</strong> <a href="mailto:hoanganh@td.vn">hoanganh@td.vn</a></p>
        </div>

        <div class="overview">
            <h3>Thông tin chi tiết về Jobportal.vn</h3>
            <p><strong>Giấy phép hoạt động dịch vụ việc làm:</strong> Số 4938/SLĐTBXH-GP do Sở Lao Động Thương Binh & Xã Hội TP.HCM cấp</p>
            <p>Jobportal.vn là một trong những trang web tuyển dụng hàng đầu tại Việt Nam, với hơn 10 năm kinh nghiệm trong lĩnh vực cung cấp giải pháp tuyển dụng hiệu quả cho cả người tìm việc và nhà tuyển dụng. Chúng tôi cam kết cung cấp những dịch vụ uy tín, chuyên nghiệp và đáp ứng mọi nhu cầu tuyển dụng của bạn.</p>
            <p>Với mục tiêu trở thành đối tác tin cậy và hiệu quả nhất của các doanh nghiệp, Jobportal.vn luôn không ngừng phát triển và cải tiến dịch vụ để mang lại giá trị cao nhất cho cả hai bên tham gia quá trình tuyển dụng.</p>
        </div>

        <div class="core-values">
            <h3>Giá trị cốt lõi:</h3>
            <ul>
                <li><strong>Chuyên nghiệp:</strong> Đội ngũ nhân viên tâm huyết, chuyên nghiệp, luôn lắng nghe và đáp ứng nhu cầu của khách hàng.</li>
                <li><strong>Trung thực:</strong> Cam kết bảo mật thông tin cá nhân và tôn trọng quyền riêng tư của người dùng.</li>
                <li><strong>Hiệu quả:</strong> Mang đến các giải pháp tuyển dụng hiệu quả, giúp người tìm việc và nhà tuyển dụng đạt được mục tiêu nghề nghiệp và kinh doanh.</li>
            </ul>
        </div>

        <div class="achievements">
            <h3>Thành tích và danh hiệu:</h3>
            <ul>
                <li>Đã hỗ trợ hàng ngàn cá nhân và doanh nghiệp tìm được nhân tài phù hợp.</li>
                <li>Nhận được nhiều giải thưởng uy tín trong lĩnh vực tuyển dụng và phát triển nguồn nhân lực.</li>
                <li>Được đánh giá cao về chất lượng dịch vụ và sự hài lòng từ phía khách hàng.</li>
            </ul>
        </div>
    </div>

@endsection
