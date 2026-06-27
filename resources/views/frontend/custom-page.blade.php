@extends('layouts.frontend')

@section('title', $customPage->name.' | '.$siteSettings->site_name)
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($customPage->content), 155))
@section('page_css', 'home')

@section('content')
<main id="top" class="custom-page-main">
    <section class="custom-page-hero">
        <div class="container">
            <div class="section-label">{{ $siteSettings->site_name }}</div>
            <h1>{{ $customPage->name }}</h1>
        </div>
    </section>
    <section class="custom-page-content-section">
        <div class="container">
            <article class="custom-page-content rich-content">
                {!! $customPage->content !!}
            </article>
        </div>
    </section>
</main>
@endsection
