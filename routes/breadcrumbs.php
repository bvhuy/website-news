<?php

Breadcrumbs::for('category', function ($trail, $category) {
    if ($category->parent) {
        $trail->parent('category', $category->parent);
    }

    $trail->push($category->name, url($category->ancestorsAndSelf($category->id)->pluck('slug')->implode('/')));
});
