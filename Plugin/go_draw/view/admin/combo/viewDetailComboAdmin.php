<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php">Combo</a> /</span>
        Thông tin combo
        <?php
            if (isset($mess)) {
                print_r($mess);
            }
        ?>
    </h4>

    <!-- Basic Layout -->
    <div class="row">
        <div class="col-xl">
            <div class="card mb-12">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Thông tin combo</h5>
                </div>
                <div class="card-body">
                    <p><?php echo $mess ?? '';?></p>
                    <p id="alert-message"><?php echo $mess ?? '';?></p>
                    <?= $this->Form->create(); ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="nav-align-top mb-4">

                                <div class="tab-content">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Tên combo (*)</label>
                                            <input required type="text" class="form-control phone-mask" name="name" id="name" value="<?php echo @$data->name;?>" />
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Giá</label>
                                            <input required type="number" class="form-control" name="price" id="price" value="<?php echo @$data->price;?>" />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="form-label">Hình minh họa</label>
                                            <div class="mb-3">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" aria-label="" aria-describedby="btnGroupAddonUpload"
                                                           name="image" id="image" value="<?php echo @$data->image;?>"
                                                    >
                                                    <div class="input-group-prepend">
                                                        <div class="btn btn-secondary input-group-text" onclick="BrowseServerImage();" id="btnGroupAddonUpload">Upload</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <img id="show-image" src="<?php echo @$data->image ?: 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg'; ?>" alt=""
                                                 style="max-width: 400px; max-height: 400px"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Danh sách sản phẩm</label>
                                        <div id="product-list">
                                            <?php foreach (@$comboProduct as $key => $item): ?>
                                            <div class="product-item row mb-3" id="<?php echo 'product-item-'.$key; ?>">
                                                <div class="col-md-6">
                                                    <input type="hidden" id="<?php echo 'combo-product-id['.$key.']'; ?>" value="<?php echo $item->id; ?>">
                                                    <label class="form-label">Tên sản phẩm</label>
                                                    <select class="form-select color-dropdown select-product" data-target="<?php echo $key; ?>"
                                                            name="<?php echo 'product-item-id['.$key.']'; ?>" id="<?php echo 'product-item-id['.$key.']'; ?>"
                                                    >
                                                        <?php foreach (@$productList as $product): ?>
                                                            <option value="<?php echo $product->id; ?>" <?php if ($product->id === $item->id) echo 'selected'; ?>><?php echo $product->name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>

                                                    <label class="form-label">Số lượng</label>
                                                    <input required type="number" class="form-control" value="<?php echo $item->ComboProducts['amount']; ?>"
                                                           name="<?php echo 'product-item-amount['.$key.']'; ?>" id="<?php echo 'product-item-amount['.$key.']'; ?>"
                                                    />
                                                </div>

                                                <div class="col-md-4" style="align-items: center; display: flex; justify-content: center">
                                                    <div>
                                                        <label class="form-label d-block">Hình ảnh minh họa</label>
                                                        <img src="<?php echo !empty($item->image) ? $item->image : "https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg"; ?>"
                                                             alt="" style="max-width: 200px; max-height: 200px" id="<?php echo 'product-item-image['.$key.']'; ?>"
                                                        />
                                                    </div>
                                                </div>

                                                <div class="col-md-2" style="align-items: center; display: flex; justify-content: center">
                                                    <div style="margin-right: 2px"><button class="btn btn-primary btn-save-product" type="button" data-target="<?php echo $key; ?>">Lưu
                                                    </button></div>
                                                    <div style="margin-left: 2px"><button class="btn btn-danger btn-remove-product" type="button" data-target="<?php echo $key; ?>">Xóa
                                                    </button></div>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div id="product-ref"></div>
                                        <p><button class="btn btn-primary" id="btn-add-product" type="button"><i class='bx bx-plus'></i></button></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Lưu</button>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/ckfinder/ckfinder.js"></script>
