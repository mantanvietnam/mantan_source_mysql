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

.setcolor, .setcolor a {
    color: #333 !important;
}

.set-backgroundcontact {
    background-color: #182c77;
}

.price-details-content table {
    width: 100%;
    border-collapse: collapse;
}

.price-details-content th, 
.price-details-content td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.price-details-content th {
    background-color: #f2f2f2;
}
/* Nâng cấp giao diện modal */
/* .modal {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1055;
    display: none;
    width: 100%;
    height: 100%;
    overflow-x: hidden;
    overflow-y: auto;
    background: rgba(0, 0, 0, 0.5);
}

.modal-dialog {
    position: relative;
    width: auto;
    margin: 1.75rem auto;
    pointer-events: none;
}

.modal-content {
    border-radius: 12px;
    overflow: hidden;
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(-20px); }
    to { opacity: 1; transform: translateY(0); }
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 12px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

th {
    background: #f4f4f4;
    font-weight: bold;
}

td {
    background: white;
}

tr:hover td {
    background: #f8f9fa;
}

.property-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease-in-out;
}

.property-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.contact-btn {
    display: inline-block;
    padding: 12px 24px;
    font-size: 16px;
    font-weight: bold;
    color: white;
    background: linear-gradient(45deg, #182c77, #6274bb);
    border-radius: 8px;
    transition: 0.3s;
}

.contact-btn:hover {
    background: linear-gradient(45deg, #6274bb, #182c77);
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .grid-cols-3 {
        grid-template-columns: repeat(2, 1fr);
    }

    .property-card {
        margin-bottom: 10px;
    }
}

@media (max-width: 480px) {
    .grid-cols-3 {
        grid-template-columns: repeat(1, 1fr);
    }
} */

</style>

