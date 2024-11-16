const provinces = {
  "VN03": "Hà Giang",
  "VN05": "Sơn La",
  "VN07": "Tuyên Quang",
  "VN14": "Hòa Bình",
  "VN18": "Ninh Bình",
  "VN20": "Thái Bình",
  "VN21": "Thanh Hóa",
  "VN22": "Nghệ An",
  "VN23": "Hà Tĩnh",
  "VN24": "Quảng Bình",
  "VN25": "Quảng Trị",
  "VN26": "Thừa Thiên - Huế",
  "VN29": "Quảng Ngãi",
  "VN30": "Gia Lai",
  "VN32": "Phú Yên",
  "VN36": "Ninh Thuận",
  "VN39": "Đồng Nai",
  "VN44": "An Giang",
  "VN46": "Tiền Giang",
  "VN47": "Kiên Giang",
  "VN52": "Sóc Trăng",
  "VN53": "Bắc Kạn",
  "VN55": "Bạc Liêu",
  "VN67": "Nam Định",
  "VN68": "Phú Thọ",
  "VN69": "Thái Nguyên",
  "VN71": "Điện Biên",
};

const paths = document.querySelectorAll("svg #features path");

// Chuẩn bị tham chiếu đến các thẻ span
const spanMap = {};
document.querySelectorAll(".city").forEach((span) => {
  const id = span.getAttribute("data-id");
  if (id) {
    spanMap[id] = span;
  }
});

// Tạo tooltip chỉ một lần
const tooltip = document.createElement("div");
tooltip.style.position = "absolute";
tooltip.style.padding = "5px";
tooltip.style.backgroundColor = "#333";
tooltip.style.color = "#fff";
tooltip.style.borderRadius = "5px";
tooltip.style.display = "none";
document.body.appendChild(tooltip);

// Xử lý từng path
paths.forEach((path) => {
  const pathId = path.id;
  const pathIdCity = path.getAttribute('idcity');

  if (provinces.hasOwnProperty(pathId)) {
    path.setAttribute("fill", "#82C248");

    path.addEventListener("mouseover", (event) => {
      path.setAttribute("fill", "#0f733f");
      const span = spanMap[pathId];
      if (span) {
        span.style.color = "#0f733f";
      }
    });

    path.addEventListener("mouseout", () => {
      path.setAttribute("fill", "#82C248");
      const span = spanMap[pathId];
      if (span) {
        span.style.color = "";
      }
    });

    // sự kiện khi click vào một tỉnh
    path.addEventListener("click", () => {
      const provinceLink = 'https://ngayhoixanh.phoenixtech.vn/detail/?id_city='+pathIdCity;
     
      if(pathIdCity!=""){
        window.location.href = provinceLink;
      }
      
    });
  } else {
    path.setAttribute("fill", "white");

    path.addEventListener("mouseover", (event) => {
      path.setAttribute("fill", "lightgray");
    });

    path.addEventListener("mouseout", () => {
      path.setAttribute("fill", "white");
    });
  }
});
