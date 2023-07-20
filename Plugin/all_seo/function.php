<?php
	$menus= array();
	$menus[0]['title']= 'All SEO';
    $menus[0]['sub'][0]= array(	'title'=>'Cài đặt SEO',
    							'url'=>'/plugins/admin/all_seo-settingAllSEO.php',
    							'classIcon'=>'menu-icon tf-icons bx bxs-data'
    						);
    
    addMenuAdminMantan($menus);
    
	function showSeoHome()
	{
		global $metaTitleMantan;
		global $metaKeywordsMantan;
		global $metaDescriptionMantan;
		global $metaImageMantan;

		global $modelOptions;
		
		global $isHome;
		global $isCategory;
		global $isPost;
		global $isPage;
		global $isPlugin;

		global $infoSite;
		
		global $urlCurrent;
		global $urlHomes;
		
		$page= explode('page:', $urlCurrent);
		if(count($page)>1)
		{
			$page= explode('/', $page[1]);
			$page= (int) $page[0];
		} else {
			$page=1;
			if(isset($_GET['page']) && $_GET['page']>0){
				$page= (int) $_GET['page'];
			}
		}
		
		$conditions = array('key_word' => 'allSeo');
    	$listData = $modelOptions->find()->where($conditions)->first();

    	$metaTitleMantanDefault= $infoSite['title'];
		$metaKeywordsMantanDefault= $infoSite['keyword'];
		$metaDescriptionMantanDefault= $infoSite['description'];

		$metaTitleMantan = $metaTitleMantanDefault;
		$metaKeywordsMantan = $metaKeywordsMantanDefault;
		$metaDescriptionMantan = $metaDescriptionMantanDefault;

    	if(!empty($listData)){
    		$listData = json_decode($listData->value, true);

			if($isCategory)
			{
				if(!empty($listData['category']['title']))
				{
					$metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['category']['title']);
					$metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
					$metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
					
					if(isset($category->name)){
						$metaTitleMantan= str_replace('%categoryName%', $category->name, $metaTitleMantan);
					}

					if(isset($category->keyword)){
						$metaTitleMantan= str_replace('%categoryKeyword%', $category->keyword, $metaTitleMantan);
					}

					if(isset($category->description)){
						$metaTitleMantan= str_replace('%categoryDescription%', $category->description, $metaTitleMantan);
					}

					$metaTitleMantan= str_replace('%page%', $page, $metaTitleMantan);
					
					if($page>1)
					{
						$metaTitleMantan= str_replace('%pageMore%', $page, $metaTitleMantan);
					}
					else
					{
						$metaTitleMantan= str_replace('%pageMore%', '', $metaTitleMantan);
					}
				}
				
				if(!empty($listData['category']['keyword']))
				{
					$metaKeywordsMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['category']['keyword']);
					$metaKeywordsMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaKeywordsMantan);
					
					if(isset($category->name)){
						$metaKeywordsMantan= str_replace('%categoryName%', $category->name, $metaKeywordsMantan);
					}

					if(isset($category->keyword)){
						$metaKeywordsMantan= str_replace('%categoryKeyword%', $category->keyword, $metaKeywordsMantan);
					}

					if(isset($category->description)){
						$metaKeywordsMantan= str_replace('%categoryDescription%', $category->description, $metaKeywordsMantan);
					}

					$metaKeywordsMantan= str_replace('%page%', $page, $metaKeywordsMantan);
					
					if($page>1)
					{
						$metaKeywordsMantan= str_replace('%pageMore%', $page, $metaKeywordsMantan);
					}
					else
					{
						$metaKeywordsMantan= str_replace('%pageMore%', '', $metaKeywordsMantan);
					}
				}
				
				if(!empty($listData['category']['description']))
				{
					$metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['category']['description']);
					$metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
					
					if(isset($category->name)){
						$metaDescriptionMantan= str_replace('%categoryName%', $category->name, $metaDescriptionMantan);
					}

					if(isset($category->keyword)){
						$metaDescriptionMantan= str_replace('%categoryKeyword%', $category->keyword, $metaDescriptionMantan);
					}

					if(isset($category->description)){
						$metaDescriptionMantan= str_replace('%categoryDescription%', $category->description, $metaDescriptionMantan);
					}

					$metaDescriptionMantan= str_replace('%page%', $page, $metaDescriptionMantan);
					
					if($page>1)
					{
						$metaDescriptionMantan= str_replace('%pageMore%', $page, $metaDescriptionMantan);
					}
					else
					{
						$metaDescriptionMantan= str_replace('%pageMore%', '', $metaDescriptionMantan);
					}
				}

				if(!empty($category->image)){
					if(strpos($category->image, 'http') === false){
						$metaImageMantan= $urlHomes.$category->image;
					}else{
						$metaImageMantan= $category->image;
					}
				}
			} else if($isPost || $isPage)
			{
				if(!empty($listData['post']['title']))
				{
					$metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['post']['title']);
					$metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
					$metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
					
					$metaTitleMantan= str_replace('%postName%', $post->title, $metaTitleMantan);
					$metaTitleMantan= str_replace('%postKeyword%', $post->keyword, $metaTitleMantan);
					$metaTitleMantan= str_replace('%postDescription%', $post->description, $metaTitleMantan);
				}
				
				if(!empty($listData['post']['keyword']))
				{
					$metaKeywordsMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['post']['keyword']);
					$metaKeywordsMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaKeywordsMantan);
					
					$metaKeywordsMantan= str_replace('%postName%', $post->title, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%postKeyword%', $post->keyword, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%postDescription%', $post->description, $metaKeywordsMantan);
				}
				
				if(!empty($listData['post']['description']))
				{
					$metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['post']['description']);
					$metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
					
					$metaDescriptionMantan= str_replace('%postName%', $post->title, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%postKeyword%', $post->keyword, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%postDescription%', $post->description, $metaDescriptionMantan);
				}

				if(!empty($post->image)){
					
					if(strpos($post->image, 'http') === false){
						$metaImageMantan= $urlHomes.$post->image;
					}else{
						$metaImageMantan= $post->image;
					}
					
				}
			} else if($isPlugin)
			{
				if(!empty($listData['expand']['title']))
				{
					$metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['expand']['title']);
					$metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
					$metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
				}
				
				if(!empty($listData['expand']['keyword']))
				{
					$metaKeywordsMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['expand']['keyword']);
					$metaKeywordsMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaKeywordsMantan);
				}
				
				if(!empty($listData['expand']['description']))
				{
					$metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['expand']['description']);
					$metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
				}
			} else
			{
				if(!empty($listData['general']['title']))
				{
					$metaTitleMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['general']['title']);
					$metaTitleMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaTitleMantan);
					$metaTitleMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaTitleMantan);
				}
				
				if(!empty($listData['general']['keyword']))
				{
					$metaKeywordsMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['general']['keyword']);
					$metaKeywordsMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaKeywordsMantan);
					$metaKeywordsMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaKeywordsMantan);
				}
				
				if(!empty($listData['general']['description']))
				{
					$metaDescriptionMantan= str_replace('%title%', $metaTitleMantanDefault, $listData['general']['description']);
					$metaDescriptionMantan= str_replace('%keyword%', $metaKeywordsMantanDefault, $metaDescriptionMantan);
					$metaDescriptionMantan= str_replace('%description%', $metaDescriptionMantanDefault, $metaDescriptionMantan);
				}

				if(!empty($listData['general']['image'])){
					if(strpos($listData['general']['image'], 'http') === false){
						$metaImageMantan= $urlHomes.$listData['general']['image'];
					}else{
						$metaImageMantan= $listData['general']['image'];
					}
				}
			}
		}

		echo '	<title>'.$metaTitleMantan.'</title>
			  	<meta name="description" content="'.$metaDescriptionMantan.'" />
			  	<meta name="keywords" content="'.$metaKeywordsMantan.'" />

			  	<!-- Google / Search Engine Tags -->
			  	<meta itemprop="name" content="'.$metaTitleMantan.'">
			  	<meta itemprop="description" content="'.$metaDescriptionMantan.'">
			  	<meta itemprop="image" content="'.$metaImageMantan.'">

			  	<!-- Facebook Meta Tags -->
				<meta property="og:title" content="'.$metaTitleMantan.'"/>
				<meta property="og:type" content="website"/>
				<meta property="og:description" content="'.$metaDescriptionMantan.'"/>
				<meta property="og:url" content="'.$urlCurrent.'"/>
				<meta property="og:site_name" content="'.$infoSite['title'].'"/>
				<meta property="og:image" content="'.$metaImageMantan.'" />
				<meta property="og:image:alt" content="Hình ảnh '.$metaTitleMantan.'" />
				<meta property="og:image:width" content="900" />
				<meta property="og:image:height" content="603" />

			    <!-- Twitter Meta Tags -->
			    <meta name="twitter:card" content="summary_large_image">
			    <meta name="twitter:title" content="'.$metaTitleMantan.'">
			    <meta name="twitter:description" content="'.$metaDescriptionMantan.'">
			    <meta name="twitter:image" content="'.$metaImageMantan.'">
			  ';
	}
?>