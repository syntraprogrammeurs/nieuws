<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Support\Facades\View;

class SeoService
{
    public function setForArticle(Article $article)
    {
        View::share('seo_title', $article->title . ' - PinNews');
        View::share('seo_description', $article->excerpt);
        View::share('seo_image', $article->image);
        View::share('seo_url', route('article.show', $article->slug));
    }

    public function setDefaults()
    {
        View::share('seo_title', 'PinNews - Ontdek het laatste nieuws');
        View::share('seo_description', 'Blijf op de hoogte van het laatste nieuws in design, tech en meer.');
        View::share('seo_image', asset('images/og-image.jpg'));
        View::share('seo_url', url()->current());
    }
}
