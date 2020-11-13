<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\AreasRepositoryInterface;
use App\Repositories\Interfaces\PagesRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Utilities\AppStore;
use Illuminate\Http\Request;
use Spatie\Newsletter\NewsletterFacade as Newsletter;

class PagesController extends Controller
{
    private $pagesRepository;
    private $settingRepository;
    private $areasRepository;

    public function __construct(PagesRepositoryInterface $pagesRepository, SettingRepositoryInterface $settingRepository, AreasRepositoryInterface $areasRepository)
    {
        $this->pagesRepository = $pagesRepository;
        $this->settingRepository = $settingRepository;
        $this->areasRepository = $areasRepository;
    }

    public function index($slug)
    {
        $pageContent = $this->pagesRepository->getPageBySlug($slug);
        $pageContent = $pageContent[0];
        $settings = $this->getSettings();
        $socialLinks = $settings['socialLinks'];
        $pixel = $settings['pixel'];
        $cookie_warning_msg = $settings['cookie_msg'];

        return view('pages.index', compact('slug', 'pageContent', 'socialLinks', 'pixel', 'cookie_warning_msg'));
    }

    public function home(Request $request)
    {

        $settings = $this->getSettings();
        $socialLinks = $settings['socialLinks'];
        $pixel = $settings['pixel'];
        $cookie_warning_msg = $settings['cookie_msg'];
        $home_page_title = $settings['home_page_title'];
        $AreaGymsObj = $this->areasRepository->getInfoWithGyms();
        $areaArr = array();
        $gymArr = array();
        $a = 0;
        $z = 0;
        foreach ($AreaGymsObj as $AreaGyms) {
            $areaArr[$a]['name'] = $AreaGyms['name'];
            $areaArr[$a]['gyms'] = count($AreaGyms['gyms']);
            foreach ($AreaGyms['gyms'] as $gym) {
                $gymArr[$z] = $gym;
                $z++;
            }
            $a++;
        }
        $bookSoloAppURL = AppStore::isAndroid($request) ? $socialLinks['android_app_url'] : $socialLinks['ios_app_url'];

        return view('home', compact('socialLinks', 'areaArr', 'gymArr', 'bookSoloAppURL', 'pixel', 'cookie_warning_msg', 'home_page_title'));
    }

    public function personaltrainer(Request $request)
    {
        $settings = $this->getSettings();
        $socialLinks = $settings['socialLinks'];
        $pixel = $settings['pixel'];
        $cookie_warning_msg = $settings['cookie_msg'];
        $page_title = "Personal Trainers";
        $AreaGymsObj = $this->areasRepository->getInfoWithGyms();
        $areaArr = array();
        $gymArr = array();
        $a = 0;
        $z = 0;
        foreach ($AreaGymsObj as $AreaGyms) {
            $areaArr[$a]['name'] = $AreaGyms['name'];
            $areaArr[$a]['gyms'] = count($AreaGyms['gyms']);
            foreach ($AreaGyms['gyms'] as $gym) {
                $gymArr[$z] = $gym;
                $z++;
            }
            $a++;
        }
        $bookSoloAppURL = AppStore::isAndroid($request) ? $socialLinks['android_app_url'] : $socialLinks['ios_app_url'];

        return view('personaltrainer', compact('socialLinks', 'areaArr', 'gymArr', 'bookSoloAppURL', 'pixel', 'cookie_warning_msg', 'page_title'));
    }


    public function faq(Request $request)
    {
        $settings = $this->getSettings();
        $socialLinks = $settings['socialLinks'];
        $pixel = $settings['pixel'];
        $cookie_warning_msg = $settings['cookie_msg'];
        $home_page_title = $settings['home_page_title'];
        $AreaGymsObj = $this->areasRepository->getInfoWithGyms();
        $areaArr = array();
        $gymArr = array();
        $a = 0;
        $z = 0;
        foreach ($AreaGymsObj as $AreaGyms) {
            $areaArr[$a]['name'] = $AreaGyms['name'];
            $areaArr[$a]['gyms'] = count($AreaGyms['gyms']);
            foreach ($AreaGyms['gyms'] as $gym) {
                $gymArr[$z] = $gym;
                $z++;
            }
            $a++;
        }
        $bookSoloAppURL = AppStore::isAndroid($request) ? $socialLinks['android_app_url'] : $socialLinks['ios_app_url'];

        return view('faq', compact('socialLinks', 'areaArr', 'gymArr', 'bookSoloAppURL', 'pixel', 'cookie_warning_msg', 'home_page_title'));
    }

