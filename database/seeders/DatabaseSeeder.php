<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Category;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $dataMenu = array(
            array('id' => 1, 'name' => 'store', '_lft' => 1, '_rgt' => 20, 'parent_id' => null),
            array('id' => 2, 'name' => 'notebooks', '_lft' => 2, '_rgt' => 7, 'parent_id' => 1),
            array('id' => 3, 'name' => 'apple', '_lft' => 3, '_rgt' => 4, 'parent_id' => 2),
            array('id' => 4, 'name' => 'lenovo', '_lft' => 5, '_rgt' => 6, 'parent_id' => 2),
            array('id' => 5, 'name' => 'mobile', '_lft' => 8, '_rgt' => 19, 'parent_id' => 1),
            array('id' => 6, 'name' => 'nokia', '_lft' => 9, '_rgt' => 10, 'parent_id' => 5),
            array('id' => 7, 'name' => 'samsung', '_lft' => 11, '_rgt' => 14, 'parent_id' => 5),
            array('id' => 8, 'name' => 'galaxy', '_lft' => 12, '_rgt' => 13, 'parent_id' => 7),
            array('id' => 9, 'name' => 'sony', '_lft' => 15, '_rgt' => 16, 'parent_id' => 5),
            array('id' => 10, 'name' => 'lenovo', '_lft' => 17, '_rgt' => 18, 'parent_id' => 5),
            array('id' => 11, 'name' => 'store_2', '_lft' => 21, '_rgt' => 22, 'parent_id' => null),
        );
        Menu::insert($dataMenu);

        $dataCategory = array(
            array('id' => 1, 'name' => 'store', 'slug' => 'store', '_lft' => 1, '_rgt' => 20, 'parent_id' => null),
            array('id' => 2, 'name' => 'notebooks', 'slug' => 'notebooks', '_lft' => 2, '_rgt' => 7, 'parent_id' => 1),
            array('id' => 3, 'name' => 'apple', 'slug' => 'apple', '_lft' => 3, '_rgt' => 4, 'parent_id' => 2),
            array('id' => 4, 'name' => 'lenovo', 'slug' => 'lenovo', '_lft' => 5, '_rgt' => 6, 'parent_id' => 2),
            array('id' => 5, 'name' => 'mobile', 'slug' => 'mobile', '_lft' => 8, '_rgt' => 19, 'parent_id' => 1),
            array('id' => 6, 'name' => 'nokia', 'slug' => 'nokia', '_lft' => 9, '_rgt' => 10, 'parent_id' => 5),
            array('id' => 7, 'name' => 'samsung', 'slug' => 'samsung', '_lft' => 11, '_rgt' => 14, 'parent_id' => 5),
            array('id' => 8, 'name' => 'galaxy', 'slug' => 'galaxy', '_lft' => 12, '_rgt' => 13, 'parent_id' => 7),
            array('id' => 9, 'name' => 'sony', 'slug' => 'sony', '_lft' => 15, '_rgt' => 16, 'parent_id' => 5),
            array('id' => 10, 'name' => 'lenovo', 'slug' => 'lenovo', '_lft' => 17, '_rgt' => 18, 'parent_id' => 5),
            array('id' => 11, 'name' => 'store_2', 'slug' => 'store-2', '_lft' => 21, '_rgt' => 22, 'parent_id' => null),
        );
        Category::insert($dataCategory);

        User::factory(10)->create();
    }
}
