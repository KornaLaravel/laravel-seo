<?php

use Illuminate\Support\Facades\Route;
use RalphJSmit\Laravel\SEO\Tests\Fixtures\Page;
use RalphJSmit\Laravel\SEO\Tests\TestCase;

use function Pest\Laravel\withoutExceptionHandling;

uses(TestCase::class)
    ->beforeEach(function () {
        withoutExceptionHandling();

        Route::middleware('web')->group(function () {
            Route::get('/', fn () => (string) seo())->name('seo.test-home');
            Route::get('/seo/test-plain', fn () => (string) seo())->name('seo.test-plain');
            Route::get('/seo/{page}', fn (Page $page) => (string) seo()->for($page))->name('seo.test-page');
        });

        Page::$overrides = [];
    })
    ->in(__DIR__);