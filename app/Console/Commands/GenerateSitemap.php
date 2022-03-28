<?php

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\News;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */

    protected $count = 100;
    public function handle()
    {

        // create new sitemap object
        $sitemap = App::make('sitemap');

        $sitemap_categories = App::make('sitemap');

        $categories = Category::where('status', 1)->latest('created_at')->get();
        foreach ($categories as $category) {
            $sitemap_categories->add(URL::to($category->ancestorsAndSelf($category->id)->pluck('slug')->implode('/')), $category->created_at, '0.9', 'always');
        }

        $sitemap_categories->store('xml', 'sitemaps/categories');
        $sitemap->addSitemap(URL::to('sitemaps/categories.xml'), Carbon::now());

        // get all products from db (or wherever you store them)
        $news =  News::where('status', 1)->latest('created_at')->get();

        // counters
        $counter = 0;
        $sitemapCounter = 1;

        // add every product to multiple sitemaps with one sitemap index
        foreach ($news as $new) {
            if ($counter == $this->count) {
                // generate new sitemap file
                $sitemap->store('xml', 'sitemaps/news-' . date('Y') . '-' . $sitemapCounter);
                // add the file to the sitemaps array
                $sitemap->addSitemap(URL::to('sitemaps/news-' . date('Y') . '-' . $sitemapCounter . '.xml'), Carbon::now());
                // reset items array (clear memory)
                $sitemap->model->resetItems();
                // reset the counter
                $counter = 0;
                // count generated sitemap
                $sitemapCounter++;
            }

            // add product to items array
            $sitemap->add(route('news', ['slug' => $new->slug, 'id' => $new->id]), $new->created_at, '0.7', 'daily');
            // count number of elements
            $counter++;
        }

        // you need to check for unused items
        if (!empty($sitemap->model->getItems())) {
            // generate sitemap with last items
            $sitemap->store('xml', 'sitemaps/news-' . date('Y') . '-' . $sitemapCounter);
            // add sitemap to sitemaps array
            $sitemap->addSitemap(URL::to('sitemaps/news-' . date('Y') . '-' . $sitemapCounter . '.xml'), Carbon::now());
            // reset items array
            $sitemap->model->resetItems();
        }
        // generate new sitemapindex that will contain all generated sitemaps above

        $sitemap->store('sitemapindex', 'sitemap');
    }
}
