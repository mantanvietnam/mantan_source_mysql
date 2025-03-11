<?php 
    global $settingThemes;
    getHeader();
?>
<style>
  .background-header {
    background-image: none !important;
  }

  .nav-projectpage a {
    color: black !important;
  }

  .setcolor {
    color: #333 !important;
  }

  .setcolor a {
    color: #333 !important;
  }

  .set-backgroundcontact {
    background-color: #182c77;
  }
</style>

<div class="py-10 px-4 sm:px-6 md:container xl:px-20 bg-white text-black font-plus fade-in">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold mb-8 text-[#142A72]">
            So sánh bất động sản Vinhomes
        </h1>

        <div id="propertyListContainer" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <?php 
            // Hiển thị các dự án đã chọn để so sánh
            if (!empty($compareData)) {
                foreach ($compareData as $index => $project) { 
            ?>
                <div id="property<?= $index+1 ?>" class="bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                    <div class="relative">
                        <img src="<?= $project['image'] ?>" alt="<?= $project['name'] ?>" class="h-48 w-full object-cover" onerror="this.src=''" />
                        <button class="remove-property absolute top-2 right-2 bg-white rounded-full p-1 text-gray-500 hover:text-gray-700" data-project-id="<?= $project['id'] ?>">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        <h5 class="text-lg font-semibold mb-2"><?= $project['name'] ?></h5>
                        <p class="text-xl font-bold text-[#FF5722] mb-2"><?= $project['price'] ?></p>
                        <a href="#" class="text-[#142A72] hover:underline change-property" data-bs-toggle="modal" data-bs-target="#realEstateModal" data-position="<?= $index+1 ?>">Đổi bất động sản khác</a>
                    </div>
                </div>
            <?php 
                }
            }
            
            // Hiển thị các ô trống để thêm dự án mới (tối đa 3 dự án)
            $emptySlots = 3 - (count($compareData ?? []));
            for ($i = 0; $i < $emptySlots; $i++) { 
            ?>
                <div data-bs-toggle="modal" data-bs-target="#realEstateModal" data-position="<?= count($compareData) + $i + 1 ?>" class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-4 h-full min-h-[250px] hover:border-gray-400 cursor-pointer transition-all add-property-btn">
                    <div class="mb-3 text-gray-400">
                        <i class="fas fa-plus-circle text-5xl"></i>
                    </div>
                    <h5 class="text-lg font-medium text-gray-600">Chọn bất động sản</h5>
                </div>
            <?php } ?>
        </div>

        <!-- Modal chọn bất động sản -->
        <div class="modal fade" id="realEstateModal" tabindex="-1" aria-labelledby="realEstateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="realEstateModalLabel">
                            Chọn bất động sản để so sánh
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" id="searchBox" class="form-control mb-3" placeholder="Nhập tìm kiếm..." />
                        <ul class="list-group" id="propertyList">
                            <?php foreach ($allProjects as $project) { ?>
                                <li class="list-group-item project-item" data-project-id="<?= $project->id ?>">
                                    <div class="d-flex align-items-center">
                                        <img src="<?= $project->image ?>" alt="<?= $project->name ?>" class="me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0"><?= $project->name ?></h6>
                                            <small class="text-muted"><?= $project->status ?></small>
                                        </div>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tùy chọn hiển thị -->
        <div class="flex flex-wrap gap-4 mb-8">
            <div class="flex items-center">
                <input class="mr-2 h-4 w-4" type="checkbox" id="showImportant" checked />
                <label for="showImportant">Chỉ hiển thị thông số quan trọng</label>
            </div>
            <div class="flex items-center">
                <input class="mr-2 h-4 w-4" type="checkbox" id="showDifferences" />
                <label for="showDifferences">Chỉ hiển thị các điểm khác biệt</label>
            </div>
        </div>

        <?php if (!empty($compareData)) { ?>
        <!-- Bảng so sánh giá -->
        <div id="priceTableContainer" class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="flex justify-between items-center p-4 border-b">
                <h5 class="font-semibold text-lg">Giá bất động sản</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50"></th>
                            <?php foreach ($compareData as $project) { ?>
                                <th class="p-4"><?= $project['name'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Giá niêm yết</th>
                            <?php foreach ($compareData as $project) { ?>
                                <td class="p-4"><?= $project['price'] ?></td>
                            <?php } ?>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bảng so sánh thông tin chi tiết -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-4 border-b">
                <h5 class="font-semibold text-lg">Thông tin chi tiết</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50"></th>
                            <?php foreach ($compareData as $project) { ?>
                                <th class="p-4"><?= $project['name'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($compareFeatures as $key => $label) { ?>
                            <tr class="border-b feature-row" data-feature="<?= $key ?>">
                                <th class="text-left p-4 bg-gray-50"><?= $label ?></th>
                                <?php foreach ($compareData as $project) { ?>
                                    <td class="p-4"><?= $project[$key] ?? '' ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bảng so sánh vị trí -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-4 border-b">
                <h5 class="font-semibold text-lg">Vị trí & Tiện ích</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50"></th>
                            <?php foreach ($compareData as $project) { ?>
                                <th class="p-4"><?= $project['name'] ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Hiển thị thông tin vị trí -->
                        <?php foreach ($locationFeatures as $key => $label) { ?>
                            <tr class="border-b location-row" data-feature="<?= $key ?>">
                                <th class="text-left p-4 bg-gray-50"><?= $label ?></th>
                                <?php foreach ($compareData as $project) { ?>
                                    <td class="p-4"><?= $project[$key] ?? '' ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                        
                        <!-- Hiển thị các tiện ích -->
                        <?php 
                        // Tạo danh sách các tiện ích duy nhất từ tất cả các dự án
                        $allAmenities = [];
                        foreach ($compareData as $project) {
                            if (!empty($project['amenities'])) {
                                foreach ($project['amenities'] as $amenity) {
                                    $allAmenities[$amenity['title']] = $amenity['title'];
                                }
                            }
                        }
                        
                        // Hiển thị từng tiện ích
                        foreach ($allAmenities as $amenityTitle) { 
                        ?>
                            <tr class="border-b amenity-row" data-amenity="<?= $amenityTitle ?>">
                                <th class="text-left p-4 bg-gray-50"><?= $amenityTitle ?></th>
                                <?php foreach ($compareData as $project) { 
                                    $hasAmenity = false;
                                    if (!empty($project['amenities'])) {
                                        foreach ($project['amenities'] as $amenity) {
                                            if ($amenity['title'] == $amenityTitle) {
                                                $hasAmenity = true;
                                                break;
                                            }
                                        }
                                    }
                                ?>
                                    <td class="p-4 <?= $hasAmenity ? 'text-green-500' : 'text-red-500' ?>">
                                        <?php if ($hasAmenity) { ?>
                                            <i class="fas fa-check"></i>
                                        <?php } else { ?>
                                            <i class="fas fa-times"></i>
                                        <?php } ?>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php } ?>

        <!-- Nút liên hệ tư vấn -->
        <div class="text-center mb-8">
            <a href="/contact" class="inline-block px-8 py-3 rounded-xl text-white transition duration-300 bg-gradient-to-r from-[#182c77] to-[#6274bb] hover:from-[#6274bb] hover:to-[#182c77] font-medium">
                Liên hệ tư vấn ngay
            </a>
        </div>
    </div>
</div>
<?php getFooter();?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const propertyListContainer = document.getElementById("propertyListContainer");
        const priceTableContainer = document.getElementById("priceTableContainer");
        const removeButtons = document.querySelectorAll(".remove-property");
        const showImportantCheckbox = document.getElementById("showImportant");
        const showDifferencesCheckbox = document.getElementById("showDifferences");
        const searchBox = document.getElementById("searchBox");
        const projectItems = document.querySelectorAll(".project-item");
        const addPropertyButtons = document.querySelectorAll(".add-property-btn");
        const changePropertyLinks = document.querySelectorAll(".change-property");
        
        // Biến để lưu vị trí của dự án cần thay đổi
        let currentProjectPosition = 0;
        
        // Kiểm tra số lượng dự án và hiển thị/ẩn bảng giá
        function checkProperties() {
            const properties = propertyListContainer.querySelectorAll(".bg-white.shadow-md").length;
            if (properties > 0) {
                if (priceTableContainer) {
                    priceTableContainer.classList.remove("hidden");
                }
            } else {
                if (priceTableContainer) {
                    priceTableContainer.classList.add("hidden");
                }
            }
        }
        
        // Xử lý sự kiện xóa dự án
        removeButtons.forEach(button => {
            button.addEventListener("click", function () {
                const projectId = this.getAttribute("data-project-id");
                const propertyElement = this.closest(".bg-white.shadow-md");
                
                // Tạo phần tử mới để thay thế
                const newElement = document.createElement("div");
                newElement.setAttribute("data-bs-toggle", "modal");
                newElement.setAttribute("data-bs-target", "#realEstateModal");
                newElement.setAttribute("data-position", propertyElement.id.replace("property", ""));
                newElement.className = "border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-4 h-full min-h-[250px] hover:border-gray-400 cursor-pointer transition-all add-property-btn";
                newElement.innerHTML = `
                    <div class="mb-3 text-gray-400">
                        <i class="fas fa-plus-circle text-5xl"></i>
                    </div>
                    <h5 class="text-lg font-medium text-gray-600">Chọn bất động sản</h5>
                `;
                
                // Thay thế phần tử cũ bằng phần tử mới
                propertyElement.replaceWith(newElement);
                
                // Cập nhật URL để xóa dự án khỏi so sánh
                updateUrl();
                
                // Kiểm tra số lượng dự án
                checkProperties();
                
                // Nếu không còn dự án nào, tải lại trang
                const remainingProperties = propertyListContainer.querySelectorAll(".bg-white.shadow-md").length;
                if (remainingProperties === 0) {
                    window.location.reload();
                }
            });
        });
        
        // Xử lý sự kiện khi nhấp vào nút thêm dự án
        addPropertyButtons.forEach(button => {
            button.addEventListener("click", function() {
                currentProjectPosition = this.getAttribute("data-position");
            });
        });
        
        // Xử lý sự kiện khi nhấp vào liên kết thay đổi dự án
        changePropertyLinks.forEach(link => {
            link.addEventListener("click", function(e) {
                e.preventDefault();
                currentProjectPosition = this.getAttribute("data-position");
            });
        });
        
        // Xử lý sự kiện khi chọn dự án từ danh sách
        projectItems.forEach(item => {
            item.addEventListener("click", function() {
                const projectId = this.getAttribute("data-project-id");
                
                // Cập nhật URL với dự án đã chọn
                const currentUrl = new URL(window.location.href);
                currentUrl.searchParams.set("project" + currentProjectPosition, projectId);
                
                // Chuyển hướng đến URL mới
                window.location.href = currentUrl.toString();
            });
        });
        
        // Hàm cập nhật URL khi xóa dự án
        function updateUrl() {
            const currentUrl = new URL(window.location.href);
            const properties = propertyListContainer.querySelectorAll(".bg-white.shadow-md");
            
            // Xóa tất cả các tham số project
            currentUrl.searchParams.delete("project1");
            currentUrl.searchParams.delete("project2");
            currentUrl.searchParams.delete("project3");
            
            // Thêm lại các tham số cho các dự án còn lại
            properties.forEach((property, index) => {
                const projectId = property.querySelector(".remove-property").getAttribute("data-project-id");
                currentUrl.searchParams.set("project" + (index + 1), projectId);
            });
            
            // Cập nhật URL mà không tải lại trang
            window.history.pushState({}, '', currentUrl.toString());
        }
        
        // Xử lý tìm kiếm dự án
        searchBox.addEventListener("input", function() {
            const searchText = this.value.toLowerCase();
            
            projectItems.forEach(item => {
                const itemName = item.querySelector("h6").textContent.toLowerCase();
                if (itemName.includes(searchText)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });
        
        // Xử lý chỉ hiển thị thông số quan trọng
        showImportantCheckbox.addEventListener("change", function() {
            const featureRows = document.querySelectorAll(".feature-row");
            const locationRows = document.querySelectorAll(".location-row");
            
            if (this.checked) {
                // Hiển thị chỉ các thông số quan trọng
                featureRows.forEach(row => {
                    const feature = row.getAttribute("data-feature");
                    if (Object.keys(<?= json_encode($compareFeatures) ?>).includes(feature)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
                
                locationRows.forEach(row => {
                    const feature = row.getAttribute("data-feature");
                    if (Object.keys(<?= json_encode($locationFeatures) ?>).includes(feature)) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                });
            } else {
                // Hiển thị tất cả thông số
                featureRows.forEach(row => {
                    row.style.display = "";
                });
                
                locationRows.forEach(row => {
                    row.style.display = "";
                });
            }
        });
        
        // Xử lý chỉ hiển thị các điểm khác biệt
        showDifferencesCheckbox.addEventListener("change", function() {
            const allRows = document.querySelectorAll(".feature-row, .location-row, .amenity-row");
            
            if (this.checked) {
                // Hiển thị chỉ các hàng có giá trị khác nhau
                allRows.forEach(row => {
                    const cells = row.querySelectorAll("td");
                    let allSame = true;
                    let firstValue = cells[0]?.textContent.trim();
                    
                    for (let i = 1; i < cells.length; i++) {
                        if (cells[i]?.textContent.trim() !== firstValue) {
                            allSame = false;
                            break;
                        }
                    }
                    
                    row.style.display = allSame ? "none" : "";
                });
            } else {
                // Hiển thị tất cả các hàng
                allRows.forEach(row => {
                    row.style.display = "";
                });
            }
            
            // Kết hợp với lựa chọn chỉ hiển thị thông số quan trọng
            if (showImportantCheckbox.checked) {
                showImportantCheckbox.dispatchEvent(new Event("change"));
            }
        });
        
        // Kiểm tra ban đầu
        checkProperties();
    });
</script>