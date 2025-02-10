<?php 
getHeader();
$categories = listCategoryBytype('post'); 
?>
  <style>
        .background-header{
          background-image: none !important;
        }
        .setcolor {
          color: #333 !important;
        }
        .setcolor a{
          color: #333 !important;
        }
        .set-backgroundcontact{
          background-color: #182c77;
          
        }

        .keyword-menu {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .keyword-item {
            margin-bottom: 1rem;
        }

        .keyword-toggle-container {
            display: flex;
            align-items: center;
            cursor: pointer;
        }

        .keyword-toggle {
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .keyword-toggle:hover {
            color: #0056b3;
        }

        .keyword-item .bg-blue-500 {
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
        }

        .title-list {
            margin-top: 0.5rem;
            padding-left: 1.5rem;
            transition: max-height 0.3s ease, opacity 0.3s ease;
            max-height: 0;
            opacity: 0;
            overflow: hidden;
        }

        .title-list.active {
            max-height: 500px;
            opacity: 1;
        }

        .keyword-toggle-container::after {
            content: '>';
            font-size: 1.2rem;
            margin-left: auto;
            transition: transform 0.3s ease;
            display: inline-block;
        }

        .keyword-toggle-container.expanded::after {
            transform: rotate(90deg);
        }

        .title-item a {
            display: flex;
            align-items: center;
            text-decoration: none;
            color: #333;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .title-item a:hover {
            background-color: #f0f0f0;
            transform: scale(1.02);
        }

        .title-item img {
            margin-right: 0.5rem;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .title-item a span {
            display: inline-block;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            max-width: 200px;
        }

        .title-item {
            max-width: 100%;
        }

    </style>
<div class="py-4 mx-4 my-10 sm:mx-6 lg:mx-20 font-plus fade-in">
      <h1 class="text-2xl font-bold md:text-4xl">
        Tin tức bất động sản mới nhất
      </h1>
      <p class="mt-2 text-gray-400">
        Thông tin mới, đầy đủ, hấp dẫn về thị trường bất động sản Việt Nam thông
        qua dữ liệu lớn về giá, giao dịch, nguồn cung - cầu và khảo sát thực tế
      </p>
    </div>

    <!-- Danh sách tinh tức -->
    <div
      class="flex flex-col justify-between py-4 mx-4 xl:flex-row sm:mx-6 lg:mx-20 font-plus"
    >
    <?php
    $order = array('id' => 'desc');
    $listDataPost = [];
    foreach ($categories as $category) {
        $listDataPost[$category->slug] = $modelPosts->find()
            ->limit(4)
            ->page(1)
            ->where(['idCategory' => $category->id])
            ->order($order)
            ->all()
            ->toList();
    }
    ?>

      <div class="w-auto xl:w-[60%] slide-right">
          <!-- Tab Navigation -->
          <div class="tab-navigation flex mb-8 space-x-8 heroSection-news-select font-bold pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap">
              <?php foreach ($categories as $category): ?>
                  <a 
                      class="tab-link <?php echo $category->id === $categories[0]->id ? 'active' : ''; ?>" 
                      href="#" 
                      data-tab="tab-<?php echo $category->id; ?>" 
                      data-id-category="<?php echo $category->id; ?>"
                      data-posts='<?php echo json_encode($listDataPost[$category->slug]); ?>'
                  >
                      <?php echo $category->name; ?>
                  </a>
              <?php endforeach; ?>
          </div>

          <!-- Tab Content Section -->
          <div class="tab-content-container">
              <?php foreach ($categories as $key => $category): ?>
                  <div 
                      id="tab-<?php echo $category->id; ?>" 
                      class="tab-content-news <?php echo $key === 0 ? 'active' : ''; ?>"
                  >
                      <!-- Nội dung bài viết sẽ được chèn ở đây -->
                  </div>
              <?php endforeach; ?>
          </div>
      </div>


        <!-- Right -->
        <div
            class="w-auto flex justify-between xl:justify-start flex-col lg:flex-row xl:flex-col xl:w-[30%] mt-8 xl:mt-0 slide-left">
            <div class="w-full p-6 bg-white rounded-lg shadow lg:max-w-md">
                <h2 class="mb-4 text-lg font-medium">Bài viết được xem nhiều nhất</h2>
                <ul class="space-y-4">
                    <?php
                        if (!empty($listPosts)) {
                            usort($listPosts, function($a, $b) {
                                return $b->view - $a->view;
                            });

                            foreach ($listPosts as $key => $value) {
                                $link = '/' . $value->slug . '.html';
                                echo '<li class="flex items-start">
                                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 font-medium rounded-full bgNumber">
                                            ' . ($key + 1) . '
                                        </div>
                                        <a href="' . $link . '" 
                                        class="ml-4 transition duration-300 hover:text-blue-800">
                                        ' . $value->title . '
                                        </a>
                                    </li>';
                            }
                        }
                    ?>
                </ul>
            </div>
            <?php
            $keywords = $modelPosts->find()
                ->select(['keyword'])
                ->group('keyword')
                ->all();

            $keywordTitles = [];
            foreach ($keywords as $keywordEntity) {
                $keyword = $keywordEntity->get('keyword');
                $titles = $modelPosts->find()
                    ->select(['title', 'image', 'slug'])
                    ->where(['keyword' => $keyword,  'type' => 'post'])
                    ->limit(7)
                    ->all();

                $keywordTitles[$keyword] = [];
                foreach ($titles as $titleEntity) {
                  $title = $titleEntity->get('title');
                  $shortTitle = implode(' ', array_slice(explode(' ', $title), 0, 12));
                  if (str_word_count($title) > 20) {
                      $shortTitle .= '...';
                  }
                    $keywordTitles[$keyword][] = [
                        'title' => $shortTitle,
                        'image' => $titleEntity->get('image'),
                        'slug' => $titleEntity->get('slug')
                    ];
                }
            }
            ?>

            <div class="w-full p-6 mt-4 bg-white rounded-lg shadow lg:max-w-md lg:mt-0 xl:mt-4">
              <h2 class="mb-4 text-lg font-semibold">
                Từ khóa
              </h2>
              <div class="space-y-4">
                <ul class="keyword-menu">
                  <?php
                    $index = 1;
                    foreach ($keywordTitles as $keyword => $titles):
                      // debug($keywordTitles);
                      // die;
                  ?>
                    <li class="keyword-item">
                      <div class="keyword-toggle-container flex items-center space-x-2">
                        <div class="flex items-center justify-center flex-shrink-0 w-8 h-8 font-medium text-white rounded-full bg-blue-500">
                          <?= $index++ ?>
                        </div>
                        <span class="keyword-toggle font-bold cursor-pointer text-blue-700">
                          <?= htmlspecialchars($keyword) ?>
                        </span>
                      </div>
                      <ul class="title-list hidden">
                        <?php foreach ($titles as $title): ?>
                          <li class="title-item">
                            <a href="/<?php echo htmlspecialchars($title['slug']); ?>.html" class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg">
                              <img alt="Image for <?= htmlspecialchars($title['title']) ?>" class="object-cover w-16 h-10 rounded-lg" src="<?= $title['image'] ?>" />
                              <span class="transition duration-300 hover:text-blue-800"><?= htmlspecialchars($title['title']) ?></span>
                            </a>
                          </li>
                        <?php endforeach; ?>
                      </ul>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
        </div>
    </div>

    <!-- Được quan tâm nhiều nhất -->
    <?php
      $order = array('view' => 'desc');
      $mostViewedPosts = $modelPosts->find()
          ->where(['type' => 'post']) 
          ->limit(4)
          ->page(1)
          ->order($order)
          ->all()
          ->toList();
    ?> 

    <div class="relative py-4 mx-4 lg:min-h-screen font-plus sm:mx-6 lg:mx-20 slide-top">
      <div class="mt-10">
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
              Được quan tâm nhiều nhất
            </h1>
          </div>
        </div>

        <div class="flex-col hidden lg:flex lg:flex-row">
            <?php foreach ($mostViewedPosts as $index => $post): ?>
                <?php if ($index == 0): ?>
                    <a href="/<?php echo $post->slug; ?>.html" class="mr-6 overflow-hidden">
                        <div class="relative overflow-hidden rounded-lg">
                            <img
                                alt="<?php echo $post->title; ?>"
                                class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-96 hover:scale-105"
                                src="<?php echo $post->image; ?>"
                            />
                        </div>
                        <div class="pt-2">
                            <h2 class="mb-2 text-2xl font-bold">
                                <?php echo $post->title; ?>
                            </h2>
                            <p class="mb-4 text-gray-600">
                                <?php echo $post->description; ?>
                            </p>
                            <div class="flex items-center">
                                <div class="text-sm">
                                    <p class="text-gray-600"><?php echo $post->author; ?> - <?php echo date("d/m/Y", $post->time); ?></p>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php else: ?>
                    <?php if ($index == 1): ?>
                        <div class="flex flex-col space-y-4">
                    <?php endif; ?>
                        <a href="/<?php echo $post->slug; ?>.html" class="flex overflow-hidden">
                            <div class="relative w-full overflow-hidden rounded-lg">
                                <img
                                    alt="<?php echo $post->title; ?>"
                                    class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-44 hover:scale-105"
                                    src="<?php echo $post->image; ?>"
                                />
                            </div>
                            <div class="pl-4 w-[90%]">
                                <h3 class="mb-2 text-lg font-bold description-news">
                                    <?php echo $post->title; ?>
                                </h3>
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="text-gray-600"><?php echo $post->author; ?> - <?php echo date("d/m/Y", $post->time); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php if (count($mostViewedPosts) > 1): ?>
                    </div>
                <?php endif; ?>
        </div>
      </div>
    </div>

    <!-- Liên hệ -->
    <div
      class="relative bg-center bg-cover font-plus slide-top"
      style="background-image: url('<?=$urlThemeActive?>image/index/imageQS2.png')"
    >
      <div class="absolute inset-0 bg-gray-900 bg-opacity-50"></div>
      <div
        class="relative z-10 flex flex-col justify-between px-4 py-10 text-white md:flex-row md:py-20 sm:px-6 xl:px-20"
      >
        <div class="md:w-[45%]">
          <h1 class="mb-4 text-4xl font-bold">
            MinhTuanVinhomes - Chung tay xây dựng cộng đồng Vinhomes
          </h1>
          <p class="mb-8 text-lg">
            Hãy để chúng tôi trở thành cầu nối giúp bạn đến gần hơn với cuộc
            sống thượng lưu tại các quần thể đô thị Vinhomes.
          </p>
        </div>
        <form method="post" action="/contact" class="p-8 text-gray-800 bg-white rounded-lg shadow-lg md:w-[50%]">
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Họ và tên" name="name" required
                type="text"
              />
              <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
            </div>
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Số điện thoại" name="phone" required
                type="text"
              />
            </div>
            <div class="mb-4">
              <input
                class="w-full p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Địa chỉ Email" name="email" required
                type="email"
              />
              <input type="hidden" placeholder="" name="subject" value=" ">
            </div>
            <div class="mb-4">
              <textarea
                class="w-full h-32 p-4 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                placeholder="Lời nhắn của bạn" name="content" required
              ></textarea>
            </div>
            <button
              class="w-full p-4 text-white transition duration-300 bg-blue-600 rounded-lg hover:bg-blue-700 hover:scale-105 hover:shadow-lg"
              type="submit"
              style="background: linear-gradient(90deg, #182c77 0%, #6274bb 100%)"
            >
              Submit
            </button>
        </form>
      </div>
    </div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".tab-link").forEach((tab) => {
    tab.addEventListener("click", (e) => {
      e.preventDefault();

      document
        .querySelectorAll(".tab-link")
        .forEach((link) => link.classList.remove("active"));
      document
        .querySelectorAll(".tab-content-news")
        .forEach((content) => content.classList.remove("active"));

      const tabId = tab.getAttribute("data-tab");
      tab.classList.add("active");
      const tabContent = document.getElementById(tabId);
      tabContent.classList.add("active");

      const postsData = JSON.parse(tab.getAttribute("data-posts"));
      generateTabContent(tabContent, postsData);
    });
  });

  function generateTabContent(contentArea, postsData) {

    if (!contentArea) {
      console.log("Không tìm thấy phần tử tab content để chèn nội dung");
      return;
    }

    contentArea.innerHTML = "";

    if (postsData && postsData.length > 0) {
      postsData.forEach((article, index) => {
        let articleHTML;
        const formattedTime = new Date(article.time * 1000).toLocaleDateString("vi-VN");
        if (index === 0) {
          articleHTML = `
            <a href="/${article.slug}.html" class="rounded-lg block mb-4">
              <div class="relative overflow-hidden rounded-lg">
                <img
                  alt="${article.title}"
                  class="object-cover w-full h-[340px] rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                  src="${article.image}"
                />
                <div class="absolute text-sm text-white bg-[#239A3D] py-2 px-4 rounded-xl mt-4 w-fit bottom-4 right-4">
                 ${article.keyword}
                </div>
              </div>

              <h2 class="mt-4 text-xl font-bold">${article.title}</h2>
              <div class="flex flex-col justify-between sm:items-center sm:flex-row">
                <div class="flex items-center mt-2 text-[#142A72] font-bold">
                  ${article.author} - ${formattedTime}
                </div>
              </div>
              <p class="mt-2 text-gray-400 description">
                ${article.description}
              </p>
            </a>
          `;
        } else {
          articleHTML = `
            <div class="flex flex-col mt-4 space-y-4">
              <a href="/${article.slug}.html" class="flex flex-col overflow-hidden md:flex-row">
                <div class="relative overflow-hidden rounded-lg w-auto md:w-[64%] h-44">
                  <img
                    alt="${article.title}"
                    class="object-cover rounded-lg transition-all duration-300 ease-in-out transform hover:scale-105"
                    src="${article.image}"
                  />
                </div>
                <div class="pl-0 md:pl-4 w-auto md:w-[90%] mt-2 md:mt-0">
                  <h3 class="mb-2 text-lg font-bold description-news">
                    ${article.title}
                  </h3>
                  <p class="mt-2 text-gray-400 description">
                    ${article.description}
                  </p>
                  <div class="flex items-center mt-2">
                    <div class="text-sm">
                      <p class="text-gray-600">${article.author} - ${formattedTime}</p>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          `;
        }
        contentArea.insertAdjacentHTML("beforeend", articleHTML);
      });
    } else {
      contentArea.innerHTML = `<p class="text-gray-500">Không có tin tức</p>`;
    }
  }

  const firstTab = document.querySelector(".tab-link.active");
  if (firstTab) {
    const firstTabId = firstTab.getAttribute("data-tab");
    const firstTabContent = document.getElementById(firstTabId);
    const firstPostsData = JSON.parse(firstTab.getAttribute("data-posts"));
    generateTabContent(firstTabContent, firstPostsData);
  }
});


