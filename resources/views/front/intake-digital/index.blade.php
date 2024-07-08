@include('front.intake-digital.header')
    <section class="inner-hero">
        <img src="{{ getThemeAssetsUri('/assets/images/hero/hero-0' . rand(1, 9) . '.jpg') }}" alt="Internal Hero Image">
        <div class="container">
            <h1 class="hero-title">{{ $page->name }}</h1>
        </div>
    </section>
    <main class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-8 col-xl-9">
                    <div class="text">{!! $page->content !!}</div>
                </div>
                <div class="col-md-12 col-lg-4 col-xl-3">
                    {!! getContactForm('Sidebar Form', '1') !!}
                </div>
            </div>
        </div>
    </main>
@include('front.intake-digital.footer')
