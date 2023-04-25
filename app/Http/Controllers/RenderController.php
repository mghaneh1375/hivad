<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleJSON;
use App\Http\Resources\GalleryJSON;
use App\Http\Resources\IntroduceJSON;
use App\Http\Resources\NewsJSON;
use App\Http\Resources\SliderBarJSON;
use App\Http\Resources\CategoryJSON;
use App\Http\Resources\FieldResource;
use App\Http\Resources\MyProductJSON;
use App\Http\Resources\ProductJSON;
use App\Http\Resources\SliderCafe;
use App\Http\Resources\VideoCategoryJSON;
use App\Models\Article;
use App\Models\Cafe;
use App\Models\Config;
use App\Models\Gallery;
use App\Models\Introduce;
use App\Models\Category;
use App\Models\Field;
use App\Models\News;
use App\Models\Product;
use App\Models\SlideBar;
use App\Models\Video;
use Illuminate\Http\Request;

class RenderController extends Controller
{

    public function get_fields($mode) {

        if($mode == 'survey')
            return ["fields" => FieldResource::collection(Field::survey()->visible()->orderBy('priority', 'asc')->get())];
            
        return ["fields" => FieldResource::collection(Field::advice()->visible()->orderBy('priority', 'asc')->get())];
    }
    
    public function get_cafe_sliders()
    {
        return SliderCafe::collection(Cafe::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_sliders()
    {
        return SliderBarJSON::collection(SlideBar::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_galleries()
    {
        return GalleryJSON::collection(Gallery::imp()->orderBy('priority', 'asc')->get());
    }
    
    public function get_videos()
    {
        return GalleryJSON::collection(Video::imp()->orderBy('priority', 'asc')->get());
    }

    public function get_news()
    {
        return NewsJSON::collection(News::imp()->orderBy('priority', 'asc')->take(8)->get());
    }
    
    public function get_articles()
    {
        return ArticleJSON::collection(Article::imp()->orderBy('priority', 'asc')->take(8)->get());
    }

    public function get_all_news()
    {
        return NewsJSON::collection(News::visible()->orderBy('priority', 'asc')->get());
    }

    
    public function get_all_products()
    {
        return ProductJSON::collection(Product::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_video_categories()
    {
        return VideoCategoryJSON::collection(Category::visible()->has('videos')->orderBy('priority', 'asc')->get());
    }

    public function get_my_products(Request $request)
    {
        $myProducts = 
            $request->user()->transactions()->complete()->with('product')->get();

        return MyProductJSON::collection($myProducts);
    }

    public function get_introduce()
    {
        return IntroduceJSON::collection(Introduce::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_categories()
    {
        $cats = Category::where('section', 'gallery')->visible()->orderBy('priority', 'asc')->get();
        $wantedCats = [];

        foreach ($cats as $cat) {

            $numOfGalleries = $cat->galleries()->count();
            if($numOfGalleries == 0)
                continue;

            $cat->numOfGalleries = $numOfGalleries;
            array_push($wantedCats, $cat);
        }

        return CategoryJSON::collection($wantedCats);
    }
    
    public function get_article_categories()
    {
        $cats = Category::where('section', 'article')->visible()->orderBy('priority', 'asc')->get();
        $wantedCats = [];

        foreach ($cats as $cat) {

            $numOfArticles = $cat->articles()->count();
            if($numOfArticles == 0)
                continue;

            $cat->numOfGalleries = $numOfArticles;
            array_push($wantedCats, $cat);
        }

        return CategoryJSON::collection($wantedCats);
    }
    

    public function render_survey() {

        return [
            [
                [
                    "BoxID" => 39184, 
                    "MenuID" => 98423, 
                    "BoxTitle" => "نظرسنجی", 
                    "BoxDescription" => "", 
                    "Priority" => 1, 
                    "Width" => null, 
                    "Height" => null, 
                    "BoxCount" => 1, 
                    "MaduleID" => null, 
                    "SubBoxHeight" => null, 
                    "BoxCountPerRow" => 1, 
                    "FormID" => "survey", 
                    "FormReportID" => null, 
                    "BoxGroupID" => 6, 
                    "BoxGroupName" => "form", 
                    "BoxPersianName" => "ÙØ±Ù… ÙˆØ±ÙˆØ¯ Ø§Ø·Ù„Ø§Ø¹Ø§Øª", 
                    "Pagination" => 2, 
                    "SortType" => 1, 
                    "Content" => null, 
                    "MediaID" => null, 
                    "HasProductTabs" => null, 
                    "ProductSlides" => null, 
                    "RowIDList" => null, 
                    "BoxStyle" => "", 
                    "PopupStyle" => false, 
                    "BoxTemp" => null, 
                    "ShowMoreLink" => null, 
                    "ContainerTabs" => null, 
                    "WebsiteDisplay" => true, 
                    "MobileDisplay" => true, 
                    "Background" => null, 
                    "ParallaxStyle" => null, 
                    "DisableBoxBack" => null, 
                    "BackTitleColor" => null, 
                    "DisableBoxBackgroundColor" => null, 
                    "BoxBackgroundColor" => null, 
                    "BlurEffectBack" => null, 
                    "BlackEffectBack" => null, 
                    "ButtonList" => [
                    ], 
                    "Platform7Maduleid" => null, 
                    "GroupMaduleBox" => null, 
                    "IsAmazzingoffer" => false 
                ],
                [
                    "BoxID" => 39407, 
                    "MenuID" => 29453, 
                    "BoxTitle" => "", 
                    "BoxDescription" => null, 
                    "Priority" => 2, 
                    "Width" => null, 
                    "Height" => 250, 
                    "BoxCount" => 1, 
                    "MaduleID" => null, 
                    "SubBoxHeight" => null, 
                    "BoxCountPerRow" => 1, 
                    "FormID" => null, 
                    "FormReportID" => null, 
                    "BoxGroupID" => 7, 
                    "BoxGroupName" => "singleImage", 
                    "BoxPersianName" => "ØªØµÙˆÛŒØ±", 
                    "Pagination" => 2, 
                    "SortType" => 1, 
                    "Content" => null, 
                    "MediaID" => null, 
                    "HasProductTabs" => null, 
                    "ProductSlides" => null, 
                    "RowIDList" => null, 
                    "BoxStyle" => "paralax", 
                    "PopupStyle" => false, 
                    "BoxTemp" => null, 
                    "ShowMoreLink" => null, 
                    "ContainerTabs" => null, 
                    "WebsiteDisplay" => true, 
                    "MobileDisplay" => true, 
                    "Background" => null, 
                    "ParallaxStyle" => null, 
                    "DisableBoxBack" => null, 
                    "BackTitleColor" => null, 
                    "DisableBoxBackgroundColor" => null, 
                    "BoxBackgroundColor" => null, 
                    "BlurEffectBack" => null, 
                    "BlackEffectBack" => null, 
                    "ButtonList" => [
                    ], 
                    "Platform7Maduleid" => null, 
                    "GroupMaduleBox" => null, 
                    "IsAmazzingoffer" => false 
                ]
            ],
            [
                [
                    "BoxID" => 39184, 
                    "Content" => [
                        "foreignTableFields" => [
                        ], 
                        "shahrs" => "<option>Ø§Ù†ØªØ®Ø§Ø¨ Ø§Ø³ØªØ§Ù†</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ</option><option value='Ø§Ø±Ø¯Ø¨ÙŠÙ„'>Ø§Ø±Ø¯Ø¨ÙŠÙ„</option><option value='Ø§ØµÙÙ‡Ø§Ù†'>Ø§ØµÙÙ‡Ø§Ù†</option><option value='Ø§Ù„Ø¨Ø±Ø²'>Ø§Ù„Ø¨Ø±Ø²</option><option value='Ø§ÙŠÙ„Ø§Ù…'>Ø§ÙŠÙ„Ø§Ù…</option><option value='Ø¨ÙˆØ´Ù‡Ø±'>Ø¨ÙˆØ´Ù‡Ø±</option><option value='ØªÙ‡Ø±Ø§Ù†'>ØªÙ‡Ø±Ø§Ù†</option><option value='Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ'>Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ</option><option value='Ø®ÙˆØ²Ø³ØªØ§Ù†'>Ø®ÙˆØ²Ø³ØªØ§Ù†</option><option value='Ø²Ù†Ø¬Ø§Ù†'>Ø²Ù†Ø¬Ø§Ù†</option><option value='Ø³Ù…Ù†Ø§Ù†'>Ø³Ù…Ù†Ø§Ù†</option><option value='Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†'>Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†</option><option value='ÙØ§Ø±Ø³'>ÙØ§Ø±Ø³</option><option value='Ù‚Ø²ÙˆÙŠÙ†'>Ù‚Ø²ÙˆÙŠÙ†</option><option value='Ù‚Ù…'>Ù‚Ù…</option><option value='ÙƒØ±Ø¯Ø³ØªØ§Ù†'>ÙƒØ±Ø¯Ø³ØªØ§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†'>ÙƒØ±Ù…Ø§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡'>ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡</option><option value='ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯'>ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯</option><option value='Ú¯Ù„Ø³ØªØ§Ù†'>Ú¯Ù„Ø³ØªØ§Ù†</option><option value='Ú¯ÙŠÙ„Ø§Ù†'>Ú¯ÙŠÙ„Ø§Ù†</option><option value='Ù„Ø±Ø³ØªØ§Ù†'>Ù„Ø±Ø³ØªØ§Ù†</option><option value='Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†'>Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†</option><option value='Ù…Ø±ÙƒØ²ÙŠ'>Ù…Ø±ÙƒØ²ÙŠ</option><option value='Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†'>Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†</option><option value='Ù‡Ù…Ø¯Ø§Ù†'>Ù‡Ù…Ø¯Ø§Ù†</option><option value='ÙŠØ²Ø¯'>ÙŠØ²Ø¯</option>", 
                        "formDynamicOptionDataList" => [
                        ],
                        "formBiulderData" => json_encode($this->get_fields('survey')),
                        "CaptchaLength" => null, 
                        "FormName" => "نظرسنجی", 
                        "IsEditable" => false, 
                        "RegistrationRequired" => false, 
                        "ISClubMember" => false, 
                        "Multiplerowperuser" => false, 
                        "IsOnlinePayment" => false, 
                        "IsOnlineOrder" => false, 
                        "BottonText" => "ثبت نهایی", 
                        "formDataList" => null, 
                        "editedLogID" => null, 
                        "editedTrackingCode" => "-1", 
                        "isAuthenticated" => false, 
                        "userGroupDiscount" => 0, 
                        "totalPrice" => 0 
                    ] 
                ], 
                [
                    "BoxID" => 39407, 
                    "Content" => [
                        "boxTitle" => "", 
                        "boxDescription" => null, 
                        "MediaID" => 25644 
                    ]
                ]
            ]
        ];

    }

    
    public function render_advice_request() {

        return [
            [
                [
                    "BoxID" => 39184, 
                    "MenuID" => 29453, 
                    "BoxTitle" => "درخواست مشاوره", 
                    "BoxDescription" => "", 
                    "Priority" => 1, 
                    "Width" => null, 
                    "Height" => null, 
                    "BoxCount" => 1, 
                    "MaduleID" => null, 
                    "SubBoxHeight" => null, 
                    "BoxCountPerRow" => 1, 
                    "FormID" => "advice",
                    "FormReportID" => null, 
                    "BoxGroupID" => 6, 
                    "BoxGroupName" => "form", 
                    "BoxPersianName" => "ÙØ±Ù… ÙˆØ±ÙˆØ¯ Ø§Ø·Ù„Ø§Ø¹Ø§Øª", 
                    "Pagination" => 2, 
                    "SortType" => 1, 
                    "Content" => null, 
                    "MediaID" => null, 
                    "HasProductTabs" => null, 
                    "ProductSlides" => null, 
                    "RowIDList" => null, 
                    "BoxStyle" => "", 
                    "PopupStyle" => false, 
                    "BoxTemp" => null, 
                    "ShowMoreLink" => null, 
                    "ContainerTabs" => null, 
                    "WebsiteDisplay" => true, 
                    "MobileDisplay" => true, 
                    "Background" => null, 
                    "ParallaxStyle" => null, 
                    "DisableBoxBack" => null, 
                    "BackTitleColor" => null, 
                    "DisableBoxBackgroundColor" => null, 
                    "BoxBackgroundColor" => null, 
                    "BlurEffectBack" => null, 
                    "BlackEffectBack" => null, 
                    "ButtonList" => [
                    ], 
                    "Platform7Maduleid" => null, 
                    "GroupMaduleBox" => null, 
                    "IsAmazzingoffer" => false 
                ],
                [
                    "BoxID" => 39407, 
                    "MenuID" => 29453, 
                    "BoxTitle" => "", 
                    "BoxDescription" => null, 
                    "Priority" => 2, 
                    "Width" => null, 
                    "Height" => 250, 
                    "BoxCount" => 1, 
                    "MaduleID" => null, 
                    "SubBoxHeight" => null, 
                    "BoxCountPerRow" => 1, 
                    "FormID" => null, 
                    "FormReportID" => null, 
                    "BoxGroupID" => 7, 
                    "BoxGroupName" => "singleImage", 
                    "BoxPersianName" => "ØªØµÙˆÛŒØ±", 
                    "Pagination" => 2, 
                    "SortType" => 1, 
                    "Content" => null, 
                    "MediaID" => null, 
                    "HasProductTabs" => null, 
                    "ProductSlides" => null, 
                    "RowIDList" => null, 
                    "BoxStyle" => "paralax", 
                    "PopupStyle" => false, 
                    "BoxTemp" => null, 
                    "ShowMoreLink" => null, 
                    "ContainerTabs" => null, 
                    "WebsiteDisplay" => true, 
                    "MobileDisplay" => true, 
                    "Background" => null, 
                    "ParallaxStyle" => null, 
                    "DisableBoxBack" => null, 
                    "BackTitleColor" => null, 
                    "DisableBoxBackgroundColor" => null, 
                    "BoxBackgroundColor" => null, 
                    "BlurEffectBack" => null, 
                    "BlackEffectBack" => null, 
                    "ButtonList" => [
                    ], 
                    "Platform7Maduleid" => null, 
                    "GroupMaduleBox" => null, 
                    "IsAmazzingoffer" => false 
                ]
            ],
            [
                [
                    "BoxID" => 39184, 
                    "Content" => [
                        "foreignTableFields" => [
                        ], 
                        "shahrs" => "<option>Ø§Ù†ØªØ®Ø§Ø¨ Ø§Ø³ØªØ§Ù†</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ</option><option value='Ø§Ø±Ø¯Ø¨ÙŠÙ„'>Ø§Ø±Ø¯Ø¨ÙŠÙ„</option><option value='Ø§ØµÙÙ‡Ø§Ù†'>Ø§ØµÙÙ‡Ø§Ù†</option><option value='Ø§Ù„Ø¨Ø±Ø²'>Ø§Ù„Ø¨Ø±Ø²</option><option value='Ø§ÙŠÙ„Ø§Ù…'>Ø§ÙŠÙ„Ø§Ù…</option><option value='Ø¨ÙˆØ´Ù‡Ø±'>Ø¨ÙˆØ´Ù‡Ø±</option><option value='ØªÙ‡Ø±Ø§Ù†'>ØªÙ‡Ø±Ø§Ù†</option><option value='Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ'>Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ</option><option value='Ø®ÙˆØ²Ø³ØªØ§Ù†'>Ø®ÙˆØ²Ø³ØªØ§Ù†</option><option value='Ø²Ù†Ø¬Ø§Ù†'>Ø²Ù†Ø¬Ø§Ù†</option><option value='Ø³Ù…Ù†Ø§Ù†'>Ø³Ù…Ù†Ø§Ù†</option><option value='Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†'>Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†</option><option value='ÙØ§Ø±Ø³'>ÙØ§Ø±Ø³</option><option value='Ù‚Ø²ÙˆÙŠÙ†'>Ù‚Ø²ÙˆÙŠÙ†</option><option value='Ù‚Ù…'>Ù‚Ù…</option><option value='ÙƒØ±Ø¯Ø³ØªØ§Ù†'>ÙƒØ±Ø¯Ø³ØªØ§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†'>ÙƒØ±Ù…Ø§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡'>ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡</option><option value='ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯'>ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯</option><option value='Ú¯Ù„Ø³ØªØ§Ù†'>Ú¯Ù„Ø³ØªØ§Ù†</option><option value='Ú¯ÙŠÙ„Ø§Ù†'>Ú¯ÙŠÙ„Ø§Ù†</option><option value='Ù„Ø±Ø³ØªØ§Ù†'>Ù„Ø±Ø³ØªØ§Ù†</option><option value='Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†'>Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†</option><option value='Ù…Ø±ÙƒØ²ÙŠ'>Ù…Ø±ÙƒØ²ÙŠ</option><option value='Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†'>Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†</option><option value='Ù‡Ù…Ø¯Ø§Ù†'>Ù‡Ù…Ø¯Ø§Ù†</option><option value='ÙŠØ²Ø¯'>ÙŠØ²Ø¯</option>", 
                        "formDynamicOptionDataList" => [
                        ],
                        "formBiulderData" => json_encode($this->get_fields('advice')),
                        "CaptchaLength" => null, 
                        "FormName" => "نظرسنجی", 
                        "IsEditable" => false, 
                        "RegistrationRequired" => false, 
                        "ISClubMember" => false, 
                        "Multiplerowperuser" => false, 
                        "IsOnlinePayment" => false, 
                        "IsOnlineOrder" => false, 
                        "BottonText" => "ثبت نهایی", 
                        "formDataList" => null, 
                        "editedLogID" => null, 
                        "editedTrackingCode" => "-1", 
                        "isAuthenticated" => false, 
                        "userGroupDiscount" => 0, 
                        "totalPrice" => 0 
                    ] 
                ], 
                [
                    "BoxID" => 39407, 
                    "Content" => [
                        "boxTitle" => "", 
                        "boxDescription" => null, 
                        "MediaID" => 25644 
                    ]
                ]
            ]
        ];

    }

    public function render_contact() {
        return [
            [
                [
                    "BoxID" => 39404,
                    "MenuID" => 29267,
                    "BoxTitle" => "تماس با ما",
                    "BoxDescription" => "Contact Us",
                    "Priority" => 1,
                    "Width" => null,
                    "Height" => 180,
                    "BoxCount" => 20,
                    "MaduleID" => null,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 2,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 1,
                    "BoxGroupName" => "tabs",
                    "BoxPersianName" => "ØªØ¨ Ù‡Ø§ÛŒ Ù…ÛŒØ§Ù†Ø¨Ø±",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => "contactus",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "Background" => null,
                    "ParallaxStyle" => null,
                    "DisableBoxBack" => null,
                    "BackTitleColor" => null,
                    "DisableBoxBackgroundColor" => null,
                    "BoxBackgroundColor" => null,
                    "BlurEffectBack" => null,
                    "BlackEffectBack" => null,
                    "ButtonList" => [],
                    "Platform7Maduleid" => null,
                    "GroupMaduleBox" => null,
                    "IsAmazzingoffer" => false
                ],
                [
                    "BoxID" => 39403,
                    "MenuID" => 29267,
                    "BoxTitle" => "تهران، خیابان آذرشهر",
                    "BoxDescription" => "+ 98 21  26700812, + 98 21 26700814",
                    "Priority" => 2,
                    "Width" => null,
                    "Height" => 250,
                    "BoxCount" => 1,
                    "MaduleID" => null,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 7,
                    "BoxGroupName" => "singleImage",
                    "BoxPersianName" => "ØªØµÙˆÛŒØ±",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => "paralax",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "Background" => null,
                    "ParallaxStyle" => null,
                    "DisableBoxBack" => null,
                    "BackTitleColor" => null,
                    "DisableBoxBackgroundColor" => null,
                    "BoxBackgroundColor" => null,
                    "BlurEffectBack" => null,
                    "BlackEffectBack" => null,
                    "ButtonList" => [
                        [
                            "Text" => "مشاهده اطلاعات تماس",
                            "LinkUrl" => "footer",
                            "MenuID" => null,
                            "TempName" => null,
                            "IsProfileMenu" => false
                        ]
                    ],
                    "Platform7Maduleid" => null,
                    "GroupMaduleBox" => null,
                    "IsAmazzingoffer" => false
                ],
                [
                    "BoxID" => 39189,
                    "MenuID" => 29267,
                    "BoxTitle" => "تماس با مدیریت",
                    "BoxDescription" => null,
                    "Priority" => 3,
                    "Width" => null,
                    "Height" => null,
                    "BoxCount" => 1,
                    "MaduleID" => null,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => 8420,
                    "FormReportID" => null,
                    "BoxGroupID" => 6,
                    "BoxGroupName" => "form",
                    "BoxPersianName" => "ÙØ±Ù… ÙˆØ±ÙˆØ¯ Ø§Ø·Ù„Ø§Ø¹Ø§Øª",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => "",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "Background" => null,
                    "ParallaxStyle" => null,
                    "DisableBoxBack" => null,
                    "BackTitleColor" => null,
                    "DisableBoxBackgroundColor" => null,
                    "BoxBackgroundColor" => null,
                    "BlurEffectBack" => null,
                    "BlackEffectBack" => null,
                    "ButtonList" => [],
                    "Platform7Maduleid" => null,
                    "GroupMaduleBox" => null,
                    "IsAmazzingoffer" => false
                ]
            ],
            [
                [
                    "BoxID" => 39404,
                    "Content" => [
                        "TabRepository" => [
                            [
                                "TabID" => 6222,
                                "BoxID" => 39404,
                                "LinkUrl" => "",
                                "TempName" => null,
                                "MenuID" => null,
                                "Title" => "مرکز مشاوره هیواد",
                                "Titr" => "مرکز مشاوره هیواد (مرکز خدمات روانشناسی و مشاوره) در محله سید خندان تهران و بزرگراه شهید همت، بروجردی، بین میلان و سراب واقع شده است. این مرکز یکی از چهار مرکز خدمات روانشناسی و مشاوره در محله سید خندان تهران می‌باشد ",
                                "Picture" => "1b0faf68-ea23-4607-a7a0-5a570e8e63e7",
                                "Priority" => 0,
                                "Icon" => null,
                                "BaseWebsiteID" => null
                            ]
                        ],
                        "boxCount" => 20,
                        "PopupStyle" => false,
                        "boxTitle" => "باکس تایتل",
                        "BoxCountPerRow" => 1
                    ]
                ],
                [
                    "BoxID" => 39403,
                    "Content" => [
                        "boxTitle" => "تهران، خیابان آذرشهر",
                        "boxDescription" => "+ 98 21  26700812, + 98 21 26700814",
                        "MediaID" => 25644
                    ]
                ],
                [
                    "BoxID" => 39189,
                    "Content" => [
                        "foreignTableFields" => [],
                        "shahrs" => "<option>Ø§Ù†ØªØ®Ø§Ø¨ Ø§Ø³ØªØ§Ù†</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† Ø´Ø±Ù‚ÙŠ</option><option value='Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ'>Ø¢Ø°Ø±Ø¨Ø§ÙŠØ¬Ø§Ù† ØºØ±Ø¨ÙŠ</option><option value='Ø§Ø±Ø¯Ø¨ÙŠÙ„'>Ø§Ø±Ø¯Ø¨ÙŠÙ„</option><option value='Ø§ØµÙÙ‡Ø§Ù†'>Ø§ØµÙÙ‡Ø§Ù†</option><option value='Ø§Ù„Ø¨Ø±Ø²'>Ø§Ù„Ø¨Ø±Ø²</option><option value='Ø§ÙŠÙ„Ø§Ù…'>Ø§ÙŠÙ„Ø§Ù…</option><option value='Ø¨ÙˆØ´Ù‡Ø±'>Ø¨ÙˆØ´Ù‡Ø±</option><option value='ØªÙ‡Ø±Ø§Ù†'>ØªÙ‡Ø±Ø§Ù†</option><option value='Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ'>Ú†Ù‡Ø§Ø±Ù…Ø­Ø§Ù„ ÙˆØ¨Ø®ØªÙŠØ§Ø±ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø¬Ù†ÙˆØ¨ÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø±Ø¶ÙˆÙŠ</option><option value='Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ'>Ø®Ø±Ø§Ø³Ø§Ù† Ø´Ù…Ø§Ù„ÙŠ</option><option value='Ø®ÙˆØ²Ø³ØªØ§Ù†'>Ø®ÙˆØ²Ø³ØªØ§Ù†</option><option value='Ø²Ù†Ø¬Ø§Ù†'>Ø²Ù†Ø¬Ø§Ù†</option><option value='Ø³Ù…Ù†Ø§Ù†'>Ø³Ù…Ù†Ø§Ù†</option><option value='Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†'>Ø³ÙŠØ³ØªØ§Ù† ÙˆØ¨Ù„ÙˆÚ†Ø³ØªØ§Ù†</option><option value='ÙØ§Ø±Ø³'>ÙØ§Ø±Ø³</option><option value='Ù‚Ø²ÙˆÙŠÙ†'>Ù‚Ø²ÙˆÙŠÙ†</option><option value='Ù‚Ù…'>Ù‚Ù…</option><option value='ÙƒØ±Ø¯Ø³ØªØ§Ù†'>ÙƒØ±Ø¯Ø³ØªØ§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†'>ÙƒØ±Ù…Ø§Ù†</option><option value='ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡'>ÙƒØ±Ù…Ø§Ù†Ø´Ø§Ù‡</option><option value='ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯'>ÙƒÙ‡Ú¯ÙŠÙ„ÙˆÙŠÙ‡ ÙˆØ¨ÙˆÙŠØ±Ø§Ø­Ù…Ø¯</option><option value='Ú¯Ù„Ø³ØªØ§Ù†'>Ú¯Ù„Ø³ØªØ§Ù†</option><option value='Ú¯ÙŠÙ„Ø§Ù†'>Ú¯ÙŠÙ„Ø§Ù†</option><option value='Ù„Ø±Ø³ØªØ§Ù†'>Ù„Ø±Ø³ØªØ§Ù†</option><option value='Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†'>Ù…Ø§Ø²Ù†Ø¯Ø±Ø§Ù†</option><option value='Ù…Ø±ÙƒØ²ÙŠ'>Ù…Ø±ÙƒØ²ÙŠ</option><option value='Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†'>Ù‡Ø±Ù…Ø²Ú¯Ø§Ù†</option><option value='Ù‡Ù…Ø¯Ø§Ù†'>Ù‡Ù…Ø¯Ø§Ù†</option><option value='ÙŠØ²Ø¯'>ÙŠØ²Ø¯</option>",
                        "formDynamicOptionDataList" => [],
                        "formBiulderData" => "{\"fields\":[{\"label\":\"نام و نام خانوادگی\",\"field_type\":\"text\",\"required\":true,\"isPhonNumber\":null,\"IsNationalCode\":null,\"IsPrimaryKey\":null,\"display\":true,\"displayInAdmin\":null,\"notEditable\":null,\"IsUnique\":null,\"FieldScore\":null,\"field_options\":{\"size\":\"small\",\"description\":null,\"minlength\":null,\"maxlength\":null,\"MinSelect\":null,\"MaxSelect\":null,\"min\":null,\"max\":null,\"AnniversaryScore\":0,\"HappyAnniversary\":null,\"HappyAnniversaryText\":null,\"min_max_length_units\":null,\"include_blank_option\":null,\"TableID\":null,\"ImgHeight\":null,\"ImageWidth\":null,\"ImgHeight2\":null,\"ImageWidth2\":null,\"AcceptMimeType\":null,\"FileMinCount\":null,\"Formula\":null,\"Filters\":null,\"ColSelected\":null,\"IsBoxCode\":null,\"IsUniqueMessage\":null,\"ParrentFieldCID\":null,\"ClassName\":null,\"RequiredMessage\":null,\"FormDynamicOptionGroupID\":null,\"options\":null},\"cid\":\"name\",\"FormID\":null,\"foreignTableFields\":null},{\"label\":\"تلفن همراه\",\"field_type\":\"number\",\"required\":true,\"isPhonNumber\":true,\"IsNationalCode\":null,\"IsPrimaryKey\":null,\"display\":true,\"displayInAdmin\":null,\"notEditable\":null,\"IsUnique\":null,\"FieldScore\":null,\"field_options\":{\"size\":null,\"description\":\"\",\"minlength\":null,\"maxlength\":null,\"MinSelect\":null,\"MaxSelect\":null,\"min\":null,\"max\":null,\"AnniversaryScore\":0,\"HappyAnniversary\":null,\"HappyAnniversaryText\":null,\"min_max_length_units\":null,\"include_blank_option\":null,\"TableID\":null,\"ImgHeight\":null,\"ImageWidth\":null,\"ImgHeight2\":null,\"ImageWidth2\":null,\"AcceptMimeType\":null,\"FileMinCount\":null,\"Formula\":null,\"Filters\":null,\"ColSelected\":null,\"IsBoxCode\":null,\"IsUniqueMessage\":null,\"ParrentFieldCID\":null,\"ClassName\":null,\"RequiredMessage\":null,\"FormDynamicOptionGroupID\":null,\"options\":null},\"cid\":\"phone\",\"FormID\":null,\"foreignTableFields\":null},{\"label\":\"آدرس الکترونیک\",\"field_type\":\"email\",\"required\":false,\"isPhonNumber\":null,\"IsNationalCode\":null,\"IsPrimaryKey\":null,\"display\":true,\"displayInAdmin\":false,\"notEditable\":null,\"IsUnique\":null,\"FieldScore\":null,\"field_options\":{\"size\":null,\"description\":null,\"minlength\":null,\"maxlength\":null,\"MinSelect\":null,\"MaxSelect\":null,\"min\":null,\"max\":null,\"AnniversaryScore\":0,\"HappyAnniversary\":null,\"HappyAnniversaryText\":null,\"min_max_length_units\":null,\"include_blank_option\":null,\"TableID\":null,\"ImgHeight\":null,\"ImageWidth\":null,\"ImgHeight2\":null,\"ImageWidth2\":null,\"AcceptMimeType\":null,\"FileMinCount\":null,\"Formula\":null,\"Filters\":null,\"ColSelected\":null,\"IsBoxCode\":null,\"IsUniqueMessage\":null,\"ParrentFieldCID\":null,\"ClassName\":null,\"RequiredMessage\":null,\"FormDynamicOptionGroupID\":null,\"options\":null},\"cid\":\"mail\",\"FormID\":null,\"foreignTableFields\":null},{\"label\":\"موضوع پیام\",\"field_type\":\"text\",\"required\":true,\"isPhonNumber\":null,\"IsNationalCode\":null,\"IsPrimaryKey\":null,\"display\":true,\"displayInAdmin\":null,\"notEditable\":null,\"IsUnique\":null,\"FieldScore\":null,\"field_options\":{\"size\":\"small\",\"description\":null,\"minlength\":null,\"maxlength\":null,\"MinSelect\":null,\"MaxSelect\":null,\"min\":null,\"max\":null,\"AnniversaryScore\":0,\"HappyAnniversary\":null,\"HappyAnniversaryText\":null,\"min_max_length_units\":null,\"include_blank_option\":null,\"TableID\":null,\"ImgHeight\":null,\"ImageWidth\":null,\"ImgHeight2\":null,\"ImageWidth2\":null,\"AcceptMimeType\":null,\"FileMinCount\":null,\"Formula\":null,\"Filters\":null,\"ColSelected\":null,\"IsBoxCode\":null,\"IsUniqueMessage\":null,\"ParrentFieldCID\":null,\"ClassName\":null,\"RequiredMessage\":null,\"FormDynamicOptionGroupID\":null,\"options\":null},\"cid\":\"title\",\"FormID\":null,\"foreignTableFields\":null},{\"label\":\"متن پیام\",\"field_type\":\"textarea\",\"required\":true,\"isPhonNumber\":null,\"IsNationalCode\":null,\"IsPrimaryKey\":null,\"display\":true,\"displayInAdmin\":null,\"notEditable\":null,\"IsUnique\":null,\"FieldScore\":null,\"field_options\":{\"size\":\"small\",\"description\":null,\"minlength\":null,\"maxlength\":null,\"MinSelect\":null,\"MaxSelect\":null,\"min\":null,\"max\":null,\"AnniversaryScore\":0,\"HappyAnniversary\":null,\"HappyAnniversaryText\":null,\"min_max_length_units\":null,\"include_blank_option\":null,\"TableID\":null,\"ImgHeight\":null,\"ImageWidth\":null,\"ImgHeight2\":null,\"ImageWidth2\":null,\"AcceptMimeType\":null,\"FileMinCount\":null,\"Formula\":null,\"Filters\":null,\"ColSelected\":null,\"IsBoxCode\":null,\"IsUniqueMessage\":null,\"ParrentFieldCID\":null,\"ClassName\":null,\"RequiredMessage\":null,\"FormDynamicOptionGroupID\":null,\"options\":null},\"cid\":\"msg\",\"FormID\":null,\"foreignTableFields\":null}]}",
                        "CaptchaLength" => null,
                        "FormName" => "تماس با ما",
                        "IsEditable" => false,
                        "RegistrationRequired" => false,
                        "ISClubMember" => false,
                        "Multiplerowperuser" => false,
                        "IsOnlinePayment" => false,
                        "IsOnlineOrder" => false,
                        "BottonText" => "ایجاد پیام",
                        "formDataList" => null,
                        "editedLogID" => null,
                        "editedTrackingCode" => "-1",
                        "isAuthenticated" => false,
                        "userGroupDiscount" => 0,
                        "totalPrice" => 0
                    ]
                ]
            ]
        ];
    }

    public function render_sliders()
    {
        return [
            [
                "BoxID" => 38886,
                "MenuID" => -1,
                "BoxTitle" => "صفحه اصلی",
                "BoxDescription" => null,
                "Priority" => 1,
                "Width" => null,
                "Height" => 250,
                "BoxCount" => 1,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 1,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 2,
                "BoxGroupName" => "slideshow",
                "BoxPersianName" => "اسلایدر",
                "Pagination" => 1,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => ",10118",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "DisableBoxBackgroundColor" => null,
                "BoxBackgroundColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38886,
                "Content" => [
                    "SlideList" => $this->get_sliders(),
                    "PopupStyle" => false
                ]
            ],
        ];
    }

    public function render_galleries($galleries = null)
    {
        return [
            [
                "BoxID" => 38865,
                "MenuID" => -1,
                "BoxTitle" => "گالری",
                "BoxDescription" => null,
                "Priority" => 2,
                "Width" => null,
                "Height" => 180,
                "BoxCount" => 9,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 3,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 1,
                "BoxGroupName" => "tabs",
                "BoxPersianName" => "تب ها",
                "Pagination" => 2,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => null,
                "BoxStyle" => "services",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "DisableBoxBackgroundColor" => null,
                "BoxBackgroundColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38865,
                "Content" => [
                    "TabRepository" => $galleries == null ? $this->get_galleries() : $galleries,
                    "boxCount" => 9,
                    "PopupStyle" => false,
                    "boxTitle" => "باکس تایتل 2",
                    "BoxCountPerRow" => 3
                ]
            ],
        ];
    }
    
    public function render_videos()
    {
        

        // return [
        //     [
        //         "BoxID" => 38865,
        //         "MenuID" => -1,
        //         "BoxTitle" => "آخرین ویدیوها",
        //         "BoxDescription" => null,
        //         "Priority" => 2,
        //         "Width" => null,
        //         "Height" => 180,
        //         "BoxCount" => 9,
        //         "MaduleID" => null,
        //         "SubBoxHeight" => null,
        //         "BoxCountPerRow" => 3,
        //         "FormID" => null,
        //         "FormReportID" => null,
        //         "BoxGroupID" => 1,
        //         "BoxGroupName" => "tabs",
        //         "BoxPersianName" => "تب ها",
        //         "Pagination" => 2,
        //         "SortType" => 1,
        //         "Content" => null,
        //         "MediaID" => null,
        //         "HasProductTabs" => null,
        //         "ProductSlides" => null,
        //         "RowIDList" => null,
        //         "BoxStyle" => "services",
        //         "PopupStyle" => false,
        //         "BoxTemp" => null,
        //         "ShowMoreLink" => null,
        //         "ContainerTabs" => null,
        //         "WebsiteDisplay" => true,
        //         "MobileDisplay" => true,
        //         "Background" => null,
        //         "ParallaxStyle" => null,
        //         "DisableBoxBack" => null,
        //         "BackTitleColor" => null,
        //         "DisableBoxBackgroundColor" => null,
        //         "BoxBackgroundColor" => null,
        //         "BlurEffectBack" => null,
        //         "BlackEffectBack" => null,
        //         "ButtonList" => [],
        //         "Platform7Maduleid" => null,
        //         "GroupMaduleBox" => null,
        //         "IsAmazzingoffer" => false
        //     ],
        //     [
        //         "BoxID" => 38865,
        //         "Content" => [
        //             "TabRepository" => $this->get_videos(),
        //             "boxCount" => 9,
        //             "PopupStyle" => false,
        //             "boxTitle" => "باکس تایتل 2",
        //             "BoxCountPerRow" => 3
        //         ]
        //     ],
        // ];
    }

    public function render_news()
    {
        return [
            [
                "BoxDescription" => "",
                "BoxGroupName" => "news",
                "BoxID" =>  38931,
                "BoxPersianName" => "اخبار",
                "BoxStyle" => "",
                "BoxTemp" =>  null,
                "BoxTitle" => "آخرین اخبار",
                "ButtonList" =>  [],
                "MenuID" =>  29270,
                "MobileDisplay" =>  true,
                "PopupStyle" =>  false,
                "SortType" =>  1,
                "WebsiteDisplay" =>  true,
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "Pagination" => 2,
                    "ShowMoreLink" => null,
                    "model" => [
                        "News" => $this->get_news(),
                        "PopupStyle" => false
                    ]
                ]
            ],
        ];
    }

    
    public function render_articles()
    {
        return [
            [
                "BoxDescription" => "",
                "BoxGroupName" => "articles",
                "BoxID" =>  38931,
                "BoxPersianName" => "مقالات",
                "BoxStyle" => "",
                "BoxTemp" =>  null,
                "BoxTitle" => "آخرین مقالات",
                "ButtonList" =>  [],
                "MenuID" =>  29270,
                "MobileDisplay" =>  true,
                "PopupStyle" =>  false,
                "SortType" =>  1,
                "WebsiteDisplay" =>  true,
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "Pagination" => 2,
                    "ShowMoreLink" => route('articles.show'),
                    "model" => [
                        "News" => $this->get_articles(),
                        "PopupStyle" => false
                    ]
                ]
            ],
        ];
    }

    public function render_introduce()
    {

        $about = Config::first()->about;

        return [
            [
                [
                    "BoxCount" => 1,
                    "BoxCountPerRow" => 1,
                    "BoxDescription" => null,
                    "BoxGroupID" => 11,
                    "BoxGroupName" => "ContainerTabs",
                    "BoxID" => 39679,
                    "BoxPersianName" => "معرفی مجموعه",
                    "BoxStyle" => "tabServices",
                    "BoxTemp" => null,
                    "BoxTitle" => "معرفی مجموعه",
                    "ButtonList" => [],
                    "ContainerTabs" => [
                        ["TabID" => 1774, "Title" => "...", "BoxIDList" => "39680.39681.", "Picture" => null]
                    ],
                    "Content" => null,
                    "FormID" => null,
                    "FormReportID" => null,
                    "HasProductTabs" => null,
                    "Height" => 380,
                    "MaduleID" => null,
                    "MediaID" => null,
                    "MenuID" => 29821,
                    "MobileDisplay" => true,
                    "Pagination" => 2,
                    "PopupStyle" => false,
                    "Priority" => 1,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "ShowMoreLink" => null,
                    "SortType" => 1,
                    "SubBoxHeight" => null,
                    "WebsiteDisplay" => true,
                    "Width" => null,
                ],
                [
                    "BoxCount" => 1,
                    "BoxCountPerRow" => 1,
                    "BoxDescription" => null,
                    "BoxGroupID" => 5,
                    "BoxGroupName" => "content",
                    "BoxID" => 39680,
                    "BoxPersianName" => "معرفی مجموعه",
                    "BoxStyle" => "",
                    "BoxTemp" => null,
                    "BoxTitle" => "درباره ما",
                    "ButtonList" => [],
                    "ContainerTabs" => null,
                    "Content" => null,
                    "FormID" => null,
                    "FormReportID" => null,
                    "HasProductTabs" => null,
                    "Height" => 122,
                    "MaduleID" => null,
                    "MediaID" => null,
                    "MenuID" => 29821,
                    "MobileDisplay" => true,
                    "Pagination" => 2,
                    "PopupStyle" => false,
                    "Priority" => 2,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "ShowMoreLink" => null,
                    "SortType" => 1,
                    "SubBoxHeight" => null,
                    "WebsiteDisplay" => true,
                    "Width" => 50,
                ],
                [
                    "BoxID" => 39681,
                    "MenuID" => 29821,
                    "BoxTitle" => "About Ajodanie",
                    "BoxDescription" => null,
                    "Priority" => 3,
                    "Width" => 49,
                    "Height" => 252,
                    "BoxCount" => 1,
                    "MaduleID" => null,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 2,
                    "BoxGroupName" => "slideshow",
                    "BoxPersianName" => "معرفی مجموعه",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => "10218",
                    "BoxStyle" => "",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ],
            ],
            [
                [
                    "BoxID" => 39679,
                    "Content" => null
                ],
                [
                    "BoxID" => 39680,
                    "Content" => "<div><p>" . $about . "</p></div>",
                ],
                [
                    "BoxID" => 39681,
                    "Content" => [
                        "SlideList" => $this->get_introduce(),
                        "PopupStyle" => false
                    ]
                ],
            ]
        ];
    }

    public function render_total_news()
    {
        return [
            [
                "BoxID" => 38931,
                "MenuID" => 29270,
                "BoxTitle" => "آخرین اخبار",
                "BoxDescription" => "",
                "Priority" => 1,
                "Width" => null,
                "Height" => null,
                "BoxCount" => 20,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 20,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 4,
                "BoxGroupName" => "news",
                "BoxPersianName" => "اخبار، مقالات و ...",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => "783",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "model" => [
                        "News" => $this->get_all_news(),
                        "PopupStyle" => false,
                    ],
                    "boxID" => 38931,
                    "newsCount" => 9,
                    "top" => 20,
                    "Pagination" => 3,
                    "ShowMoreLink" => null,
                    "paginationData" => "[\"step\" =>1,\"top\" =>20,\"paginationCount\" =>8,\"advCount\" =>9,\"GridTableInfo\" =>null,\"ElementList\" =>null,\"HasFilter\" =>false]",
                    "skip" => 0
                ],
            ],
        ];
    }

    public function render_my_products_json_file(Request $request)
    {
        return [
            [
                "BoxID" => 38931,
                "MenuID" => 29270,
                "BoxTitle" => "محصولات من",
                "BoxDescription" => "",
                "Priority" => 1,
                "Width" => null,
                "Height" => null,
                "BoxCount" => 20,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 20,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 4,
                "BoxGroupName" => "news",
                "BoxPersianName" => "محصولات من",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => "783",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "model" => [
                        "News" => $this->get_my_products($request),
                        "PopupStyle" => false,
                    ],
                    "boxID" => 38931,
                    "newsCount" => 9,
                    "top" => 20,
                    "Pagination" => 3,
                    "ShowMoreLink" => null,
                    "paginationData" => "[\"step\" =>1,\"top\" =>20,\"paginationCount\" =>8,\"advCount\" =>9,\"GridTableInfo\" =>null,\"ElementList\" =>null,\"HasFilter\" =>false]",
                    "skip" => 0
                ],
            ],
        ];
    }
    
    public function render_shop_json_file()
    {
        return [
            [
                "BoxID" => 38931,
                "MenuID" => 29270,
                "BoxTitle" => "محصولات",
                "BoxDescription" => "",
                "Priority" => 1,
                "Width" => null,
                "Height" => null,
                "BoxCount" => 20,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 20,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 4,
                "BoxGroupName" => "news",
                "BoxPersianName" => "اخبار، مقالات و ...",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => "783",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "model" => [
                        "News" => $this->get_all_products(),
                        "PopupStyle" => false,
                    ],
                    "boxID" => 38931,
                    "newsCount" => 9,
                    "top" => 20,
                    "Pagination" => 3,
                    "ShowMoreLink" => null,
                    "paginationData" => "[\"step\" =>1,\"top\" =>20,\"paginationCount\" =>8,\"advCount\" =>9,\"GridTableInfo\" =>null,\"ElementList\" =>null,\"HasFilter\" =>false]",
                    "skip" => 0
                ],
            ],
        ];
    }

    public function render_total_articles($mode="article")
    {
        if($mode == 'article')
            $cats = $this->get_article_categories();
        else
            $cats = $this->get_categories();

        return [
            [
                "BoxID" => 38931,
                "MenuID" => 29270,
                "BoxTitle" => $mode == 'article' ? "مقالات" : 'گالری تصاویر',
                "BoxDescription" => "",
                "Priority" => 1,
                "Width" => null,
                "Height" => null,
                "BoxCount" => 20,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 20,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 4,
                "BoxGroupName" => "news",
                "BoxPersianName" => "مقالات",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => "783",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "model" => [
                        "News" => $cats,
                        "PopupStyle" => false,
                    ],
                    "boxID" => 38931,
                    "newsCount" => 9,
                    "top" => 20,
                    "Pagination" => 3,
                    "ShowMoreLink" => null,
                    "paginationData" => "[\"step\" =>1,\"top\" =>20,\"paginationCount\" =>8,\"advCount\" =>9,\"GridTableInfo\" =>null,\"ElementList\" =>null,\"HasFilter\" =>false]",
                    "skip" => 0
                ],
            ],
        ];
    }

    public function render_about_cafe()
    {
        return
            [
                [
                    [
                    "BoxID" => 39691,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 1,
                    "Width" => null,
                    "Height" => 380,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 11,
                    "BoxGroupName" => "ContainerTabs",
                    "BoxPersianName" => "ØªØ¨ Ù‡Ø§ÛŒ Ø­Ø§ÙˆÛŒ Ø§Ø·Ù„Ø§Ø¹Ø§Øª",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => "tabServices",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => [
                        [
                            "TabID" => 1777,
                            "Title" => "...",
                            "BoxIDList" => "39692.39693.41615.",
                            "Picture" => null
                        ]
                    ],
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ],
                [
                    "BoxID" => 39692,
                    "MenuID" => 29412,
                    "BoxTitle" => "معرفی کافی شاپ",
                    "BoxDescription" => null,
                    "Priority" => 2,
                    "Width" => 50,
                    "Height" => 122,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 5,
                    "BoxGroupName" => "content",
                    "BoxPersianName" => "Ù…Ø­ØªÙˆØ§ÛŒ textÛŒ",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => "",
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ],
                [
                    "BoxID" => 39693,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 3,
                    "Width" => 49,
                    "Height" => 252,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 2,
                    "BoxGroupName" => "slideshow",
                    "BoxPersianName" => "Ø§Ø³Ù„Ø§ÛŒØ¯ Ø´Ùˆ ØªØµØ§ÙˆÛŒØ±",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => "10222",
                    "BoxStyle" => null,
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ]
            ],
            [
                [
                    "BoxID" => 39691,
                    "Content" => null
                ],
                [
                    "BoxID" => 39692,
                    "Content" => '<p style="font-size: 16px">' . Config::first()->cafe . '</p>'
                ],
                [
                    "BoxID" => 39693,
                    "Content" => [
                        "SlideList" => $this->get_cafe_sliders(),
                        "PopupStyle" => false
                    ]
                ]
            ]
        ];
    }
    
    public function render_total_videos()
    {

        return [
            [
                "BoxID" => 38931,
                "MenuID" => 29270,
                "BoxTitle" => "گالری ویدیو",
                "BoxDescription" => "",
                "Priority" => 1,
                "Width" => null,
                "Height" => null,
                "BoxCount" => 20,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 20,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 4,
                "BoxGroupName" => "news",
                "BoxPersianName" => "گالری ویدیو",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => "783",
                "BoxStyle" => "",
                "PopupStyle" => false,
                "BoxTemp" => null,
                "ShowMoreLink" => null,
                "ContainerTabs" => null,
                "WebsiteDisplay" => true,
                "MobileDisplay" => true,
                "Background" => null,
                "ParallaxStyle" => null,
                "DisableBoxBack" => null,
                "BackTitleColor" => null,
                "BlurEffectBack" => null,
                "BlackEffectBack" => null,
                "ButtonList" => [],
                "Platform7Maduleid" => null,
                "GroupMaduleBox" => null,
                "IsAmazzingoffer" => false
            ],
            [
                "BoxID" => 38931,
                "Content" => [
                    "model" => [
                        "News" => $this->get_video_categories(),
                        "PopupStyle" => false,
                    ],
                    "boxID" => 38931,
                    "newsCount" => 9,
                    "top" => 20,
                    "Pagination" => 3,
                    "ShowMoreLink" => null,
                    "paginationData" => "[\"step\" =>1,\"top\" =>20,\"paginationCount\" =>8,\"advCount\" =>9,\"GridTableInfo\" =>null,\"ElementList\" =>null,\"HasFilter\" =>false]",
                    "skip" => 0
                ],
            ],
        ];

        // $cats = $this->get_video_categories();

        // return [
        //     [
        //         "BoxID" => 38888,
        //         "MenuID" => 29271,
        //         "BoxTitle" => "گالری فیلم",
        //         "BoxDescription" => "",
        //         "Priority" => 1,
        //         "Height" => 280,
        //         "BoxCount" => 100,
        //         "MaduleID" => null,
        //         "SubBoxHeight" => null,
        //         "BoxCountPerRow" => 3,
        //         "FormID" => null,
        //         "FormReportID" => null,
        //         "BoxGroupID" => 3,
        //         "BoxGroupName" => "gallery",
        //         "BoxPersianName" => "گالری فیلم",
        //         "Pagination" => 3,
        //         "SortType" => 1,
        //         "Content" => null,
        //         "MediaID" => null,
        //         "HasProductTabs" => null,
        //         "ProductSlides" => null,
        //         "RowIDList" => $cats[1],
        //         "BoxStyle" => "",
        //         "PopupStyle" => false,
        //         "BoxTemp" => null,
        //         "ShowMoreLink" => null,
        //         "ContainerTabs" => null,
        //         "WebsiteDisplay" => true,
        //         "MobileDisplay" => true,
        //         "Background" => null,
        //         "ParallaxStyle" => null,
        //         "DisableBoxBack" => null,
        //         "BackTitleColor" => null,
        //         "DisableBoxBackgroundColor" => null,
        //         "BoxBackgroundColor" => null,
        //         "BlurEffectBack" => null,
        //         "BlackEffectBack" => null,
        //         "ButtonList" => [],
        //         "Platform7Maduleid" => null,
        //         "GroupMaduleBox" => null,
        //         "IsAmazzingoffer" => false
        //     ],
        //     [
        //         "BoxID" => 38888,
        //         "Content" => [
        //             "boxID" => 38888,
        //             "isVideo" => false,
        //             "isFileGallery" => false,
        //             "model" => [
        //                 "GalleryList" => null,
        //                 "AlbumList" => $cats[0],
        //                 "BoxCountPerRow" => 3,
        //                 "SubBoxHeight" => 116,
        //                 "paddingBottom" => 0,
        //                 "boxID" => 38888
        //             ],
        //             "top" => 100,
        //             "Pagination" => 3,
        //             "ShowMoreLink" => null
        //         ]
        //     ],
        // ];
    }

    public function json_file()
    {

        $config = Config::first();

        $slider_section = $this->render_sliders();
        
        $modules = [$slider_section[0]];
        $contents = [$slider_section[1]];

        if($config->show_gallery) {
            $gallery_section = $this->render_galleries();
            array_push($modules, $gallery_section[0]);
            array_push($contents, $gallery_section[1]);
        }
        
        if($config->show_videos) {
            $video_section = $this->render_videos();
            array_push($modules, $video_section[0]);
            array_push($contents, $video_section[1]);
        }
        
        if($config->show_news) {
            $news_section = $this->render_news();
            array_push($modules, $news_section[0]);
            array_push($contents, $news_section[1]);
        }
        
        if($config->show_article) {
            $news_section = $this->render_articles();
            array_push($modules, $news_section[0]);
            array_push($contents, $news_section[1]);
        }

        if($config->show_about) {
            $intro_section = $this->render_introduce();
            array_push($modules, $intro_section[0][0]);
            array_push($modules, $intro_section[0][1]);
            array_push($modules, $intro_section[0][2]);
            
            array_push($contents, $intro_section[1][0]);
            array_push($contents, $intro_section[1][1]);
            array_push($contents, $intro_section[1][2]);
        }

        return ["madules" => $modules, "jsonContentList" => $contents];
    }

    public function news_json_file()
    {
        $news_section = $this->render_total_news();
        return ["madules" => [$news_section[0]], "jsonContentList" => [$news_section[1]]];
    }


    public function shop_json_file()
    {
        $shop_section = $this->render_shop_json_file();
        return ["madules" => [$shop_section[0]], "jsonContentList" => [$shop_section[1]]];
    }

    
    public function my_products_json_file(Request $request)
    {
        $my_products_section = $this->render_my_products_json_file($request);
        return ["madules" => [$my_products_section[0]], "jsonContentList" => [$my_products_section[1]]];
    }


    public function article_json_file()
    {
        $article_section = $this->render_total_articles();
        return ["madules" => [$article_section[0]], "jsonContentList" => [$article_section[1]]];
    }

    public function render_people() {
        return [
            [
                [
                    "BoxID" => 39690,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 5,
                    "Width" => null,
                    "Height" => null,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 15,
                    "BoxGroupName" => "HtmlCode",
                    "BoxPersianName" => "Ú©Ø¯ html",
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => null,
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ]
            ],
            [
                [
                    "BoxID" => 39690,
                    "Content" => "<section data-updatecontent=\"true\" data-formid=\"null\" data-pagination=\"2\" data-href=\"/Home/GetProductGroupManager?boxID=38865&amp;boxCount=9&amp;lazyLoad=true\" data-boxid=\"38865\" data-boxstyle=\"services\" data-popupstyle=\"false\" data-boxcount=\"9\" data-boxtemp=\"null\" data-tmplname=\"tabs\" class=\"resizable ui-state-active animated\" ><h4>افراد متخصص</h4></section>"
                ]
            ]
        ];
    }
    
    public function render_sepc_articles($category) {
        return [
            [
                [
                    "BoxID" => 39690,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 5,
                    "Width" => null,
                    "Height" => null,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 15,
                    "BoxGroupName" => "HtmlCode",
                    "BoxPersianName" => "مقالات " . $category->title,
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => null,
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ]
            ],
            [
                [
                    "BoxID" => 39690,
                    "Content" => "<section data-updatecontent=\"true\" data-formid=\"null\" data-pagination=\"2\" data-href=\"/Home/GetArticleList/" . $category->id . "\" data-boxid=\"38865\" data-boxstyle=\"services\" data-popupstyle=\"false\" data-boxcount=\"9\" data-boxtemp=\"null\" data-tmplname=\"tabs\" class=\"resizable ui-state-active animated\" ><h4> مقالات " . $category->title . "</h4></section>"
                ]
            ]
        ];
    }

    
    public function render_sepc_category($category) {

        return [
            [
                [
                    "BoxID" => 39690,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 5,
                    "Width" => null,
                    "Height" => null,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 15,
                    "BoxGroupName" => "HtmlCode",
                    "BoxPersianName" => "مقالات " . $category->title,
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => null,
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ]
            ],
            [
                [
                    "BoxID" => 39690,
                    "Content" => "<section data-updatecontent=\"true\" data-formid=\"null\" data-pagination=\"2\" data-href=\"/Home/GetGalleryList/" . $category->id . "\" data-boxid=\"38865\" data-boxstyle=\"services\" data-popupstyle=\"false\" data-boxcount=\"9\" data-boxtemp=\"null\" data-tmplname=\"tabs\" class=\"resizable ui-state-active animated\" ><h4> مقالات " . $category->title . "</h4></section>"
                ]
            ]
        ];
    }

    
    public function render_sepc_video_category($category) {

        return [
            [
                [
                    "BoxID" => 39690,
                    "MenuID" => 29412,
                    "BoxTitle" => "",
                    "BoxDescription" => null,
                    "Priority" => 5,
                    "Width" => null,
                    "Height" => null,
                    "BoxCount" => 1,
                    "SubBoxHeight" => null,
                    "BoxCountPerRow" => 1,
                    "FormID" => null,
                    "FormReportID" => null,
                    "BoxGroupID" => 15,
                    "BoxGroupName" => "HtmlCode",
                    "BoxPersianName" => "ویدیوهای " . $category->title,
                    "Pagination" => 2,
                    "SortType" => 1,
                    "Content" => null,
                    "MediaID" => null,
                    "HasProductTabs" => null,
                    "ProductSlides" => null,
                    "RowIDList" => null,
                    "BoxStyle" => null,
                    "PopupStyle" => false,
                    "BoxTemp" => null,
                    "ShowMoreLink" => null,
                    "ContainerTabs" => null,
                    "WebsiteDisplay" => true,
                    "MobileDisplay" => true,
                    "ButtonList" => []
                ]
            ],
            [
                [
                    "BoxID" => 39690,
                    "Content" => "<section data-updatecontent=\"true\" data-formid=\"null\" data-pagination=\"2\" data-href=\"/Home/GetGalleryList/" . $category->id . "?isVideo=1\" data-boxid=\"38865\" data-boxstyle=\"services\" data-popupstyle=\"false\" data-boxcount=\"9\" data-boxtemp=\"null\" data-tmplname=\"tabs\" class=\"resizable ui-state-active animated\" ><h4> ویدیوهای " . $category->title . "</h4></section>"
                ]
            ]
        ];
    }


    public function galleries_json_file()
    {
        $galleries_section = $this->render_total_articles('gallery');
        return ["madules" => [$galleries_section[0]], "jsonContentList" => [$galleries_section[1]]];
    }
    
    public function videos_json_file()
    {
        $videos_section = $this->render_total_videos();
        return ["madules" => [$videos_section[0]], "jsonContentList" => [$videos_section[1]]];
    }

    public function survey_json_file() {
        $survey_section = $this->render_survey();
        return ["madules" => $survey_section[0], "jsonContentList" => $survey_section[1]];
    }
    
    public function advice_request_json_file() {
        $survey_section = $this->render_advice_request();
        return ["madules" => $survey_section[0], "jsonContentList" => $survey_section[1]];
    }

    public function contact_json_file() {
        $contact_section = $this->render_contact();
        return ["madules" => $contact_section[0], "jsonContentList" => $contact_section[1]];
    }
    
    public function about_cafe_json_file() {
        $cafe_section = $this->render_about_cafe();
        return ["madules" => $cafe_section[0], "jsonContentList" => $cafe_section[1]];
    }
    
    public function people_json_file() {
        $cafe_section = $this->render_people();
        return ["madules" => $cafe_section[0], "jsonContentList" => $cafe_section[1]];
    }
    
    public function spec_articles_json_file($category) {
        $cafe_section = $this->render_sepc_articles($category);
        return ["madules" => $cafe_section[0], "jsonContentList" => $cafe_section[1]];
    }
    
    public function spec_category_json_file($category) {
        $cafe_section = $this->render_sepc_category($category);
        return ["madules" => $cafe_section[0], "jsonContentList" => $cafe_section[1]];
    }
    
    public function spec_video_category_json_file($category) {
        $cafe_section = $this->render_sepc_video_category($category);
        return ["madules" => $cafe_section[0], "jsonContentList" => $cafe_section[1]];
    }

}
