<?php getHeader();?>  
<!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css"
          integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> -->
          <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
          <script src='https://www.google.com/recaptcha/api.js' async defer ></script>

<?php
function thongbao($status, $msg)
{
    return die('<script type="text/javascript">Swal.fire("Thông Báo", "'.$msg.'", "'.$status.'"); setTimeout(function(){ location.href = "/newletter" },2000); </script>');
}
function bao($status, $msg)
{
    return die('<script type="text/javascript">Swal.fire("Thông Báo", "'.$msg.'", "'.$status.'"); setTimeout(function(){ location.href = "/thanks" },2000); </script>');
}
if(isset($_POST['submit']))
{

    global $controller;
    
    $email = $_POST['email'];
    $captcha    = $_POST['g-recaptcha-response'];
    if(!$email)
    {
        thongbao('error', "Vui lòng nhập đầy đủ thông tin");
    }else{
        $secret = '6LdPg2ApAAAAALqNXXeicrG3tNpaS2ELQYDZHaCI'; //Thay thế bằng mã Secret Key của bạn
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$captcha);
        $response_data = json_decode($verify_response);
        if($response_data->success){
            $dataPost= array('email'=>$email);
            $listData= sendDataConnectMantan('http://warm.creatio.vn/apis/addSubscribeAPI', $dataPost);
            // bao('success', "Bạn đã đăng ký thành công");
             echo header("refresh: 0; url = http://warm.creatio.vn/thanks");
            exit();
        }else{
            thongbao('error', "Bạn chưa xác minh repcatcha thành công");
            
        }
        
    }
}
?>
    <main>
        <section id="section-home-banner" class="section-logo-header">
            <div class="home-banner">
                <div class="logo-banner-box">
                    <div class="container">
                        <div class="logo-warm">
                            <img src="<?php echo $urlThemeActive;?>/asset/img/WARM-horz-EN-_1_.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="section-title">
            <section id="section-page-title" class="newsletter-title">
                <div class="title-section">
                    <h1>Warm NEWSLETTERS</h1>
                    <div class="title-divide-section"></div>
                </div>
            </section>
        </section>

        <section id="section-form-newsletter">
            <div class="background-backnewsletter">

            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-9">
                        <form class="wrFormResgis" action="" method="post" name="">
                            <input type="hidden" value="<?php echo $csrfToken; ?>" name="_csrfToken">
                            <div class="box-form">
                                <div class="description-form">
                                    <p>Help us to get to know you better and send you information that interests you, by answering the questions below.</p>
                                </div>

                                <div class="textnote-form">
                                    <span>* indicates required</span>
                                </div>

                                <div class="label-arrcodion label-arrcodion-input">
                                    <p>Email address *</p>
                                    <input type="email" class="form-control" name="email" placeholder="" aria-describedby="basic-addon1">
                                </div>
                                <div class="label-arrcodion">
                                    <select id="countrySelect">
                                        <option value="">Your country *</option>
                                    </select>
                                </div>

                                <div class="label-arrcodion">
                                    <select name="calc_shipping_provinces">
                                        <option value="">Your province (if Vietnam)  *</option>
                                    </select>
                                </div>

                                <div class="label-arrcodion">
                                    <select name="option-job">
                                        <option value="">Your profile *</option>
                                        <option value="Etablissement public (Ministère, collectivités locales…)">Public institution (ministry, local authorities …)</option>
                                        <option value="Banque ou agence de développement">Bank / Development agency</option>
                                        <option value="Organisation internationale">International organization</option><option value="ONG">NGO / Association</option>
                                        <option value="Institut de Recherche">Research institute</option><option value="Multinationale">Multinational company</option>
                                        <option value="TPE / PME">Very Small Enterprise/ Small and Medium Enterprise</option>
                                        <option value="Start-up">Startup</option><option value="Entrepreneur">Entrepreneur</option>
                                        <option value="Etudiant">Student</option>
                                        <option value="Autre">Other</option>
                                    </select>
                                </div>

                                <div class="label-dropdown label-arrcodion">
                                    
                                        <div class="box-profile">
                                            <div class="box-profile-item">
                                                <div class="title-box-profile">
                                                    <span>Your areas of interest</span>
                                                </div>
                                                <ul>
                                                    <li>
                                                        <input id="selectAll" type="checkbox">
                                                        <label for='selectAll' class="text-italic"><strong>All subjects </strong>(in this case you don't need to check the other boxes)</label>
                                                    </li>
                                                    <li>
                                                        <input id="check1a" type="checkbox" name="quocgia" value="check1a" />
                                                        <label for="check1a">Resilience of cities and territories to climate change and natural hazards </label>
                                                    </li>
                                                    <li>
                                                        <input id="check2a" type="checkbox" name="quocgia" value="check2a" />
                                                        <label for="check2a">Integrated coastal zone management </label>
                                                    </li>

                                                    <li>
                                                        <input id="check3a" type="checkbox" name="quocgia" value="check3a" />
                                                        <label for="check3a">Water resource management </label>
                                                    </li>
                                                </ul>
                                            </div>

                                            <div class="box-profile-item box-profile-item-bottom">
                                                <div class="title-box-profile">
                                                    <span>Your regions of interest</span>
                                                </div>
                                                <div class="all-region">
                                                    <input id="selectAll" type="checkbox">
                                                    <label for='selectAll' class="text-italic"><strong>All regions</strong> (in this case you don't need to check the other boxes)</label>
                                                </div>
                                                <ul>
                                                    
                                                    <li>
                                                        <input id="check1" type="checkbox" name="quocgia" value="check1" />
                                                        <label for="check1">Dien Bien</label>
                                                    </li>
                                                    <li>
                                                        <input id="check2" type="checkbox" name="quocgia" value="check2" />
                                                        <label for="check2">Son La</label>
                                                    </li>
                                                    <li>
                                                        <input id="check3" type="checkbox" name="quocgia" value="check3">
                                                        <label for='check3'>Quang Tri</label>
                                                    </li>
                                                    <li>
                                                        <input id="check4" type="checkbox" name="quocgia" value="check4" />
                                                        <label for="check4">Quang Nam</label>
                                                    </li>
                                                    <li>
                                                        <input id="check5" type="checkbox" name="quocgia" value="check5" />
                                                        <label for="check5">Ninh Thuan</label>
                                                    </li>

                                                    <li>
                                                        <input id="check6" type="checkbox" name="quocgia" value="check6" />
                                                        <label for="check6">Vinh Long</label>
                                                    </li>

                                                    <li>
                                                        <input id="check7" type="checkbox" name="quocgia" value="check7" />
                                                        <label for="check7">Quang Tri</label>
                                                    </li>

                                                    <li>
                                                        <input id="check2" type="checkbox" name="quocgia" value="check2" />
                                                        <label for="check2">Hau Giang</label>
                                                    </li>

                                                    <li>
                                                        <input id="check2" type="checkbox" name="quocgia" value="check2" />
                                                        <label for="check2">Quang Nam</label>
                                                    </li>

                                                    <li>
                                                        <input id="check2" type="checkbox" name="quocgia" value="check2" />
                                                        <label for="check2">Ca Mau</label>
                                                    </li>
                                                </ul>
                                            </div>

                                            <strong class="title-capcha">Captcha confirmation</strong>
                                            <dir class="">
                                                
                                                
                                                <span>Please validate the Captcha to validate your registration</span>

                                            <div class="m-5 captcha-area">
                                                <h4>Captcha confirmation</h4>
                                                <p>Please validate the Captcha to validate your registration</p>

                                                <div class="g-recaptcha" data-sitekey="6LdPg2ApAAAAAPQbAJJr43jcCYla93FQbXgfTq3o"></div>
                                            </div>
                                            <div class="button-newsletter">
                                                <button type="submit" name="submit">SUBSCRIBE</button>
                                            </div>
                                        </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section> 
        
        <section id="section-newsletter-bot">
            <div class="container">
                <div class="row justify-content-center  ">
                    <div class="col-lg-9">
                        <div class="newsletter-bot-content">
                            Information collected about you is processed under the AFD’s responsibility in order to manage subscriptions to our “Transitions - La Lettre de l’AFD”, “Etudes & Savoirs” and “Rencontres du Développement” invitations. The details presented as mandatory are required to help us understand your expectations in the context of your subscription. The optional information allows us to improve our information service.
                            <br>
                            <br>
                            We also collect data on the way you use our newsletter (email opening rate, clicks, etc.), to help us apply our rules on data storage time (we delete your data after 12 months’ inactivity) and for statistical purposes. 
                            <br>
                            <br> 
                            Under the terms laid out in the applicable regulations, you may access data concerning you or ask that they be deleted. You also have the right to oppose, rectify or limit the processing of your data, as well as the right to data portability. In order to exercise these rights, or if you have any questions regarding the processing of your data, you may contact the AFD’s Data Protection Officer (DPO) by email: <span>informatique.libertes@afd.fr</span> .If, after having contacted the DPO and received their answer, you feel that your rights have not been respected, you may lay a complaint with the CNIL.
                            <br>
                            <br>
                            <span>More informations about the processing of personnal data.</span>
                            <br>
                            <br>
                            <strong>The Communications Team</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>
    <script src="https://cdn.jsdelivr.net/gh/vietblogdao/js/districts.min.js"></script>

    <script>//<![CDATA[
    if (address_2 = localStorage.getItem('address_2_saved')) {
    $('select[name="calc_shipping_district"] option').each(function() {
        if ($(this).text() == address_2) {
        $(this).attr('selected', '')
        }
    })
    $('input.billing_address_2').attr('value', address_2)
    }
    if (district = localStorage.getItem('district')) {
    $('select[name="calc_shipping_district"]').html(district)
    $('select[name="calc_shipping_district"]').on('change', function() {
        var target = $(this).children('option:selected')
        target.attr('selected', '')
        $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
        address_2 = target.text()
        $('input.billing_address_2').attr('value', address_2)
        district = $('select[name="calc_shipping_district"]').html()
        localStorage.setItem('district', district)
        localStorage.setItem('address_2_saved', address_2)
    })
    }
    $('select[name="calc_shipping_provinces"]').each(function() {
    var $this = $(this),
        stc = ''
    c.forEach(function(i, e) {
        e += +1
        stc += '<option value=' + e + '>' + i + '</option>'
        $this.html('<option value="">Your province (if Vietnam)  *</option>' + stc)
        if (address_1 = localStorage.getItem('address_1_saved')) {
        $('select[name="calc_shipping_provinces"] option').each(function() {
            if ($(this).text() == address_1) {
            $(this).attr('selected', '')
            }
        })
        $('input.billing_address_1').attr('value', address_1)
        }
        $this.on('change', function(i) {
        i = $this.children('option:selected').index() - 1
        var str = '',
            r = $this.val()
        if (r != '') {
            arr[i].forEach(function(el) {
            str += '<option value="' + el + '">' + el + '</option>'
            $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>' + str)
            })
            var address_1 = $this.children('option:selected').text()
            var district = $('select[name="calc_shipping_district"]').html()
            localStorage.setItem('address_1_saved', address_1)
            localStorage.setItem('district', district)
            $('select[name="calc_shipping_district"]').on('change', function() {
            var target = $(this).children('option:selected')
            target.attr('selected', '')
            $('select[name="calc_shipping_district"] option').not(target).removeAttr('selected')
            var address_2 = target.text()
            $('input.billing_address_2').attr('value', address_2)
            district = $('select[name="calc_shipping_district"]').html()
            localStorage.setItem('district', district)
            localStorage.setItem('address_2_saved', address_2)
            })
        } else {
            $('select[name="calc_shipping_district"]').html('<option value="">Quận / Huyện</option>')
            district = $('select[name="calc_shipping_district"]').html()
            localStorage.setItem('district', district)
            localStorage.removeItem('address_1_saved', address_1)
        }
        })
    })
    })
    //]]></script>

    <script>
        var select = document.getElementById("countrySelect");

        // Sử dụng Fetch API để lấy dữ liệu từ Restcountries API
        fetch("https://restcountries.com/v3.1/all")
        .then(response => response.json())
        .then(data => {
            // Sắp xếp danh sách theo tên quốc gia (common name)
            data.sort((a, b) => a.name.common.localeCompare(b.name.common));

            // Thêm các option vào select
            data.forEach(country => {
            var option = document.createElement("option");
            option.value = country.cca2; // Mã quốc gia
            option.text = country.name.common; // Tên quốc gia
            select.appendChild(option);
            });
        })
        .catch(error => console.error("Error fetching data:", error));
    </script>
   <?php getFooter();?>