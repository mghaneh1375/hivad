<?php

namespace App\Http\Controllers;

use App\Http\Resources\GalleryJSON;
use App\Http\Resources\IntroduceJSON;
use App\Http\Resources\NewsJSON;
use App\Http\Resources\SliderBarJSON;
use App\Http\Resources\CategoryJSON;
use App\Models\Config;
use App\models\Gallery;
use App\Models\Introduce;
use App\Models\Category;
use App\models\News;
use App\models\SlideBar;

class RenderController extends Controller
{


    public function get_sliders()
    {
        return SliderBarJSON::collection(SlideBar::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_galleries()
    {
        return GalleryJSON::collection(Gallery::imp()->orderBy('priority', 'asc')->get());
    }

    public function get_news()
    {
        return NewsJSON::collection(News::imp()->orderBy('priority', 'asc')->take(8)->get());
    }

    public function get_all_news()
    {
        return NewsJSON::collection(News::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_introduce()
    {
        return IntroduceJSON::collection(Introduce::visible()->orderBy('priority', 'asc')->get());
    }

    public function get_categories()
    {
        $cats = Category::visible()->orderBy('priority', 'asc')->get();
        $ids = "";
        foreach ($cats as $cat) {
            $ids .= "," . $cat->id;
        }

        return [CategoryJSON::collection($cats), $ids];
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

    public function render_total_galleries()
    {

        $cats = $this->get_categories();

        return [
            [
                "BoxID" => 38888,
                "MenuID" => 29271,
                "BoxTitle" => "گالری تصاویر",
                "BoxDescription" => "",
                "Priority" => 1,
                "Height" => 280,
                "BoxCount" => 100,
                "MaduleID" => null,
                "SubBoxHeight" => null,
                "BoxCountPerRow" => 3,
                "FormID" => null,
                "FormReportID" => null,
                "BoxGroupID" => 3,
                "BoxGroupName" => "gallery",
                "BoxPersianName" => "گالری تصاویر",
                "Pagination" => 3,
                "SortType" => 1,
                "Content" => null,
                "MediaID" => null,
                "HasProductTabs" => null,
                "ProductSlides" => null,
                "RowIDList" => $cats[1],
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
                "BoxID" => 38888,
                "Content" => [
                    "boxID" => 38888,
                    "isVideo" => false,
                    "isFileGallery" => false,
                    "model" => [
                        "GalleryList" => null,
                        "AlbumList" => $cats[0],
                        "BoxCountPerRow" => 3,
                        "SubBoxHeight" => 116,
                        "paddingBottom" => 0,
                        "boxID" => 38888
                    ],
                    "top" => 100,
                    "Pagination" => 3,
                    "ShowMoreLink" => null
                ]
            ],
        ];
    }

    public function json_file()
    {

        $slider_section = $this->render_sliders();
        $gallery_section = $this->render_galleries();
        $news_section = $this->render_news();
        $intro_section = $this->render_introduce();

        $modules = [$slider_section[0], $gallery_section[0], $news_section[0], $intro_section[0][0], $intro_section[0][1], $intro_section[0][2]];
        $contents = [$slider_section[1], $gallery_section[1], $news_section[1], $intro_section[1][0], $intro_section[1][1], $intro_section[1][2]];

        return ["madules" => $modules, "jsonContentList" => $contents];
    }

    public function news_json_file()
    {
        $news_section = $this->render_total_news();
        return ["madules" => [$news_section[0]], "jsonContentList" => [$news_section[1]]];
    }

    public function galleries_json_file()
    {
        $galleries_section = $this->render_total_galleries();
        return ["madules" => [$galleries_section[0]], "jsonContentList" => [$galleries_section[1]]];
    }
}
