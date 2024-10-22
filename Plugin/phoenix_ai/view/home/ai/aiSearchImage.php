<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Image Search</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .header {
            display: flex;
            align-items: center;
            padding: 10px;
            background-color: #333;
        }
        .header img {
            height: 50px;
            margin-right: 10px;
        }
        .header h1 {
            color: white;
            font-size: 24px;
        }
        .container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            text-align: center;
        }
        .drop-area {
            border: 2px dashed #ccc;
            padding: 50px;
            background-color: white;
            border-radius: 10px;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .drop-area.drag-over {
            background-color: #e9f5ff;
            border-color: #0056b3;
        }
        #thumbs, #returns, #imgLoading {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
            margin-bottom: 15px;
        }
        .thumb {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="header">
    <img src="https://crm.phoenixcamp.vn/upload/admin/files/Logo.png" alt="Logo">
    <h1>AI TÌM KIẾM ẢNH SỰ KIỆN</h1>
</div>

<div class="container">
    <div class="drop-area" id="drop-area">
        <p><i class="fa-solid fa-cloud-arrow-up"></i> Kéo và thả file ảnh chân dung của bạn vào đây</p>
        <input type="file" name="image" id="fileElem" accept="image/*" multiple style="display:none">
    </div>
    <div id="thumbs"></div>
    <div id="returns"></div>
    <div id="imgLoading" style="display: none;">
        <img src="/plugins/phoenix_ai/view/home/assets/img/loading.gif" width="100">
    </div>
</div>

<script>
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const thumbs = document.getElementById('thumbs');
    const returns = document.getElementById('returns');

    // Handle drag and drop events
    dropArea.addEventListener('dragover', (event) => {
        event.preventDefault();
        dropArea.classList.add('drag-over');
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.classList.remove('drag-over');
    });

    dropArea.addEventListener('drop', (event) => {
        event.preventDefault();
        dropArea.classList.remove('drag-over');
        const files = event.dataTransfer.files;
        handleFiles(files);
    });

    // Handle click to upload
    dropArea.addEventListener('click', () => {
        fileInput.click();
    });

    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        handleFiles(files);
    });

    // Function to handle file display
    function handleFiles(files) {
        $('#thumbs').html('');
        $('#returns').html('');
        $('#imgLoading').hide();

        for (let file of files) {
            if (file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.classList.add('thumb');
                    thumbs.appendChild(img);
                }
                reader.readAsDataURL(file);

                uploadFile(file);
            }
        }
    }

    function uploadFile(file) {
        const formData = new FormData();
        formData.append('image', file);

        $('#imgLoading').show();

        // Use jQuery.ajax to send the file via POST
        $.ajax({
            url: '/apis/searchImageAPI',  // Replace with your actual upload URL
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log('Success:', response);

                $('#imgLoading').hide();

                $.each( response, function( key, value ) {
                    const img = document.createElement('img');
                    img.src = value.thumb;
                    img.classList.add('thumb');
                    returns.appendChild(img);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
            }
        });
    }
</script>

</body>
</html>
