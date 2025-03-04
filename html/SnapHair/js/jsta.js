document.addEventListener("DOMContentLoaded", function () {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const sidebarToggleClose = document.getElementById("sidebarToggleClose");
    const sidebarToggleOpen = document.getElementById("sidebarToggleOpen");
    const mobileMenuToggle = document.getElementById("mobileMenuToggle");

    // Toggle sidebar khi click nút trong sidebar
    sidebarToggleClose.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("expanded");

        sidebarToggleOpen.classList.remove("d-none");

        // Đổi icon khi toggle
        // const icon = sidebarToggle.querySelector("i");
        // if (sidebar.classList.contains("collapsed")) {
        //     icon.classList.remove("fa-chevron-left");
        //     icon.classList.add("fa-chevron-right");
        // } else {
        //     icon.classList.remove("fa-chevron-right");
        //     icon.classList.add("fa-chevron-left");
        // }
    });

    sidebarToggleOpen.addEventListener("click", function () {
        sidebar.classList.toggle("collapsed");
        content.classList.toggle("expanded");

        sidebarToggleOpen.classList.add("d-none");
    });

    // Toggle sidebar khi click nút mobile
    mobileMenuToggle.addEventListener("click", function () {
        sidebar.classList.toggle("expanded");

        // Thêm overlay khi sidebar mở trên mobile
        if (sidebar.classList.contains("expanded")) {
            const overlay = document.createElement("div");
            overlay.id = "sidebarOverlay";
            overlay.style.position = "fixed";
            overlay.style.top = "0";
            overlay.style.left = "0";
            overlay.style.width = "100%";
            overlay.style.height = "100%";
            overlay.style.backgroundColor = "rgba(0,0,0,0.5)";
            overlay.style.zIndex = "998";
            document.body.appendChild(overlay);

            overlay.addEventListener("click", function () {
                sidebar.classList.remove("expanded");
                document.body.removeChild(overlay);
            });
        } else {
            const overlay = document.getElementById("sidebarOverlay");
            if (overlay) {
                document.body.removeChild(overlay);
            }
        }
    });
    // Thiết lập mặc định cho mobile
    if (window.innerWidth < 768) {
        sidebar.classList.remove("expanded");
        sidebar.classList.add("collapsed");
        content.classList.add("expanded");
    }
});
document.addEventListener("DOMContentLoaded", function () {
    const userInfoContainer = document.getElementById("userInfoContainer");
    const userDropdown = document.getElementById("userDropdown");

    userInfoContainer.addEventListener("click", function (event) {
        userDropdown.classList.toggle("active");
        event.stopPropagation();
    });

    document.addEventListener("click", function (event) {
        if (!userInfoContainer.contains(event.target)) {
            userDropdown.classList.remove("active");
        }
    });
});