    public function homenew(Request $request)
    {

        $settings = $this->getSettings();
        $socialLinks = $settings['socialLinks'];
        $pixel = $settings['pixel'];
        $cookie_warning_msg = $settings['cookie_msg'];
        $home_page_title = $settings['home_page_title'];
        $AreaGymsObj = $this->areasRepository->getInfoWithGyms();
        $areaArr = array();
        $gymArr = array();
        $a = 0;
        $z = 0;
        foreach ($AreaGymsObj as $AreaGyms) {
            $areaArr[$a]['name'] = $AreaGyms['name'];
            $areaArr[$a]['gyms'] = count($AreaGyms['gyms']);
            foreach ($AreaGyms['gyms'] as $gym) {
                $gymArr[$z] = $gym;
                $z++;
            }
            $a++;
        }
        $bookSoloAppURL = AppStore::isAndroid($request) ? $socialLinks['android_app_url'] : $socialLinks['ios_app_url'];

        return view('homenew', compact('socialLinks', 'areaArr', 'gymArr', 'bookSoloAppURL', 'pixel', 'cookie_warning_msg', 'home_page_title'));
    }

    /**
     * @return array
     */
    private function getSettings()
    {
        $setting = $this->settingRepository->getInfo();
        $socialLinks = array();
        $socialLinks['facebook_url'] = $setting['facebook_url'];
        $socialLinks['twitter_url'] = $setting['twitter_url'];
        $socialLinks['instagram_url'] = $setting['instagram_url'];
        $socialLinks['linkedin_url'] = $setting['linkedin_url'];
        $socialLinks['youtube_url'] = $setting['youtube_url'];
        $socialLinks['ios_app_url'] = $setting['ios_app_url'];
        $socialLinks['android_app_url'] = $setting['android_app_url'];
        $info['socialLinks'] = $socialLinks;
        $pixel = array();
        $pixel['facebook_pixel'] = $setting['facebook_pixel'];
        $pixel['google_analytics'] = $setting['google_analytics'];
        $info['pixel'] = $pixel;
        $cookieMsg = array();
        $cookieMsg['cookie_show'] = $setting['cookies_warning'];
        $cookieMsg['cookies_warning_text'] = $setting['cookies_warning_text'];
        $info['cookie_msg'] = $cookieMsg;
        $info['home_page_title'] = $setting['site_title'];

        return $info;
    }

    public function subscribe_pt(Request $request)
    {
        $validateData = [
            'name' => ['required'],
            'email' => ['required', 'email'],
        ];
        $formData = $request->validate($validateData);
        if ( !Newsletter::isSubscribed($request->get('email'), 'pt_list') ) {
            Newsletter::subscribe($request->get('email'), ['FNAME' => $request->get('name')], 'pt_list');
            $arr['success'] = ['msg' => 'You’re signed up! Please check your email (and sometimes junk) for updates.'];
            return response()->json($arr);
        }

        $arr['errors'] = ['msg' => 'You are already registered.'];
        return response()->json($arr, 422);
    }

    public function subscribe_email(Request $request)
    {
        $validateData = [
            'email' => ['required', 'email'],
        ];
        $formData = $request->validate($validateData);
        if ( !Newsletter::isSubscribed($request->get('email'), 'subscribers') ) {
            Newsletter::subscribe($request->get('email'), [], 'subscribers');
            $arr['success'] = ['msg' => 'You’re signed up! Stay tuned for updates.'];
            return response()->json($arr);
        }

        $arr['errors'] = ['msg' => 'You are already subscribed.'];
        return response()->json($arr, 422);
    }

}