<div class="py-10 px-4 sm:px-6 md:container xl:px-20 bg-white text-black font-plus fade-in">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-2xl md:text-3xl font-bold mb-8 text-[#142A72]">
            So sánh bất động sản Vinhomes
        </h1>

        <div id="propertyListContainer" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <?php
            if (!empty($compareData)) {
                foreach ($compareData as $index => $project) {
            ?>
                    <div id="property<?= $index + 1 ?>" class="bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg">
                        <div class="relative">
                            <img src="<?= $project['image'] ?>" alt="<?= $project['name'] ?>" class="h-48 w-full object-cover" onerror="this.src=''" />
                            <button class="remove-property absolute top-2 right-2 bg-white rounded-full p-1 text-gray-500 hover:text-gray-700" data-project-id="<?= $project['id'] ?>">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <div class="p-4">
                            <h5 class="text-lg font-semibold mb-2"><?= $project['name'] ?></h5>
                            <p class="text-xl font-bold text-[#FF5722] mb-2"><?= $project['price'] ?></p>
                            <a href="#" class="text-[#142A72] hover:underline change-property" data-bs-toggle="modal" data-bs-target="#realEstateModal" data-position="<?= $index + 1 ?>">Đổi bất động sản khác</a>
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

        <div class="modal fade" id="realEstateModal" tabindex="-1" aria-labelledby="realEstateModalLabel" aria-hidden="true" data-position="">
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

        <!-- Bảng Giá Bất Động Sản -->
        <div
            id="priceTableContainer"
            class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="flex justify-between items-center p-4 border-b">
                <h5 class="font-semibold text-lg">Giá bất động sản</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <tbody>
                        <tr class="border-b">
                        <th class="text-left p-4 bg-gray-50">Bảng giá</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bảng Thông Tin Chi Tiết -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-4 border-b">
                <h5 class="font-semibold text-lg">Thông tin chi tiết</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <tbody>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Chủ đàu tư</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Mô tả dự án</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Diện tích</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Địa chỉ</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Hướng</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Loại mô hình</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr>
                            <th class="text-left p-4 bg-gray-50">Hình thức sở hữu</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bảng Vị Trí & Tiện Ích -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
            <div class="p-4 border-b">
                <h5 class="font-semibold text-lg">Vị trí & Tiện ích</h5>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <tbody>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Không gian</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">
                                Dịch vụ tiện ích
                            </th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Vị trí thương mại</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                        <tr class="border-b">
                            <th class="text-left p-4 bg-gray-50">Khác</th>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                            <td class="p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Nút liên hệ tư vấn -->
        <div class="text-center mb-8">
            <a href="/contact" class="inline-block px-8 py-3 rounded-xl text-white transition duration-300 bg-gradient-to-r from-[#182c77] to-[#6274bb] hover:from-[#6274bb] hover:to-[#182c77] font-medium">
                Liên hệ tư vấn ngay
            </a>
        </div>
    </div>
</div>
<?php getFooter(); ?>

<!-- Bootstrap JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let compareData = [];
        document.addEventListener("click", function(event) {
            let slot = event.target.closest(".add-property-btn, .change-property");
            if (slot) {
                let position = slot.getAttribute("data-position");
                let modal = document.getElementById("realEstateModal");
                modal.setAttribute("data-position", position);
            }
        });

        document.addEventListener("click", function(event) {
            let selectedItem = event.target.closest(".project-item");
            if (selectedItem) {
                let projectId = selectedItem.getAttribute("data-project-id");
                let position = document.getElementById("realEstateModal").getAttribute("data-position");

                addPropertyToComparison(projectId, position);

                let modalInstance = bootstrap.Modal.getInstance(document.getElementById("realEstateModal"));
                modalInstance.hide();
            }
        });

        document.addEventListener("click", function(event) {
    if (event.target.classList.contains("view-full-description")) {
        event.preventDefault();
        const fullDescription = decodeURIComponent(event.target.getAttribute("data-full-description"));

        const modalHtml = `
            <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center description-modal">
                <div class="bg-white rounded-lg p-6 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-[#142A72]">Mô tả chi tiết</h3>
                        <button class="close-modal text-gray-500 hover:text-gray-700">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    <div class="description-content">
                        ${fullDescription}
                    </div>
                    <div class="mt-4 text-center">
                        <button class="close-modal px-4 py-2 bg-[#142A72] text-white rounded-lg hover:bg-[#0e1d4d]">
                            Đóng
                        </button>
                    </div>
                </div>
            </div>
        `;

        document.body.insertAdjacentHTML('beforeend', modalHtml);

        document.querySelectorAll(".close-modal").forEach(button => {
            button.addEventListener("click", () => {
                document.querySelector(".description-modal").remove();
            });
        });
    }
});

        function updateComparisonTables(properties) {
            console.log("🔄 Đang cập nhật bảng so sánh với dữ liệu:", properties);

            // Đặt lại tất cả các ô trống trong bảng
            document.querySelectorAll("table td").forEach(cell => {
                cell.innerHTML = "";
            });
            
            // Lấy ra tất cả các bảng
            const tables = document.querySelectorAll("table.w-full.border-collapse");
            
            if (tables.length < 3) {
                console.error("❌ Không tìm thấy đủ bảng so sánh trong DOM!");
                return;
            }
            
            // Bảng giá - bảng thứ nhất
            const priceTable = tables[0];
            const priceRows = priceTable.querySelectorAll("tr");
            
            // Bảng thông tin chi tiết - bảng thứ hai
            const detailsTable = tables[1];
            const detailsRows = detailsTable.querySelectorAll("tr");
            
            // Bảng vị trí & tiện ích - bảng thứ ba
            const amenitiesTable = tables[2];
            const amenitiesRows = amenitiesTable.querySelectorAll("tr");

            // Kiểm tra xem có tìm thấy các hàng không
            if (!priceRows.length || !detailsRows.length || !amenitiesRows.length) {
                console.error("❌ Không tìm thấy các hàng trong bảng so sánh!");
                return;
            }

            // Log thông tin debug
            console.log("Số hàng trong bảng giá:", priceRows.length);
            console.log("Số hàng trong bảng chi tiết:", detailsRows.length);
            console.log("Số hàng trong bảng tiện ích:", amenitiesRows.length);

            // Cập nhật từng bảng với dữ liệu dự án
            for (let i = 0; i < Math.min(properties.length, 3); i++) {
                const property = properties[i];
                if (!property || !property.id) continue;

                const columnIndex = i + 2;

                // Bảng giá
                if (priceRows.length > 0) {
                    const priceRow = priceRows[0];
                    const priceCell = priceRow.querySelector(`td:nth-child(${columnIndex})`);
                    if (priceCell) {
                        if (property.price && property.price.includes("<table") || 
                            (typeof property.priceDetail === 'string' && property.priceDetail.includes("<table"))) {

                            // Chỉ hiển thị link "Xem chi tiết"
                            priceCell.innerHTML = `
                                <div>
                                    <span class="text-[#FF5722] font-bold">${property.price ? '' : ''}</span>
                                    <a href="#" class="block text-[#142A72] hover:underline mt-2 view-price-details" 
                                        data-project-id="${property.id}"
                                        data-price-html="${encodeURIComponent(property.priceDetail || property.price || '')}"
                                        data-project-name="${property.name}">Xem chi tiết giá</a>
                                </div>
                            `;
                        } else {
                            // Nếu không phải bảng phức tạp, hiển thị giá trực tiếp
                            priceCell.innerHTML = property.price || 'Liên hệ';
                        }
                    }
                }

            // Bảng thông tin chi tiết
            if (detailsRows.length >= 7) {
                        // Chủ đầu tư
                        updateCellByRowAndColumn(detailsRows[0], columnIndex, property.investor || '');
                        
                        // Mô tả dự án
                        updateCellByRowAndColumn(detailsRows[1], columnIndex, property.description || '');
                        
                        // Diện tích
                        updateCellByRowAndColumn(detailsRows[2], columnIndex, property.acreage || '');
                        
                        // Địa chỉ
                        updateCellByRowAndColumn(detailsRows[3], columnIndex, property.address || '');
                        
                        // Hướng
                        updateCellByRowAndColumn(detailsRows[4], columnIndex, property.direction || '');
                        
                        // Loại mô hình
                        updateCellByRowAndColumn(detailsRows[5], columnIndex, property.type || '');
                        
                        // Hình thức sở hữu
                        updateCellByRowAndColumn(detailsRows[6], columnIndex, property.ownership_type || '');
                    }

                    // Bảng vị trí & tiện ích
                    if (amenitiesRows.length >= 4) {
                        // Không gian
                        updateCellByRowAndColumn(amenitiesRows[0], columnIndex, property.space || '');
                        
                        // Dịch vụ tiện ích
                        updateCellByRowAndColumn(amenitiesRows[1], columnIndex, formatAmenities(property.amenities));
                        
                        // Vị trí thương mại
                        updateCellByRowAndColumn(amenitiesRows[2], columnIndex, property.commercialLocation || '');
                        
                        // Khác
                        updateCellByRowAndColumn(amenitiesRows[3], columnIndex, property.others || '');
                    }
                }
                addPriceDetailsEvents();
                console.log("✅ Cập nhật bảng so sánh thành công!");
            
        }

        function addPriceDetailsEvents() {
            document.querySelectorAll(".view-price-details").forEach(link => {
                link.removeEventListener("click", showPriceDetailsModal);
                link.addEventListener("click", showPriceDetailsModal);
            });
        }

        function showPriceDetailsModal(event) {
            event.preventDefault();

            const priceHtml = decodeURIComponent(this.getAttribute("data-price-html"));
            const projectName = this.getAttribute("data-project-name");

            const modalHtml = `
                <div class="fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center price-details-modal">
                    <div class="bg-white rounded-lg p-6 max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-xl font-bold text-[#142A72]">Chi tiết giá ${projectName || ''}</h3>
                            <button class="close-modal text-gray-500 hover:text-gray-700">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>
                        <div class="price-details-content">
                            ${priceHtml || 'Không có thông tin chi tiết'}
                        </div>
                        <div class="mt-4 text-center">
                            <button class="close-modal px-4 py-2 bg-[#142A72] text-white rounded-lg hover:bg-[#0e1d4d]">
                                Đóng
                            </button>
                        </div>
                    </div>
                </div>
            `;

            document.body.insertAdjacentHTML('beforeend', modalHtml);

            document.querySelectorAll(".close-modal").forEach(button => {
                button.addEventListener("click", () => {
                    document.querySelector(".price-details-modal").remove();
                });
            });
        }

        function updateCellByRowAndColumn(row, columnIndex, value) {
            if (!row) return;

            const cell = row.querySelector(`td:nth-child(${columnIndex})`);
            if (cell) {
                if (value && value.length > 200) {
                    const shortDescription = value.substring(0, 200) + "...";
                    cell.innerHTML = `
                        <div>
                            ${shortDescription}
                            <a href="#" class="text-[#142A72] hover:underline mt-2 view-full-description" 
                                data-full-description="${encodeURIComponent(value)}">Xem thêm</a>
                        </div>
                    `;
                } else {
                    cell.innerHTML = value || '';
                }
            } else {
                console.warn(`⚠️ Không tìm thấy ô ở cột ${columnIndex} trong hàng:`, row);
            }
        }

        function formatAmenities(amenities) {
            if (!amenities) return '';
            
            if (Array.isArray(amenities)) {
                return amenities.map(amenity => `<div class="mb-1"><i class="fas fa-check text-green-500 mr-2"></i>${amenity}</div>`).join('');
            }
            
            if (typeof amenities === 'string') {
                const amenityList = amenities.split(',').map(item => item.trim());
                return amenityList.map(amenity => `<div class="mb-1"><i class="fas fa-check text-green-500 mr-2"></i>${amenity}</div>`).join('');
            }
            
            if (typeof amenities === 'object') {
                return Object.entries(amenities)
                    .map(([key, value]) => `<div class="mb-1">${key}: ${getAmenityIcon(value)} ${value === true ? '' : value}</div>`)
                    .join('');
            }
            
            return amenities;
        }


        function addPropertyToComparison(projectId, position) {
            fetch(`/apis/getProjectDetailsAPI?id=${projectId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! Status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(project => {
                    if (!project || !project.id) {
                        console.error("❌ Không tìm thấy dữ liệu dự án hợp lệ");
                        return;
                    }

                    let propertySlot = document.querySelector(`[data-position='${position}']`);

                    if (!propertySlot) {
                        console.error(`❌ Không tìm thấy vị trí ${position} trong DOM!`);
                        return;
                    }

                    propertySlot.outerHTML = `
                        <div id="property${position}" class="bg-white rounded-lg shadow-md overflow-hidden transition-all hover:shadow-lg" data-position="${position}" data-project-id="${project.id}">
                            <div class="relative">
                                <img src="${project.image}" alt="${project.name}" class="h-48 w-full object-cover" onerror="this.src=''"/>
                                <button class="remove-property absolute top-2 right-2 bg-white rounded-full p-1 text-gray-500 hover:text-gray-700" data-project-id="${project.id}" data-position="${position}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <div class="p-4">
                                <h5 class="text-lg font-semibold mb-2">${project.name}</h5>
                                <a href="#" class="text-[#142A72] hover:underline change-property" data-bs-toggle="modal" data-bs-target="#realEstateModal" data-position="${position}">Đổi bất động sản khác</a>
                            </div>
                        </div>
                    `;

                    addRemoveEvent();
                    setTimeout(() => {
                        fetchAllSelectedProperties();
                    }, 300);

                    setTimeout(() => {
                    document.querySelectorAll(".view-price-details").forEach(link => {
                        const projectId = link.getAttribute("data-project-id");
                        if(projectId == project.id){
                            link.setAttribute("data-price-html", encodeURIComponent(project.priceDetail || project.price || ''));
                            link.setAttribute("data-project-name", project.name);
                        }
                    });
                    }, 500);
                })
                .catch(error => console.error("❌ Lỗi khi lấy dữ liệu dự án:", error));


        }

        function fetchAllSelectedProperties() {
            const propertyElements = document.querySelectorAll("[id^='property']");
            const propertyIds = [];

            propertyElements.forEach(element => {
                const projectId = element.getAttribute("data-project-id");
                if (projectId) {
                    propertyIds.push(projectId);
                }
            });

            if (propertyIds.length === 0) {
                updateComparisonTables([]);
                return;
            }

            Promise.all(
                    propertyIds.map(id =>
                        fetch(`/apis/getProjectDetailsAPI?id=${id}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(`HTTP error! Status: ${response.status}`);
                            }
                            return response.json();
                        })
                        .catch(error => {
                            console.error(`❌ Lỗi khi lấy dữ liệu dự án ID ${id}:`, error);
                            return null;
                        })
                    )
                )
                .then(properties => {
                    const validProperties = properties.filter(p => p !== null);
                    updateComparisonTables(validProperties);
                });
        }

        function addRemoveEvent() {
            document.querySelectorAll(".remove-property").forEach(button => {
                button.removeEventListener("click", removeProperty);
                button.addEventListener("click", removeProperty);
            });
        }

        function removeProperty() {
            event.preventDefault();
            event.stopPropagation();

            let projectId = this.getAttribute("data-project-id");
            let position = this.getAttribute("data-position");

            let propertySlot = document.getElementById(`property${position}`);
            if (propertySlot) propertySlot.remove();

            let emptySlot = `
                <div data-bs-toggle="modal" data-bs-target="#realEstateModal" data-position="${position}" class="border-2 border-dashed border-gray-300 rounded-lg flex flex-col items-center justify-center p-4 h-full min-h-[250px] hover:border-gray-400 cursor-pointer transition-all add-property-btn">
                    <div class="mb-3 text-gray-400">
                        <i class="fas fa-plus-circle text-5xl"></i>
                    </div>
                    <h5 class="text-lg font-medium text-gray-600">Chọn bất động sản</h5>
                </div>
            `;

            document.getElementById("propertyListContainer").insertAdjacentHTML("beforeend", emptySlot);

            document.querySelectorAll(".add-property-btn").forEach(slot => {
                slot.removeEventListener("click", openModal);
                slot.addEventListener("click", openModal);
            });
            fetchAllSelectedProperties();
        }

        document.getElementById("searchBox").addEventListener("keyup", function() {
            const searchTerm = this.value.toLowerCase();
            const propertyItems = document.querySelectorAll("#propertyList .project-item");
            
            propertyItems.forEach(item => {
                const propertyName = item.querySelector("h6").textContent.toLowerCase();
                const propertyStatus = item.querySelector("small").textContent.toLowerCase();
                
                if (propertyName.includes(searchTerm) || propertyStatus.includes(searchTerm)) {
                    item.style.display = "";
                } else {
                    item.style.display = "none";
                }
            });
        });

        function openModal() {
            let position = this.getAttribute("data-position");
            let modal = document.getElementById("realEstateModal");
            modal.setAttribute("data-position", position);
        }

        addRemoveEvent();
        setTimeout(fetchAllSelectedProperties, 500);
    });
</script>