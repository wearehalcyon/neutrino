@include('front.moon-base.header')
    <section class="homepage-hero">
        <h1 class="page-title">{{ $page->name }}</h1>
    </section>
    <section class="content py-5 my-5">
        <div class="container">
            <h2 class="content-title">Page Content</h2>
            <div class="text mt-4">{!! $page->content !!}</div>
        </div>
    </section>
@include('front.moon-base.footer')