document.querySelectorAll('.keyword-toggle').forEach(function (keywordToggle) {
    keywordToggle.addEventListener('click', function (event) {
        event.preventDefault();

        // Tìm danh sách tiêu đề kế tiếp
        var titleList = this.parentElement.nextElementSibling;
        titleList.classList.toggle('hidden');

        // Ẩn các danh sách tiêu đề khác
        document.querySelectorAll('.title-list').forEach(function (otherTitleList) {
            if (otherTitleList !== titleList) {
                otherTitleList.classList.add('hidden');
            }
        });
    });
});

document.querySelectorAll('.keyword-toggle-container').forEach(function (keywordToggleContainer) {
    keywordToggleContainer.addEventListener('click', function () {
        var titleList = this.nextElementSibling;

        titleList.classList.toggle('active');

        this.classList.toggle('expanded');

        document.querySelectorAll('.title-list').forEach(function (otherTitleList) {
            if (otherTitleList !== titleList) {
                otherTitleList.classList.remove('active');
            }
        });

        document.querySelectorAll('.keyword-toggle-container').forEach(function (otherToggleContainer) {
            if (otherToggleContainer !== keywordToggleContainer) {
                otherToggleContainer.classList.remove('expanded');
            }
        });
    });
});


</script>
<?php getFooter();?>