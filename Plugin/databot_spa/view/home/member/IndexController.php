<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Customers;
use App\Models\Menu;
use App\Models\Options;
use App\Models\Pages;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Number;
use App\Models\Feedback;
use App\Trails\MailTrait;
use DB;
use Illuminate\Http\Request;
use JsValidator;
use Mail;
use OpenGraph;
use SEO;
use SEOMeta;
use Cart;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Client as MemberClient;
use Webklex\PDFMerger\Facades\PDFMergerFacade as PDFMerger;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;
use GuzzleHttp\Psr7\Request as GuzzleRequest;

class IndexController extends Controller
{

    use MailTrait;

    public function getHome()
    {
        $this->createSeo();
        $page = Pages::where('type', 'home')->first();
        $category22 = Categories::where('type','blog')->where('id', 22)->firstOrFail();
        $category23 = Categories::where('type','blog')->where('id', 23)->firstOrFail();
        $content = json_decode($page->content);
        $data['content'] = $content;
        $this->createSeoPost($category22);
        $data['content22'] = $category22;
        $data['post'] = $category22->Posts()->orderByDesc('posts.created_at')->paginate(8);

        $this->createSeoPost($category23);
        $data['content23'] = $category23;
        
        $data['post23'] = $category23->Posts()->orderByDesc('posts.created_at')->paginate(4);

        $data['news'] = Post::whereStatus(1)->where('type','blog')->whereIn('id',$content->post_ids ?? [])->take(6)->get();
        $data['feedback']=Feedback::orderBy('created_at', 'DESC')->get();
        // $data['number'] = Cache::remember((new Number)->getcacheKey(), 10000000, function () {
            // return Number::whereStatus(1)->get()->take(11);
        // });

        $data['number'] =Number::orderBy('created_at')->paginate(11);

         // dd($data);
         // die();

        return view('frontend.pages.home', compact('data'));
    }

    public function news()
    {
        $category = Categories::where('type','blog')->get();
        $page = Pages::where('type', 'news')->firstOrFail();
        $content = json_decode($page->content);
        $this->createSeo($page);
        $data['content'] = $content;
        $data['post'] = $category;
        return view('frontend.pages.news.index', compact('data'));
    }

    public function getCategory($slug)
    {
        $category = Categories::where('type','blog')->where('slug', $slug)->firstOrFail();
        $this->createSeoPost($category);
        $data['content'] = $category;
        $data['post'] = $category->Posts()->orderByDesc('posts.created_at')->paginate(8);

        return view('frontend.pages.news.category', compact('data'));
    }


    public function getContact(){
        $page = Pages::where('type', 'contact')->first();
        $content = json_decode($page->content);
        $this->createSeo($page);

        return view('frontend.pages.contact');
    }

    public function getblogSingle($slug)
    {
        $data = Post::where('slug', $slug)->firstOrFail();
        $this->createSeoPost($data);
        $category = $data->category()->first();
        $postOther = Post::where('id', '!=', $data->id)->where('type','blog')->inRandomOrder()->take(3)->get();
        $comments = Comment::where('post_id', $data->id)->where('status', Comment::STATUS_APPROVED)->where('parent_id', 0)->orderBy('created_at')->get();
        return view('frontend.pages.news.single', compact('data', 'postOther', 'category', 'comments'));
    }

    public function postContact(Request $request)
    {
        $cus          = new Customers;
        $cus->name    = $request->name;
        $cus->email   = $request->email;
        $cus->phone   = $request->phone;
        $cus->address = $request->address;
        $cus->save();
        $contact              = new Contact;
        $contact->title       = 'Khách hàng liên hệ';
        $contact->type        = 'contact';
        $contact->customer_id = $cus->id;
        $contact->content     = $request->input('content');
        $contact->status      = 0;
        $contact->save();
        $dataEmail = [
            'name'    => $request->name,
            'phone'   => $request->phone,
            'email'   => $request->email,
            'content' => $request->input('content'),
            'title'   => 'Khách hàng liên hệ.',
            'type'    => 'contact',
        ];
        return back()->with([
            'modal_show' => true
        ]);
    }

