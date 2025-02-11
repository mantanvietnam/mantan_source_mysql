<?php


getHeader();
global $urlThemeActive;
?>
<style>
    /* Form container */
    .form-container {
        max-width: 400px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    /* Form groups */
    .form-group {
        margin-bottom: 20px;
    }

    /* Labels */
    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        color: #333;
    }

    /* Text inputs */
    input[type="text"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 14px;
    }

    input[type="text"]:focus {
        border-color: #927011;
        outline: none;
        box-shadow: 0 0 5px rgba(146, 112, 17, 0.2);
    }

    /* Selects */
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: white;
        font-size: 14px;
        cursor: pointer;
    }

    /* Date group (for date selects) */
    .date-group {
        display: flex;
        gap: 10px;
    }

    .date-group select {
        flex: 1;
    }

    /* Radio groups */
    .radio-group {
        margin: 10px 0;
    }

    .radio-group label {
        display: inline;
        margin-right: 20px;
        font-weight: normal;
    }

    input[type="radio"] {
        margin-right: 5px;
    }

    /* Submit button */
    .submit-btn {
        width: 100%;
        padding: 12px;
        background-color: #927011;
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
        background-color: #785d0e;
    }

    /* Readonly input */
    input[readonly] {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    /* Responsive design */
    @media (max-width: 480px) {
        .form-container {
            margin: 10px;
            padding: 15px;
        }

        .date-group {
            flex-direction: column;
            gap: 5px;
        }
    }
</style>


<form method="POST" action="">
    <!-- Họ tên -->
    <div>
        <label>Họ Tên</label>
        <input type="text" name="hoTen" placeholder="Nhập họ tên..." value="<?php echo isset($_POST['hoTen']) ? htmlspecialchars($_POST['hoTen']) : ''; ?>">
    </div>

    <!-- Ngày sinh -->
    <div>
        <label>Ngày sinh</label>
        <select name="ngay">
            <?php for($i = 1; $i <= 31; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['ngay']) && $_POST['ngay'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>

        <select name="thang">
            <?php for($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['thang']) && $_POST['thang'] == $i) ? 'selected' : '' ?>>Tháng <?= $i ?></option>
            <?php endfor; ?>
        </select>

        <select name="nam">
            <?php for($i = 1911; $i <= 2024; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['nam']) && $_POST['nam'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <!-- Loại lịch -->
    <div>
        <input type="radio" name="lichType" value="duong" <?= (!isset($_POST['lichType']) || $_POST['lichType'] == 'duong') ? 'checked' : '' ?>> Lịch dương
        <input type="radio" name="lichType" value="am" <?= (isset($_POST['lichType']) && $_POST['lichType'] == 'am') ? 'checked' : '' ?>> Lịch âm
    </div>

    <!-- Giờ sinh -->
    <div>
        <label>Giờ sinh</label>
        <select name="timezone">
            <option value="GMT+7">GMT +7</option>
        </select>

        <select name="gio">
            <?php for($i = 0; $i <= 23; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['gio']) && $_POST['gio'] == $i) ? 'selected' : '' ?>><?= $i ?> Giờ</option>
            <?php endfor; ?>
        </select>

        <select name="phut">
            <?php for($i = 0; $i <= 59; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['phut']) && $_POST['phut'] == $i) ? 'selected' : '' ?>><?= $i ?> Phút</option>
            <?php endfor; ?>
        </select>
    </div>

    <!-- Giới tính -->
    <div>
        <input type="radio" name="gioiTinh" value="nam" <?= (!isset($_POST['gioiTinh']) || $_POST['gioiTinh'] == 'nam') ? 'checked' : '' ?>> Nam
        <input type="radio" name="gioiTinh" value="nu" <?= (isset($_POST['gioiTinh']) && $_POST['gioiTinh'] == 'nu') ? 'checked' : '' ?>> Nữ
    </div>

    <!-- Năm xem -->
    <div>
        <label>Năm xem</label>
        <input type="text" name="namXem" value="2025" readonly>
    </div>

    <!-- Tháng xem -->
    <div>
        <label>Tháng xem (Âm lịch)</label>
        <select name="thangXem">
            <?php for($i = 1; $i <= 12; $i++): ?>
                <option value="<?= $i ?>" <?= (isset($_POST['thangXem']) && $_POST['thangXem'] == $i) ? 'selected' : '' ?>>Tháng <?= $i ?></option>
            <?php endfor; ?>
        </select>
    </div>

    <button type="submit">Lập lá số</button>
</form>

<?php getFooter();?>