<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Menu;
use App\Models\News;
use App\Models\Category;
use App\Models\CategoryVideo;
use App\Models\Video;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{

    private $news;
    protected $paginate = 5;
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    public function general(Request $request)
    {

        //Menu
        $this->data['menus'] = Menu::where('status', 1)->defaultOrder()->get()->toTree();

        //Setting
        $this->data['website_name'] = setting('website-name');
        $this->data['website_url'] = setting('website-url');
        $this->data['website_address'] = setting('website-address');
        $this->data['facebook_app_id'] = setting('facebook-app-id');
        $this->data['website_phone'] = setting('website-phone');
        $this->data['website_email'] = setting('website-email');
        $this->data['website_about'] = setting('website-about');
        $this->data['logo'] = setting('logo', upload_url('70x70no-thumbnail.png'));
        $this->data['default_thumbnail'] = setting('default-thumbnail', upload_url('70x70no-thumbnail.png'));
        $this->data['favicon'] = setting('favicon', upload_url('70x70no-thumbnail.png'));
        $this->data['home_title'] = setting('home-title');
        $this->data['home_description'] = setting('home-description');
        $this->data['home_keyword'] = setting('home-keyword');

        $this->data['search_title'] = setting('search-title');
        $this->data['search_description'] = setting('search-description');
        $this->data['search_keyword'] = setting('search-keyword');

        $this->data['canonical'] = $request->url();

        $this->data['social_facebook'] = setting('social-facebook');
        $this->data['social_youtube'] = setting('social-youtube');
        $this->data['social_zalo'] = setting('social-zalo');

        //Time
        $timeEng = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $timeVie = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Một', 'Hai', 'Ba', 'Tư', 'Năm', 'Sáu', 'Bảy', 'Tám', 'Chín', 'Mười', 'Mười Một', 'Mười Hai'];
        $time = time();
        $time = date('D, d/m/Y H:i', $time);
        $time = str_replace($timeEng, $timeVie, $time);
        $this->data['time'] = $time;

        return $this->data;
    }

    public function error(Request $request)
    {
        // Seo
        SEOMeta::setTitle(setting('home-title'));
        SEOMeta::setKeywords(setting('home-keyword'));
        SEOMeta::addMeta('news_keywords', $value = setting('home-keyword'), $name = 'name');
        SEOMeta::setDescription(setting('home-description'));
        SEOMeta::setCanonical($request->url());
        SEOMeta::addMeta('author', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('copyright', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('generator', $value = setting('website-name'), $name = 'name');
        SEOMeta::setRobots('noarchive,index,follow');

        OpenGraph::setTitle(setting('home-title'))
            ->setDescription(setting('home-description'))
            ->setUrl($request->url())
            ->setType('article')
            ->addImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->setSiteName(setting('website-name'))
            ->addProperty('locale', 'vi_VN')
            ->setArticle([
                'author' => setting('social-facebook'),
                'publisher' => setting('social-facebook'),
                'tag' => setting('home-keyword'),
                'section' => setting('website-name')
            ]);
        SEOMeta::addMeta('fb:app_id', $value = setting('facebook-app-id'), $name = 'name');

        TwitterCard::setType('summary')
            ->setSite(setting('home-title'))
            ->setTitle(setting('home-title'))
            ->setDescription(setting('home-description'))
            ->setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->addValue('creator', setting('website-name'))
            ->setUrl($request->url());

        JsonLdMulti::setType('Organization');
        JsonLdMulti::setTitle(setting('website-name'));
        JsonLdMulti::setDescription(setting('home-description'));
        JsonLdMulti::addValue('logo', setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setSite(setting('website-name'));
        JsonLdMulti::setUrl(route('index'));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebSite');
            JsonLdMulti::setTitle(setting('home-title'));
            JsonLdMulti::setDescription(setting('home-description'));
            JsonLdMulti::setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')));
            JsonLdMulti::setSite(setting('home-title'));
            JsonLdMulti::setUrl(route('index'));
        }

        return view("errors.404", $this->general($request));
    }

    public function newsToday()
    {
        $news = $this->news;
        $news_today = Cache::remember('news_today_random', 0, function () use ($news) {
            return $news::inRandomOrder()->where('status', 1)->whereDate('created_at', today())->first();
        });
        if ($news_today == null) {

            $news_yesterday = Cache::remember('news_today_random', 0, function () use ($news) {
                return $news::inRandomOrder()->where('status', 1)->whereDate('created_at', date('Y-m-d', strtotime("-1 days")))->first();
            });
            $news_today = $news_yesterday;

            if ($news_yesterday == null) {
                $news_latest = Cache::remember('news_today_random', 0, function () use ($news) {
                    return $news::inRandomOrder()->where('status', 1)->latest('created_at')->first();
                });
                $news_today = $news_latest;
            }
        }

        return $news_today;
    }


    public function index(Request $request)
    {
        // Tin nổi bật
        $this->data['news_hot'] = News::where('hot', 1)->where('status', 1)->take(11)->get();

        // Tin xem nhiều
        $this->data['news_view_more'] = News::orderByUniqueViews()->where('status', 1)->take(11)->get();

        // Danh mục video sắp sếp đầu tiên
        $category_video_top = CategoryVideo::where('status', 1)->defaultOrder()->first();
        $this->data['category_video_top'] = $category_video_top;

        // Video sắp xếp đầu tiên
        $videos = $category_video_top->videos()->get()->where('status', 1);
        $this->data['videos'] = $videos;

        // Tin sự kiện lịch sử
        $this->data['news_event_history'] = News::where('event', 1)->where('status', 1)->take(2)->get();

        // Danh mục sắp xếp đầu tiên
        $category_general = Category::where('status', 1)->defaultOrder()->first();
        $this->data['category_general'] = $category_general;


        // Danh mục con của danh mục sắp xếp đầu tiên
        // $subcategory_general =  $category_general->descendants;
        // $this->data['subcategory_general'] = $subcategory_general;

        $news_today = $this->newsToday();

        // Tin sắp xếp đầu tiên đại diện
        $news_general_first = $category_general->news()->get()
            ->where('id', '!=', $news_today->id)
            ->where('status', 1)->first();
        $this->data['news_general_first'] = $news_general_first;

        // Tin sắp xếp đầu tiên
        $news_general = $category_general->news()->get()
            ->where('id', '!=', $news_today->id)
            ->where('id', '!=', $news_general_first->id)
            ->where('status', 1)->take(2);
        $this->data['news_general'] = $news_general;

        $news_general_slider = $category_general->news()->get()
            ->where('id', '!=', $news_today->id)
            ->where('id', '!=', $news_general_first->id)
            ->whereNotIn('id', $news_general->pluck('id')->toArray())
            ->where('status', 1);

        $this->data['news_general_slider'] = $news_general_slider;

        // Tin hôm nay
        $this->data['news_today'] = $news_today;

        // Seo
        SEOMeta::setTitle(setting('home-title'));
        SEOMeta::setKeywords(setting('home-keyword'));
        SEOMeta::addMeta('news_keywords', $value = setting('home-keyword'), $name = 'name');
        SEOMeta::setDescription(setting('home-description'));
        SEOMeta::setCanonical($request->url());
        SEOMeta::addMeta('author', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('copyright', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('generator', $value = setting('website-name'), $name = 'name');
        SEOMeta::setRobots('noarchive,index,follow');

        OpenGraph::setTitle(setting('home-title'))
            ->setDescription(setting('home-description'))
            ->setUrl($request->url())
            ->setType('article')
            ->addImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->setSiteName(setting('website-name'))
            ->addProperty('locale', 'vi_VN')
            ->setArticle([
                'author' => setting('social-facebook'),
                'publisher' => setting('social-facebook'),
                'tag' => setting('home-keyword'),
                'section' => setting('website-name')
            ]);
        SEOMeta::addMeta('fb:app_id', $value = setting('facebook-app-id'), $name = 'name');

        TwitterCard::setType('summary')
            ->setSite(setting('home-title'))
            ->setTitle(setting('home-title'))
            ->setDescription(setting('home-description'))
            ->setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->addValue('creator', setting('website-name'))
            ->setUrl($request->url());

        JsonLdMulti::setType('Organization');
        JsonLdMulti::setTitle(setting('website-name'));
        JsonLdMulti::setDescription(setting('home-description'));
        JsonLdMulti::addValue('logo', setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setSite(setting('website-name'));
        JsonLdMulti::setUrl(route('index'));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebSite');
            JsonLdMulti::setTitle(setting('home-title'));
            JsonLdMulti::setDescription(setting('home-description'));
            JsonLdMulti::setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')));
            JsonLdMulti::setSite(setting('home-title'));
            JsonLdMulti::setUrl(route('index'));
        }

        return view('pages.index', $this->general($request));
    }

    public function news($slug, $id, Request $request)
    {
        $news = News::where('id', $id)->where('slug', $slug)->where('status', 1)->firstorfail();
        $expiresAt = now()->addHours(3);
        views($news)->cooldown($expiresAt)->record();

        $this->data['news'] = $news;

        $category =  $news->categories()->inRandomOrder()->get()->where('status', 1)->first();
        $this->data['category'] = $category;

        $categories = Category::where('status', 1)->ancestorsAndSelf($category->id);
        $this->data['categories'] = $categories;

        // Tin xem nhiều nhất
        $news_view_more_first = News::orderby('view', 'DESC')
            ->where('status', 1)
            ->where('id', '!=', $id)
            ->first();
        $this->data['news_view_more_first'] = $news_view_more_first;

        // Tin xem nhiều
        $news_view_more = News::orderby('view', 'DESC')
            ->where('status', 1)
            ->where('id', '!=', $id)
            ->where('id', '!=', $news_view_more_first->id)
            ->take(5)->get();
        $this->data['news_view_more'] = $news_view_more;

        // Tin liên quan
        $news_related = $category->news()->get()
            ->where('status', 1)
            ->where('id', '!=', $id)
            ->where('id', '!=', $news_view_more_first->id)
            ->whereNotIn('id', $news_view_more->pluck('id')->toArray())
            ->take(2);
        $this->data['news_related'] = $news_related;

        // Tin liên quan khác
        $news_related_other = $category->news()->get()
            ->where('status', 1)
            ->where('id', '!=', $id)
            ->where('id', '!=', $news_view_more_first->id)
            ->whereNotIn('id', $news_view_more->pluck('id')->toArray())
            ->whereNotIn('id', $news_related->pluck('id')->toArray())
            ->take(6);
        $this->data['news_related_other'] = $news_related_other;

        // Seo
        SEOMeta::setTitle($news->meta_title);
        SEOMeta::setKeywords($news->meta_keyword);
        SEOMeta::addMeta('news_keywords', $value = $news->meta_keyword, $name = 'name');
        SEOMeta::setDescription($news->meta_description);
        SEOMeta::setCanonical($request->url());
        SEOMeta::addMeta('author', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('copyright', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('generator', $value = setting('website-name'), $name = 'name');
        SEOMeta::setRobots('noarchive,index,follow');

        OpenGraph::setTitle($news->meta_title)
            ->setDescription($news->meta_description)
            ->setUrl($request->url())
            ->setType('article')
            ->addImage($news->thumbnail, ['height' => 800, 'width' => 354])
            ->setSiteName(setting('website-name'))
            ->addProperty('locale', 'vi_VN')
            ->setArticle([
                'author' => setting('social-facebook'),
                'publisher' => setting('social-facebook'),
                'tag' => $news->meta_keyword,
                'section' => $category->name,
                'published_time' => $category->created_at,
                'modified_time' => $category->updated_at
            ]);
        SEOMeta::addMeta('fb:app_id', $value = setting('facebook-app-id'), $name = 'name');

        TwitterCard::setType('summary')
            ->setSite($news->meta_title)
            ->setTitle($news->meta_title)
            ->setDescription($news->meta_description)
            ->setImage($news->thumbnail)
            ->addValue('creator', setting('website-name'))
            ->setUrl($request->url());

        JsonLdMulti::setType('Organization');
        JsonLdMulti::setTitle(setting('website-name'));
        JsonLdMulti::setDescription(setting('home-description'));
        JsonLdMulti::addValue('logo', setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setImage(setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setSite(setting('website-name'));
        JsonLdMulti::setUrl(route('index'));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebSite');
            JsonLdMulti::setTitle($categories->pluck('name')->implode('/'));
            JsonLdMulti::setDescription($category->meta_description);
            JsonLdMulti::setImage($category->thumbnail);
            JsonLdMulti::setSite($categories->pluck('name')->implode('/'));
            JsonLdMulti::setUrl(url($categories->pluck('slug')->implode('/')));
        }

        return view('pages.news.index', $this->general($request));
    }

    public function category($slug, Request $request)
    {
        $slug = explode('/', $slug);
        $cateSlug = array_pop($slug);
        $category = Category::where('slug', $cateSlug)->where('status', 1)->firstorfail();
        $this->data['category'] = $category;

        $categories = Category::where('status', 1)->ancestorsAndSelf($category->id);
        $this->data['categories'] = $categories;

        $news_first = $category->news()->inRandomOrder()->get()->where('status', 1)->first();
        $this->data['news_first'] = $news_first;

        $news_right = $category->news()->get()->where('status', 1)->where('id', '!=', $news_first->id)->take(5);
        $this->data['news_right'] = $news_right;

        $news_slider = $category->news()->get()
            ->where('status', 1)
            ->where('id', '!=', $news_first->id)
            ->whereNotIn('id', $news_right->pluck('id')->toArray())
            ->take(4);

        $this->data['news_slider'] = $news_slider;

        $news_left = $category->news()->get()
            ->where('status', 1)
            ->where('id', '!=', $news_first->id)
            ->whereNotIn('id', $news_right->pluck('id')->toArray())
            ->whereNotIn('id', $news_slider->pluck('id')->toArray())
            ->take(6);

        $this->data['news_left'] = $news_left;


        // Seo
        SEOMeta::setTitle($category->meta_title);
        SEOMeta::setKeywords($category->meta_keyword);
        SEOMeta::addMeta('news_keywords', $value = $category->meta_keyword, $name = 'name');
        SEOMeta::setDescription($category->meta_description);
        SEOMeta::setCanonical($request->url());
        SEOMeta::addMeta('author', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('copyright', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('generator', $value = setting('website-name'), $name = 'name');
        SEOMeta::setRobots('noarchive,index,follow');

        OpenGraph::setTitle($category->meta_title)
            ->setDescription($category->meta_description)
            ->setUrl($request->url())
            ->setType('article')
            ->addImage($category->thumbnail, ['height' => 800, 'width' => 354])
            ->setSiteName(setting('website-name'))
            ->addProperty('locale', 'vi_VN')
            ->setArticle([
                'author' => setting('social-facebook'),
                'publisher' => setting('social-facebook'),
                'tag' => $category->meta_keyword,
                'section' => $category->name,
                'published_time' => $category->created_at,
                'modified_time' => $category->updated_at
            ]);
        SEOMeta::addMeta('fb:app_id', $value = setting('facebook-app-id'), $name = 'name');

        TwitterCard::setType('summary')
            ->setSite($category->meta_title)
            ->setTitle($category->meta_title)
            ->setDescription($category->meta_description)
            ->setImage($category->thumbnail)
            ->addValue('creator', setting('website-name'))
            ->setUrl($request->url());

        JsonLdMulti::setType('Organization');
        JsonLdMulti::setTitle(setting('website-name'));
        JsonLdMulti::setDescription(setting('home-description'));
        JsonLdMulti::addValue('logo', setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setImage(setting('logo', upload_url('70x70no-thumbnail.png')));
        JsonLdMulti::setSite(setting('website-name'));
        JsonLdMulti::setUrl(route('index'));
        if (!JsonLdMulti::isEmpty()) {
            JsonLdMulti::newJsonLd();
            JsonLdMulti::setType('WebSite');
            JsonLdMulti::setTitle($categories->pluck('name')->implode('/'));
            JsonLdMulti::setDescription($category->meta_description);
            JsonLdMulti::setImage($category->thumbnail);
            JsonLdMulti::setSite($categories->pluck('name')->implode('/'));
            JsonLdMulti::setUrl(url($categories->pluck('slug')->implode('/')));
        }

        return view('pages.category.index', $this->general($request));
    }

    public function search(Request $request)
    {
        $search = $request->query('q');
        $news = [];
        if ($search) {
            $news = News::where('title', 'LIKE', "%{$search}%")->where('status', 1)->paginate(5);
        }
        $this->data['news'] = $news;

        // Seo
        SEOMeta::setTitle('Tìm kiếm tin tức: ' . $search . ' | ' . setting('search-title'));
        SEOMeta::setKeywords(setting('search-keyword'));
        SEOMeta::addMeta('news_keywords', $value = setting('search-keyword'), $name = 'name');
        SEOMeta::setDescription(setting('home-description'));
        SEOMeta::setCanonical($request->url());
        SEOMeta::addMeta('author', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('copyright', $value = setting('website-name'), $name = 'name');
        SEOMeta::addMeta('generator', $value = setting('website-name'), $name = 'name');
        SEOMeta::setRobots('noarchive,index,follow');

        OpenGraph::setTitle(setting('search-title'))
            ->setDescription(setting('search-description'))
            ->setUrl($request->url())
            ->setType('article')
            ->addImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->setSiteName(setting('website-name'))
            ->addProperty('locale', 'vi_VN')
            ->setArticle([
                'author' => setting('social-facebook'),
                'publisher' => setting('social-facebook'),
                'tag' => setting('search-keyword'),
                'section' => setting('website-name')
            ]);
        SEOMeta::addMeta('fb:app_id', $value = setting('facebook-app-id'), $name = 'name');

        TwitterCard::setType('summary')
            ->setSite(setting('search-title'))
            ->setTitle(setting('search-title'))
            ->setDescription(setting('search-description'))
            ->setImage(setting('default-thumbnail', upload_url('70x70no-thumbnail.png')), ['height' => 800, 'width' => 354])
            ->addValue('creator', setting('website-name'))
            ->setUrl($request->url());

        return view('pages.search', $this->general($request));
    }
}
