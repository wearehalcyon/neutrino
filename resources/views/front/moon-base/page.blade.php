@include('front.moon-base.header')
    <section class="post-hero">
        <div class="hero-inner">
            <h1 class="title">{{ $page->name }}</h1>
        </div>
    </section>
    <section class="post-content my-5 py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-3 my-3">
                    <div class="post-content">{!! $page->content !!}</div>
                </div>
            </div>
        </div>
    </section>
@include('front.moon-base.footer')
