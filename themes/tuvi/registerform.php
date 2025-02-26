
<?php


global $urlThemeActive;
?>
<style>
/* Base styles */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
    font-family: Arial, sans-serif;
}

/* Form wrapper */
.form-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

/* Form container */
.outer-frame {
    max-width: 450px;
    width: 100%;
    border: 1px solid #ddd;
    border-radius: 8px;
    background-color: #e6f3ff;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

/* Title bar */
.title-bar {
    background: linear-gradient(to right, #927011, #b58a16);
    margin: -20px -20px 15px -20px;
    padding: 12px;
    color: white;
    font-weight: bold;
    border-radius: 7px 7px 0 0;
    font-size: 1.2rem;
    text-align: center;
}

/* Form row */
.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

/* Form group */
.form-group {
    margin-bottom: 15px;
    width: 100%;
}

/* Labels */
.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #2d3748;
    font-size: 0.9rem;
}

/* Input fields */
.form-group input,
.form-group select {
    width: 100%;
    padding: 10px;
    border: 1px solid #e2e8f0;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 0.9rem;
    height: 38px;
    background-color: #ffffff;
}

/* Placeholder */
.form-group input::placeholder {
    color: #aaa;
    font-size: 0.85rem;
}

/* Select dropdown */
.form-group select {
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 14px;
}

/* Radio group */
.radio-group {
    display: flex;
    gap: 20px;
}

.radio-label {
    display: flex;
    align-items: center;
    cursor: pointer;
}

input[type="radio"] {
    width: 16px;
    height: 16px;
    margin-right: 6px;
    accent-color: #927011;
    cursor: pointer;
}

/* Submit button */
.submit-button {
    width: 100%;
    padding: 12px;
    background-color: #927011;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
    margin-top: 20px;
}

.submit-button:hover {
    background-color: #785d0e;
}

/* Responsive Design */
@media (max-width: 480px) {
    .form-wrapper {
        padding: 10px;
    }
    .outer-frame {
        padding: 15px;
    }
    .form-row {
        flex-direction: column;
    }
}

</style>



<div class="form-wrapper">
    <div class="outer-frame">
        <div class="title-bar">Lập Lá Số Tử Vi</div>

        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="_csrfToken" value="<?php echo $csrfToken; ?>">

            <div class="form-row">
                <div class="form-group">
                    <label>Họ Tên</label>
                    <input type="text" name="full_name" placeholder="Nhập họ tên của bạn" required>
                </div>
                <div class="form-group">
                    <label>Số điện thoại</label>
                    <input type="text" name="phone_number" placeholder="Nhập số điện thoại" required>
                </div>
            </div>

            <div class="form-group">
                <label>Ngày sinh</label>
                <div class="form-row">
                    <select name="birth_day" required>
                        <option value="" disabled selected>Ngày</option>
                        <?php for($i = 1; $i <= 31; $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="birth_month" required>
                        <option value="" disabled selected>Tháng</option>
                        <?php for($i = 1; $i <= 12; $i++): ?>
                            <option value="<?= $i ?>">Tháng <?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                    <select name="birth_year" required>
                        <option value="" disabled selected>Năm</option>
                        <?php for($i = 1911; $i <= date('Y'); $i++): ?>
                            <option value="<?= $i ?>"><?= $i ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Giờ sinh</label>
                    <div class="form-row">
                        <select name="birth_hour" required>
                            <option value="" disabled selected>Giờ</option>
                            <?php for($i = 0; $i <= 23; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> Giờ</option>
                            <?php endfor; ?>
                        </select>
                        <select name="birth_minute" required>
                            <option value="" disabled selected>Phút</option>
                            <?php for($i = 0; $i <= 59; $i++): ?>
                                <option value="<?= $i ?>"><?= $i ?> Phút</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Giới tính</label>
                    <div class="radio-group">
                        <label class="radio-label">
                            <input type="radio" name="gender" value="Nam" required> Nam
                        </label>
                        <label class="radio-label">
                            <input type="radio" name="gender" value="Nữ" required> Nữ
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="Nhập địa chỉ email" required>
            </div>

            <button type="submit" class="submit-button">Lập lá số</button>
        </form>
    </div>
</div>

<?php getFooter(); ?>