</div>
<?php
    global $csrfToken;
?>
<script type="text/javascript">
    function BrowseServerImage(number = 0)
    {
        let finder = new CKFinder();
        finder.basePath = "../";
        finder.selectActionFunction = SetFileFieldImage;
        finder.popup();
    }

    function SetFileFieldImage(fileUrl)
    {
        $("#image").val(fileUrl);
        $("#show-image").attr('src', fileUrl);
    }

    let productCount = Number('<?php echo isset($comboProduct) ? count($comboProduct) : 0;?>');
    const productOption = `<?php foreach (@$productList as $product): ?>
                                <option value="<?php echo $product->id; ?>" selected><?php echo $product->name; ?></option>
                            <?php endforeach; ?>`;

    $('#btn-add-product').on('click', function () {
        $('#product-ref').before(`
            <div class="product-item row mb-3" id="product-item-${productCount}">
                <div class="col-md-6">
                <input type="hidden" id="combo-product-id[${productCount}]" value="">
                <label class="form-label">Tên sản phẩm</label>
                    <select class="form-select color-dropdown select-product" data-target="${productCount}"
                        name="product-item-id[${productCount}]" id="product-item-id[${productCount}]"
                    >
                        ${productOption}
                    </select>

                    <label class="form-label">Số lượng</label>
                    <input required type="number" class="form-control" name="product-item-amount[${productCount}]" id="product-item-amount[${productCount}]" />
                </div>

                <div class="col-md-4" style="align-items: center; display: flex; justify-content: center">
                    <div>
                        <label class="form-label">Hình ảnh minh họa</label>
                        <img src="https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg" id="product-item-image[${productCount}]"
                             style="max-width: 200px; max-height: 200px" alt=""
                        />
                    </div>
                </div>

                <div class="col-md-2" style="align-items: center; display: flex; justify-content: center">
                    <div style="margin-right: 2px"><button class="btn btn-primary btn-save-product" type="button" data-target="${productCount}">Lưu
                    </button></div>
                    <div style="margin-left: 2px"><button class="btn btn-danger btn-remove-product" type="button" data-target="${productCount}">Xóa
                    </button></div>
                </div>
            </div>`);
        productCount++;
    });

    $(document).on('click', '.btn-remove-product', function () {
        const removeId = $(this).data('target');
        const id = $(document.getElementById(`combo-product-id[${removeId}]`)).val();
        const token = "<?php echo $csrfToken;?>";
        if (id) {
            $.ajax({
                method: "POST",
                url: '/apis/deleteComboProductAdminApi',
                headers: {'X-CSRF-Token': token},
                data: { id },
                success: function (result) {
                    let message = '';
                    if (!result.code) {
                        message = `<p class="text-success">${result.messages}</p>`;
                    } else {
                        message = `<p class="text-danger">${result.messages}</p>`;
                    }
                    $('#alert-message').empty();
                    $('#alert-message').append(message);
                    $(document.getElementById(remove)).remove();
                },
                error: function () {
                    $('#alert-message').empty();
                    $('#alert-message').append(`<p class="text-danger">Đã xảy ra lỗi</p>`);
                },
                complete: function () {
                    setTimeout(function () {
                        $('#alert-message').empty();
                    }, 3000);
                }
            });
        }
        $(document.getElementById(`product-item-${removeId}`)).remove();
        productCount--;
    })

    $(document).on('change', '.select-product', function () {
        const productId = $(this).val();
        const token = "<?php echo $csrfToken;?>";
        const target = $(this).data('target');
        if (productId) {
            $.ajax({
                method: "POST",
                url: '/apis/getProductDetailAdminApi',
                headers: {'X-CSRF-Token': token},
                data: {
                    id: productId
                },
                success: function (result) {
                    const image = result.data.image ? result.data.image : "https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg";
                    $(document.getElementById(`product-item-image[${target}]`)).attr('src', image);
                },
                error: function () {
                },
            });
        }
    })
</script>
