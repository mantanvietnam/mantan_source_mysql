<!-- Helpers -->
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light"><a href="/plugins/admin/go_draw-view-admin-category-listCategoryAdmin.php">Combo</a> /</span>
        Thông tin combo
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
                                        <div class="col-md-6">
                                            <img id="show-image" src="<?php echo @$data->image ?: 'https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg'; ?>" alt=""
                                                 style="max-width: 400px; max-height: 400px"
                                            />
                                        </div>
                                    </div>

                                    <div>
                                        <label class="form-label">Danh sách sản phẩm</label>
                                        <div id="product-list">
                                            <div class="product-item row mb-3" id="product-item-1">
                                                <div class="col-md-6">
                                                    <label class="form-label">Tên sản phẩm</label>
                                                    <select name="product_item_id[1]" class="form-select color-dropdown">
                                                        <option value="1" selected>SP 1
                                                        </option>
                                                        <option value="1" selected>SP 1
                                                        </option>
                                                    </select>

                                                    <label class="form-label">Số lượng</label>
                                                    <input required type="number" class="form-control" name="product_item_amount[1]" value="0" />

                                                    <label class="form-label">Giá</label>
                                                    <input required type="number" class="form-control" name="product_item_price[1]" value="0" />
                                                </div>

                                                <div class="col-md-4" style="align-items: center; display: flex; justify-content: center">
                                                    <div>
                                                        <label class="form-label">Hình ảnh minh họa</label>
                                                        <img id="show-image" src="https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg" alt=""
                                                             style="max-width: 200px; max-height: 200px"
                                                        />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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

    let productCount = 1;
    $('#btn-add-product').on('click', function () {
        const nextProduct = productCount + 1;
        $(`#product-item-${productCount}`).after(`
            <div class="product-item row mb-3" id="product-item-${nextProduct}">
                <div class="col-md-6">
                <label class="form-label">Tên sản phẩm</label>
                    <select name="product_item_id[${nextProduct}]" class="form-select color-dropdown">
                        <option value="1" selected>SP 1
                        </option>
                        <option value="1" selected>SP 1
                        </option>
                    </select>

                    <label class="form-label">Số lượng</label>
                    <input required type="number" class="form-control" name="product_item_amount[${nextProduct}]" value="0" />

                    <label class="form-label">Giá</label>
                    <input required type="number" class="form-control" name="product_item_price[${nextProduct}]" value="0" />
                </div>

                <div class="col-md-4" style="align-items: center; display: flex; justify-content: center">
                    <div>
                        <label class="form-label">Hình ảnh minh họa</label>
                        <img id="show-image" src="https://godraw.2top.vn/plugins/go_draw/view/image/default-image.jpg" alt=""
                             style="max-width: 200px; max-height: 200px"
                        />
                    </div>
                </div>

                <div class="col-md-2" style="align-items: center; display: flex; justify-content: center">
                    <p><button class="btn btn-primary btn-remove-product" type="button" data-remove="product-item-${nextProduct}"
                        ><i class='bx bx-minus'></i>
                    </button></p>
                </div>
            </div>`);
        productCount = nextProduct;
    });

    $(document).on('click', '.btn-remove-product', function () {
        const removeId = $(this).data('remove');
        $(`#${removeId}`).remove();
        productCount--;
    })
</script>