    public function number(Request $request)
    {
        if($request->has('name') && $request->has('year') && $request->has('month') && $request->has('day') && is_numeric($request->year) && is_numeric($request->month) && is_numeric($request->day)){
            SEO::setTitle("Kết quả");
            $data = $request->all();
            return view('frontend.pages.number', compact('data'));
        }else{
            return redirect()->route('home.index');
        }
    }

    public function result(Request $request)
    {
        
        if($request->has('name') && $request->has('year') && $request->has('month') && $request->has('day') && is_numeric($request->year) && is_numeric($request->month) && is_numeric($request->day)){
            SEO::setTitle("Kết quả tra cứu");
            $data = $request->all();
            $values = $request->day.'/'.$request->month.'/'.$request->year;


             $url = 'https://quantri.matmathanhcong.vn/api/Calculate?customer_name='.$request->name.'&customer_birthdate='.$values;


             $site_info = Options::where('type', 'general')->first();
            $site_info = json_decode($site_info->content);

            $client = new GuzzleClient();
            $requests = new GuzzleRequest('GET', $url);
            $res = $client->sendAsync($requests)->wait();
            $data['quantri'] = json_decode($res->getBody());


            $age = 0;
            $date = new \DateTime(request('year').'/'.request('month').'/'.request('day'));
            $now = new \DateTime();
            $diff = $now->diff($date);
            $age = $diff->y + 1;

            $tach_year = tachkytu(request('year'));
            $data_year = pheptinh($tach_year);
            $kq_year = ketquapheptinh(request('year'),$tach_year);

            $tach_day = tachkytu(request('day'));
            $data_day = pheptinh($tach_day);
            $kq_day = ketquapheptinh(request('day'),$tach_day);

            $tach_month = tachkytu(request('month'));
            $data_month = pheptinh($tach_month);
            $kq_month = ketquapheptinh(request('month'),$tach_month);

            $consoduongdoi = checktotal([$kq_year,$kq_month,$kq_day]);
            $chisosumenh = chisosumenh(str_slug(request('name'),' ', 'en'));
            $consotruongthanh = checktotal($consoduongdoi + $chisosumenh);
            $consothaido = consothaido(request('day'),request('month'));
            $consonamcanhan = checktotal($consothaido + checktotal($now->format('Y')));
            $consolinhhon = consolinhhon(str_slug(request('name'),' ', 'en'));
            $consotinhcach = consotinhcach(str_slug(request('name'),' ', 'en'));
            $ketnoinoitamvatinhcach = abs(checktotal($consolinhhon - $consotinhcach));
            $ketnoiduongdoivasumenh = abs(checktotal($consoduongdoi - $chisosumenh));
            $consongaysinh = $kq_day ;

            $data_solap = array($consongaysinh,$consoduongdoi,$chisosumenh,$consolinhhon,$consotinhcach, $consotruongthanh);
            $checklap = array_count_values($data_solap);
            $loc_mot = array_diff( $checklap, [1] );
            $get_number = array_keys($loc_mot);
            $consosolap = implode(', ',$get_number);

            $thachthuc1 = totalno(abs(totalno(request('day')) - totalno(request('month'))));
            $thachthuc2 = totalno(abs(totalno(request('year')) - totalno(request('day'))));
            $thachthuc3 = totalno(abs($thachthuc1 - $thachthuc2));
            $thachthuc4 = totalno(abs(totalno(request('year')) - totalno(request('month'))));

            $dinhcao2 = totalno(total(request('year')) + total(request('day')));
            $dinhcao1 = totalno(total(request('month')) + total(request('day')));
            $dinhcao3 = totalDinhCao($dinhcao2 + $dinhcao1);
            $dinhcao4 = totalDinhCao(total(request('month')) + total(request('year')));

            $thangcanhan = thangcanhan($consonamcanhan + checktotal($now->format('m')));
            $chisomucdobieuhien = implode(', ',chisomucdobieuhien(str_slug(request('name'),' ', 'en')));

            $consononghiep = consononghiep([$kq_year,$kq_month,$kq_day],str_slug(request('name'),' ', 'en'),request('day'));
            $chisonoicam = chisonoicam(str_slug(request('name'),' ', 'en'));

            $full_number = array_merge($tach_year,$tach_month, $tach_day);

            $data['full_number'] = $full_number;
            $ns_th1 = array_intersect(array_unique($full_number) , [1,5,9]);
            if (count($ns_th1) == 0 || count($ns_th1) == 3) {
                $stt_ns_th1 = 1;
            }else{
                $stt_ns_th1 = 0;
            }
            $ns_th2 = array_intersect(array_unique($full_number) , [1,4,7]);
            if (count($ns_th2) == 0 || count($ns_th2) == 3) {
                $stt_ns_th2 = 1;
            }else{
                $stt_ns_th2 = 0;
            }
            $ns_th3 = array_intersect(array_unique($full_number) , [2,5,8]);
            if (count($ns_th3) == 0 || count($ns_th3) == 3) {
                $stt_ns_th3 = 1;
            }else{
                $stt_ns_th3 = 0;
            }
            $ns_th4 = array_intersect(array_unique($full_number) , [3,6,9]);
            if (count($ns_th4) == 0 || count($ns_th4) == 3) {
                $stt_ns_th4 = 1;
            }else{
                $stt_ns_th4 = 0;
            }
            $ns_th5 = array_intersect(array_unique($full_number) , [4,5,6]);
            if (count($ns_th5) == 0 || count($ns_th5) == 3) {
                $stt_ns_th5 = 1;
            }else{
                $stt_ns_th5 = 0;
            }
            $ns_th6 = array_intersect(array_unique($full_number) , [7,8,9]);
            if (count($ns_th6) == 0 || count($ns_th6) == 3) {
                $stt_ns_th6 = 1;
            }else{
                $stt_ns_th6 = 0;
            }
            $ns_th7 = array_intersect(array_unique($full_number) , [1,2,3]);
            if (count($ns_th7) == 0 || count($ns_th7) == 3) {
                $stt_ns_th7 = 1;
            }else{
                $stt_ns_th7 = 0;
            }
            $ns_th8 = array_intersect(array_unique($full_number) , [3,5,7]);
            if (count($ns_th8) == 0 || count($ns_th8) == 3) {
                $stt_ns_th8 = 1;
            }else{
                $stt_ns_th8 = 0;
            }


            $name_slug = str_slug(request('name'),' ', 'en');
            $full_name = getArrayName($name_slug);

            $name_th1 = array_intersect(array_keys($full_name) , [1,5,9]);
            if (count($name_th1) == 0 || count($name_th1) == 3) {
                $stt_name_th1 = 1;
            }else{
                $stt_name_th1 = 0;
            }
            $name_th2 = array_intersect(array_keys($full_name) , [1,4,7]);
            if (count($name_th2) == 0 || count($name_th2) == 3) {
                $stt_name_th2 = 1;
            }else{
                $stt_name_th2 = 0;
            }
            $name_th3 = array_intersect(array_keys($full_name) , [2,5,8]);
            if (count($name_th3) == 0 || count($name_th3) == 3) {
                $stt_name_th3 = 1;
            }else{
                $stt_name_th3 = 0;
            }
            $name_th4 = array_intersect(array_keys($full_name) , [3,6,9]);
            if (count($name_th4) == 0 || count($name_th4) == 3) {
                $stt_name_th4 = 1;
            }else{
                $stt_name_th4 = 0;
            }
            $name_th5 = array_intersect(array_keys($full_name) , [4,5,6]);
            if (count($name_th5) == 0 || count($name_th5) == 3) {
                $stt_name_th5 = 1;
            }else{
                $stt_name_th5 = 0;
            }
            $name_th6 = array_intersect(array_keys($full_name) , [7,8,9]);
            if (count($name_th6) == 0 || count($name_th6) == 3) {
                $stt_name_th6 = 1;
            }else{
                $stt_name_th6 = 0;
            }
            $name_th7 = array_intersect(array_keys($full_name) , [1,2,3]);
            if (count($name_th7) == 0 || count($name_th7) == 3) {
                $stt_name_th7 = 1;
            }else{
                $stt_name_th7 = 0;
            }
            $name_th8 = array_intersect(array_keys($full_name) , [3,5,7]);
            if (count($name_th8) == 0 || count($name_th8) == 3) {
                $stt_name_th8 = 1;
            }else{
                $stt_name_th8 = 0;
            }

            $data['full_name'] = $full_name;
            $data['stt_name_th8'] = $stt_name_th8;
            $data['stt_name_th7'] = $stt_name_th7;
            $data['stt_name_th6'] = $stt_name_th6;
            $data['stt_name_th5'] = $stt_name_th5;
            $data['stt_name_th4'] = $stt_name_th4;
            $data['stt_name_th3'] = $stt_name_th3;
            $data['stt_name_th2'] = $stt_name_th2;
            $data['stt_name_th1'] = $stt_name_th1;

            $data['stt_ns_th8'] = $stt_ns_th8;
            $data['stt_ns_th7'] = $stt_ns_th7;
            $data['stt_ns_th6'] = $stt_ns_th6;
            $data['stt_ns_th5'] = $stt_ns_th5;
            $data['stt_ns_th4'] = $stt_ns_th4;
            $data['stt_ns_th3'] = $stt_ns_th3;
            $data['stt_ns_th2'] = $stt_ns_th2;
            $data['stt_ns_th1'] = $stt_ns_th1;
            $data['data_day'] = $data_day;
            $data['kq_day'] = $kq_day;
            $data['data_month'] = $data_month;
            $data['kq_month'] = $kq_month;
            $data['data_year'] = $data_year;
            $data['kq_year'] = $kq_year;
            $data['consoduongdoi'] = $consoduongdoi;
            $data['thachthuc1'] = $thachthuc1;
            $data['thachthuc2'] = $thachthuc2;
            $data['thachthuc3'] = $thachthuc3;
            $data['thachthuc4'] = $thachthuc4;
            $data['dinhcao1'] = $dinhcao1;
            $data['dinhcao2'] = $dinhcao2;
            $data['dinhcao3'] = $dinhcao3;
            $data['dinhcao4'] = $dinhcao4;
            $data['consolinhhon'] = $consolinhhon; 
            $data['consotinhcach'] = $consotinhcach; 
            $data['consothaido'] = $consothaido; 
            $data['consosolap'] = $consosolap; 
            $data['ketnoinoitamvatinhcach'] = $ketnoinoitamvatinhcach; 
            $data['chisosumenh'] = $chisosumenh; 
            $data['consongaysinh'] = $consongaysinh; 
            $data['consotruongthanh'] = $consotruongthanh; 
            $data['ketnoiduongdoivasumenh'] = $ketnoiduongdoivasumenh; 
            $data['consononghiep'] = empty($consononghiep) ? 0 : $consononghiep; 
            $data['chisomucdobieuhien'] = $chisomucdobieuhien; 
            $data['consonamcanhan'] = $consonamcanhan; 
            $data['thangcanhan'] = $thangcanhan; 
            $data['chisonoicam'] = $chisonoicam;
            $data['age'] = $age;
            $data['consocanbang'] = chisocanbang(str_slug(request('name'),' ', 'en'));
            // $file_name = str_slug($request->name).$request->day.$request->month.$request->year;
            // $text = "file 'mp3/intro.mp3'"."\r\n".get_name('duongdoi',$consoduongdoi)."file 'mp3/intro_sumenh.mp3'"."\r\n".get_name('sumenh',$chisosumenh)."file 'mp3/intro_noitam.mp3'"."\r\n"."file 'mp3/intro_form.mp3'"."\r\n";
            // Storage::disk('data')->put($file_name.'.txt', $text);

            // $mp3[] = '/tuvi/uploads/mp3/intro.mp3';
            // $mp3 = get_link('duongdoi',$consoduongdoi,$mp3);
            // $mp3[] = '/tuvi/uploads/mp3/intro_sumenh.mp3';
            // $mp3 = get_link('sumenh',$chisosumenh,$mp3);
            // $mp3[] = '/tuvi/uploads/mp3/intro_noitam.mp3';
            // $mp3[] = '/tuvi/uploads/mp3/intro_form.mp3';

            $n = Number::orderBy('conso')->get()->groupBy(['type','conso']);
            $mp3 = array();
            $content = array();
            $mp3 = get_intro('intro','intro',$mp3,$content,$n)[0];
            $content = get_intro('intro','intro',$mp3,$content,$n)[1];
            $slide[0] = count($content);
            
            $mp3 = get_data('duongdoi',$consoduongdoi,$mp3,$content,$n)[0];
            $content = get_data('duongdoi',$consoduongdoi,$mp3,$content,$n)[1];
            $slide[1] = count($content);

            $mp3 = get_intro('sumenh','intro',$mp3,$content,$n)[0];
            $content = get_intro('sumenh','intro',$mp3,$content,$n)[1];

            $mp3 = get_data('sumenh',$chisosumenh,$mp3,$content,$n)[0];
            $content = get_data('sumenh',$chisosumenh,$mp3,$content,$n)[1];
            $slide[2] = count($content);

            // $mp3 = get_intro('noitam','intro',$mp3,$content,$n)[0];
            // $content = get_intro('noitam','intro',$mp3,$content,$n)[1];

            $mp3 = get_intro('intro','form',$mp3,$content,$n)[0];
            $content = get_intro('intro','form',$mp3,$content,$n)[1];
            // $content[] = isset($n['intro']['intro'][0]) ? $n['intro']['intro'][0] : '';
            // $content[] = isset($n['duongdoi'][$consoduongdoi][0]) ? $n['duongdoi'][$consoduongdoi][0] : '';
            // $content[] = isset($n['sumenh']['intro'][0]) ? $n['sumenh']['intro'][0] : '';
            // $content[] = isset($n['sumenh'][$chisosumenh][0]) ? $n['sumenh'][$chisosumenh][0] : '';
            // $content[] = isset($n['noitam']['intro'][0]) ? $n['noitam']['intro'][0] : '';
            // $content[] = isset($n['intro']['form'][0]) ? $n['intro']['form'][0] : '';

            // $data['file_name'] = $file_name;
            $data['file_name'] = '';
            $data['mp3'] = $mp3;
            $data['content'] = $content;
            $data['slide'] = $slide;
             
            return view('frontend.pages.result', $data);
        }else{
            return redirect()->route('home.index');
        }
    }

