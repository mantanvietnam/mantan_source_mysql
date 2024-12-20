<?php
session_start();
getHeader();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = [];

    $fullname = htmlspecialchars($_POST['fullname'], ENT_QUOTES, 'UTF-8');
    $purpose = htmlspecialchars($_POST['purpose'], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($_POST['phone'], ENT_QUOTES, 'UTF-8');
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');

    if (!$fullname || !$phone || !$message) {
        $errors[] = "Vui lòng điền đầy đủ các trường bắt buộc.";
    }

    // Gửi email hoặc xử lý dữ liệu nếu không có lỗi
    if (empty($errors)) {
        // Ví dụ: Gửi email
        $to = "info@minhtuanvinhomes.com";
        $subject = "Yêu cầu liên hệ từ $fullname";
        $body = "Họ và tên: $fullname\nMục đích sử dụng: $purpose\nSố điện thoại: $phone\nEmail: $email\nLời nhắn: $message";
        $headers = "From: $email";

        if (mail($to, $subject, $body, $headers)) {
            $_SESSION['success'] = "Cảm ơn bạn đã liên hệ, chúng tôi sẽ phản hồi trong thời gian sớm nhất.";
        } else {
            $errors[] = "Đã xảy ra lỗi khi gửi yêu cầu của bạn. Vui lòng thử lại.";
        }
    }
}
?>
<section id="lien-he-contain">
    <div class="relative bg-center bg-cover font-plus slide-bottom" style="background-image: url('./image/contact/bgContact.jpg')">
        <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
        <div class="relative z-10 flex flex-col justify-between px-4 py-10 text-white md:py-20 sm:px-6 xl:px-20">
            <div class="w-auto">
                <h1 class="mb-4 text-4xl font-bold">
                    MinhTuanVinhomes - Chung tay xây dựng cộng đồng Vinhomes
                </h1>
                <p class="mb-8 text-lg">
                    Hãy để chúng tôi trở thành cầu nối giúp bạn đến gần hơn với cuộc sống thượng lưu tại các quần thể đô thị Vinhomes.
                </p>
            </div>

            <!-- Hiển thị thông báo lỗi hoặc thành công -->
            <?php if (!empty($errors)): ?>
                <div class="mb-4 text-red-500">
                    <?php foreach ($errors as $error): ?>
                        <p><?= $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php elseif (!empty($_SESSION['success'])): ?>
                <div class="mb-4 text-green-500">
                    <p><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
                </div>
            <?php endif; ?>

            <!-- Form liên hệ -->
            <form action="" method="post" class="grid w-full grid-cols-1 gap-4 text-gray-800 sm:grid-cols-2">
                <!-- Họ và tên -->
                <div class="relative col-span-2 sm:col-span-1">
                    <input name="fullname" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Họ và tên *" type="text" value="<?= htmlspecialchars($_POST['fullname'] ?? '', ENT_QUOTES); ?>" />
                </div>

                <!-- Mục đích sử dụng BĐS -->
                <div class="relative col-span-2 sm:col-span-1">
                    <input name="purpose" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Mục đích sử dụng BĐS" type="text" value="<?= htmlspecialchars($_POST['purpose'] ?? '', ENT_QUOTES); ?>" />
                </div>

                <!-- Số điện thoại -->
                <div class="relative col-span-2 sm:col-span-1">
                    <input name="phone" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Số điện thoại *" type="text" value="<?= htmlspecialchars($_POST['phone'] ?? '', ENT_QUOTES); ?>" />
                </div>

                <!-- Địa chỉ Email -->
                <div class="relative col-span-2 sm:col-span-1">
                    <input name="email" class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Địa chỉ Email" type="email" value="<?= htmlspecialchars($_POST['email'] ?? '', ENT_QUOTES); ?>" />
                </div>

                <!-- Lời nhắn -->
                <div class="relative col-span-2">
                    <textarea name="message" class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Lời nhắn của bạn *"><?= htmlspecialchars($_POST['message'] ?? '', ENT_QUOTES); ?></textarea>
                </div>

                <!-- Gửi yêu cầu -->
                <button class="col-span-2 p-4 text-white bg-gradient-to-r from-[#182c77] to-[#6274bb] transition-all duration-300 rounded-lg sm:col-span-1 hover:from-[#6274bb] hover:to-[#182c77] hover:shadow-lg" type="submit">
                    Gửi yêu cầu tư vấn
                </button>

                <!-- Chính sách bảo mật -->
                <p class="col-span-2 mt-2 text-sm text-white sm:col-span-1">
                    Bằng việc gửi yêu cầu tư vấn, bạn đồng ý với Chính sách bảo mật của chúng tôi và đồng ý được MinhTuanVinhomes liên hệ hỗ trợ.
                </p>
            </form>
        </div>
    </div>
</section>
<?php
getFooter();
?>
