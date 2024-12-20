<?php 
getHeader();
$categories = listCategoryBytype('post'); 
?> 
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
        <div class="w-auto xl:w-[60%] slide-right">
            <div
            class="tab-navigation flex mb-8 space-x-8 heroSection-news-select font-bold pb-4 border-b-[0.5px] border-[#ccc] overflow-x-auto md:overflow-visible scroll-smooth whitespace-nowrap"
            >
                <?php foreach ($categories as $key => $category): ?>
                    <a 
                    class="tab-link <?php echo $key === 0 ? 'active' : ''; ?>" 
                    href="#" 
                    data-tab="<?php echo 'tab-' . $category->slug; ?>"
                    >
                        <?php echo $category->name; ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Tab Content Section -->
            <?php foreach ($categories as $key => $category): ?>
                <div 
                id="<?php echo 'tab-' . $category->slug; ?>" 
                class="tab-content-news <?php echo $key === 0 ? 'active' : ''; ?>"
                >
                <!-- Nội dung của <?php echo $category->name; ?> sẽ ở đây -->
                </div>
            <?php endforeach; ?>
        </div>
        <!-- Right -->
        <div
            class="w-auto flex justify-between xl:justify-start flex-col lg:flex-row xl:flex-col xl:w-[30%] mt-8 xl:mt-0 slide-left"
        >
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

            <div
            class="w-full p-6 mt-4 bg-white rounded-lg shadow lg:max-w-md lg:mt-0 xl:mt-4"
            >
            <h2 class="mb-4 text-lg font-semibold">
                Thị trường BĐS tại các tỉnh / thành
            </h2>
            <div class="space-y-4">
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Hà Nội
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Hải Phòng
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Đà Nẵng
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    TP. Hồ Chí Minh
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Bà Rịa - Vũng Tàu
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Huế
                </span>
                </a>
                <a
                href="#"
                class="flex items-center space-x-4 transition-transform duration-300 hover:scale-105 hover:bg-gray-100 hover:rounded-lg"
                >
                <img
                    alt="Image of Hà Nội"
                    class="object-cover w-16 h-10 rounded-lg"
                    src="https://storage.googleapis.com/a1aa/image/MJxVtbebl1xe6U9a2n6oXQsZwPlGlE6n2KVfLfZxg7w9DKgPB.jpg"
                />
                <span class="transition duration-300 hover:text-blue-800">
                    Hưng Yên
                </span>
                </a>
            </div>
            </div>
        </div>
    </div>

    <!-- Được quan tâm nhiều nhất -->
    <div
      class="relative py-4 mx-4 lg:min-h-screen font-plus sm:mx-6 lg:mx-20 slide-top"
    >
      <div class="mt-10">
        <div class="flex items-center justify-between mb-8">
          <div class="w-[60%] md:w-auto">
            <h1 class="text-2xl font-bold md:text-4xl text-[#142A72]">
              Được quan tâm nhiều nhất
            </h1>
          </div>
          <a
            href="#"
            class="flex items-center font-bold rounded-full text-[#142A72] hover:text-blue-500 transition duration-300"
          >
            <p class="underline">Xem thêm</p>
            <i
              class="ml-2 transition-transform duration-300 fas fa-chevron-right hover:translate-x-1"
            ></i>
          </a>
        </div>

        <div class="flex-col hidden lg:flex lg:flex-row">
          <a href="#" class="mr-6 overflow-hidden">
            <div class="relative overflow-hidden rounded-lg">
              <img
                alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
                class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-96 hover:scale-105"
                src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
              />
            </div>
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>
              <p class="mb-4 text-gray-600">
                A spacious and modern home with an open floor plan, large
                windows, and a beautifully landscaped garden. Perfect for those
                seeking peace and tranquility.
              </p>
              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <div class="flex flex-col space-y-4">
            <a href="#" class="flex overflow-hidden">
              <div class="relative w-full overflow-hidden rounded-lg">
                <img
                  alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
                  class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-44 hover:scale-105"
                  src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
                />
              </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="flex overflow-hidden">
              <div class="relative w-full overflow-hidden rounded-lg">
                <img
                  alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
                  class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-44 hover:scale-105"
                  src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
                />
              </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
            <a href="#" class="flex overflow-hidden">
              <div class="relative w-full overflow-hidden rounded-lg">
                <img
                  alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
                  class="object-cover w-full transition-all duration-300 ease-in-out transform rounded-lg h-44 hover:scale-105"
                  src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
                />
              </div>
              <div class="pl-4 w-[90%]">
                <h3 class="mb-2 text-lg font-bold description-news">
                  Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao
                  dịch bất động sản từ trực...
                </h3>
                <div class="flex items-center">
                  <img
                    alt="Author's profile picture"
                    class="w-8 h-8 mr-2 rounded-full"
                    height="100"
                    src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                    width="100"
                  />
                  <div class="text-sm">
                    <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                  </div>
                </div>
              </div>
            </a>
          </div>
        </div>

        <div
          class="grid grid-cols-1 space-y-4 sm:grid-cols-2 lg:hidden sm:space-y-0"
        >
          <a href="#" class="mr-6 overflow-hidden">
            <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
            />
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>

              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
          <a href="#" class="mr-6 overflow-hidden">
            <img
              alt="A spacious and modern home with an open floor plan, large windows, and a beautifully landscaped garden."
              class="object-cover w-full rounded-lg h-44"
              src="https://storage.googleapis.com/a1aa/image/rrAJYKuOgBrAMtxI692ZkUDveurAM0aG86f5eJEl9oFJSxunA.jpg"
            />
            <div class="pt-2">
              <h2 class="mb-2 text-2xl font-bold description-news">
                Vinhomes chính thức ra mắt Vinhomes Market - Giải pháp giao dịch
                bất động sản từ trực tuyến đến
              </h2>

              <div class="flex items-center">
                <img
                  alt="Author's profile picture"
                  class="w-10 h-10 mr-4 rounded-full"
                  height="100"
                  src="https://storage.googleapis.com/a1aa/image/lyRUGiAJOW5eFKcvOqGjuz4EjssvW0hfzMzO5YGISHnFpY3TA.jpg"
                  width="100"
                />
                <div class="text-sm">
                  <p class="text-gray-600">Minh Tuấn - 20/11/2024</p>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
    </div>

   

<?php getFooter();?>