    public function resultvip(Request $request)
    {

        if($request->has('customer_name') && $request->has('customer_birthdate') && $request->has('customer_phone') && $request->has('customer_email') && $request->has('customer_address')){
            SEO::setTitle("Kết quả tra cứu");
            $data = $request->all();
            $values = $request->day.'/'.$request->month.'/'.$request->year;

            $date = '';
            //$url = 'https://quantri.matmathanhcong.vn/api/Calculate/GetLinkApi?customer_name='.$request->customer_name.'&customer_birthdate='.$request->customer_birthdate.'&customer_phone='.$request->customer_phone.'&customer_email='.$request->customer_email.'&customer_address='.$request->customer_address;

            //$url = 'https://quayso.xyz/addUserAPI?fullName='.$request->customer_name.'&phone='.$request->customer_phone.'&email='.$request->customer_email.'&note='.$request->customer_address.'&job='.$request->customer_birthdate.'&idMessUser='.$date.'&campaign=6492b3aa0cbee167318b4567';
            $url = 'https://quayso.xyz/addUserAPI';
            $return = '';
            $response = array('fullName' => $request->customer_name,
                    'phone' => $request->customer_phone,
                    'email' => $request->customer_email,
                    'note' => $request->customer_address,
                    'job' => $request->customer_birthdate,
                    'idMessUser' => '',
                    'campaign' => '6492b3aa0cbee167318b4567',
                    );


            $ch = curl_init();

            // Thiết lập URL đích
            curl_setopt($ch, CURLOPT_URL, $url);

            // Thiết lập phương thức là POST
            curl_setopt($ch, CURLOPT_POST, 1);

          
            curl_setopt($ch, CURLOPT_POSTFIELDS, $response);

            // Thiết lập để nhận phản hồi từ yêu cầu POST
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Gửi yêu cầu
            $return = curl_exec($ch);

     

            $datas = str_replace('﻿', '', $return);
            $datas = str_replace('&quot;', '"', utf8_encode($datas));

            $dataAPI = json_decode($datas, true);

            $price = 500000;
            $key_banking = 'MMTC';
            $campain_code = 'C47';
            $codeQT = $dataAPI['set_attributes']['codeQT'];

            $data = 'https://img.vietqr.io/image/TPB-06931228686-compact2.png?amount='.$price.'&addInfo='.$key_banking.'%20'.$codeQT.'%20'.$campain_code.'&accountName=Trần Ngọc Mạnh';

            
           return view('frontend.pages.resultvip',  compact('data'));

           
           
        }else{
            return redirect()->route('home.index');
        }

    }

    public function resultform(Request $request)
    {
            $data = $request->all();

            $age = 0;
            $date = new \DateTime(request('year').'/'.request('month').'/'.request('day'));
            $now = new \DateTime();
            $diff = $now->diff($date);
            $age = $diff->y + 1;

            $tach_year = tachkytu(request('year'));
            $data_year = pheptinh($tach_year);
            $kq_year = ketquapheptinh(request('year'),$tach_year);

            $tach_day = tachkytu(request('day'));
            $data_day = pheptinh($tach_day);
            $kq_day = ketquapheptinh(request('day'),$tach_day);

            $tach_month = tachkytu(request('month'));
            $data_month = pheptinh($tach_month);
            $kq_month = ketquapheptinh(request('month'),$tach_month);

            $consoduongdoi = checktotal([$kq_year,$kq_month,$kq_day]);
            $chisosumenh = chisosumenh(str_slug(request('name'),' ', 'en'));
            $consotruongthanh = checktotal($consoduongdoi + $chisosumenh);
            $consothaido = consothaido(request('day'),request('month'));
            $consonamcanhan = checktotal($consothaido + checktotal($now->format('Y')));
            $consolinhhon = consolinhhon(str_slug(request('name'),' ', 'en'));
            $consotinhcach = consotinhcach(str_slug(request('name'),' ', 'en'));
            $ketnoinoitamvatinhcach = abs(checktotal($consolinhhon - $consotinhcach));
            $ketnoiduongdoivasumenh = abs(checktotal($consoduongdoi - $chisosumenh));
            $consongaysinh = $kq_day;

            $data_solap = array($consongaysinh,$consoduongdoi,$chisosumenh,$consolinhhon,$consotinhcach, $consotruongthanh);
            $checklap = array_count_values($data_solap);
            $loc_mot = array_diff( $checklap, [1] );
            $get_number = array_keys($loc_mot);
            $consosolap = implode(', ',$get_number);

            $thachthuc1 = totalno(abs(totalno(request('day')) - totalno(request('month'))));
            $thachthuc2 = totalno(abs(totalno(request('year')) - totalno(request('day'))));
            $thachthuc3 = totalno(abs($thachthuc1 - $thachthuc2));
            $thachthuc4 = totalno(abs(totalno(request('year')) - totalno(request('month'))));

            $dinhcao2 = total(total(request('year')) + total(request('day')));
            $dinhcao1 = total(total(request('month')) + total(request('day')));
            $dinhcao3 = totalDinhCao($dinhcao2 + $dinhcao1);
            $dinhcao4 = totalDinhCao(total(request('month')) + total(request('year')));

            $thangcanhan = thangcanhan($consonamcanhan + checktotal($now->format('m')));
            $chisomucdobieuhien = implode(', ',chisomucdobieuhien(str_slug(request('name'),' ', 'en')));

            $consononghiep = consononghiep([$kq_year,$kq_month,$kq_day],str_slug(request('name'),' ', 'en'),request('day'));
            $chisonoicam = chisonoicam(str_slug(request('name'),' ', 'en'));

            // $file_name = str_slug($request->name).$request->day.$request->month.$request->year.'-form';
            // $text = "file 'mp3/form_success.mp3'"."\r\n".get_name('noitam',$consolinhhon)."file 'mp3/intro_tinhcach.mp3'"."\r\n".get_name('tuongtac',$consotinhcach)."file 'mp3/intro_ket.mp3'";
            // Storage::disk('data')->put($file_name.'.txt', $text);
            
            // $mp3 = array();
            // $mp3[] = '/tuvi/uploads/mp3/form_success.mp3';
            // $mp3 = get_link('noitam',$consolinhhon,$mp3);
            // $mp3[] = '/tuvi/uploads/mp3/intro_tinhcach.mp3';
            // $mp3 = get_link('tuongtac',$consotinhcach,$mp3);
            // $mp3[] = '/tuvi/uploads/mp3/intro_ket.mp3';

            // $n = Number::orderBy('conso')->get()->groupBy(['type','conso']);
            // $content = array();
            // $content[] = isset($n['intro']['form_success'][0]) ? $n['intro']['form_success'][0] : '';
            // $content[] = isset($n['noitam'][$consolinhhon][0]) ? $n['noitam'][$consolinhhon][0] : '';
            // $content[] = isset($n['tuongtac']['intro'][0]) ? $n['tuongtac']['intro'][0] : '';
            // $content[] = isset($n['tuongtac'][$consotinhcach][0]) ? $n['tuongtac'][$consotinhcach][0] : '';
            // $content[] = isset($n['end']['end'][0]) ? $n['end']['end'][0] : '';



            $n = Number::orderBy('conso')->get()->groupBy(['type','conso']);
            $mp3 = array();
            $content = array();
            $mp3 = get_intro('intro','form_success',$mp3,$content,$n)[0];
            $content = get_intro('intro','form_success',$mp3,$content,$n)[1];

            $mp3 = get_data('noitam',$consolinhhon,$mp3,$content,$n)[0];
            $content = get_data('noitam',$consolinhhon,$mp3,$content,$n)[1];

            $slide[0] = count($content);
            $mp3 = get_intro('tuongtac','intro',$mp3,$content,$n)[0];
            $content = get_intro('tuongtac','intro',$mp3,$content,$n)[1];

            $mp3 = get_data('tuongtac',$consotinhcach,$mp3,$content,$n)[0];
            $content = get_data('tuongtac',$consotinhcach,$mp3,$content,$n)[1];

            $mp3 = get_intro('end','end',$mp3,$content,$n)[0];
            $content = get_intro('end','end',$mp3,$content,$n)[1];

            // $data['file_name'] = $file_name;
            $data['file_name'] = '';
            $data['mp3'] = $mp3;
            $data['content'] = $content;
            $data['slide'] = $slide;
            $data['total'] = count($content);

            $cus = new Customers;
            $cus->name = $request->name;
            $cus->email = $request->email;
            $cus->phone = $request->phone;
            $cus->save();
            $contact = new Contact;
            $contact->title = 'Khách hàng tra cứu';
            $contact->type = 'contact';
            $contact->customer_id = $cus->id;
            $contact->content = 'Tình trạng '.$request->tinhtrang.' Giới tính '.$request->sex;
            $contact->status = 0;
            $contact->save();
            return response()->json(['data' => $data]);
    }
}
