@include('front.intake-digital.header')
<section class="inner-hero">
    <img src="{{ getThemeAssetsUri('/assets/images/hero/hero-0' . rand(1, 9) . '.jpg') }}" alt="Internal Hero Image">
    <div class="container text-center">
        <h1 class="hero-title">{{ $page->name }}</h1>
        <div class="breadcrumbs">
            <ol>
                @foreach($breadcrumbs as $breadcrumb)
                    <li>
                        @if($breadcrumb['url'])
                            <a href="{{ $breadcrumb['url'] }}"><span>{{ $breadcrumb['name'] }}</span></a>
                            <span class="separator">»</span>
                        @else
                            <span>{{ $breadcrumb['name'] }}</span>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</section>
<main class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-9">
                <div class="text">{!! $page->content !!}</div>
            </div>
            <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-3 mt-3 mt-xl-0">
                <aside class="sidebar">
                    <div class="sidebar-widget">
                        <h4 class="widget-title">Contact Us</h4>
                        {!! getContactForm('Sidebar Form', '3') !!}
                    </div>
                </aside>
            </div>
        </div>
    </div>
</main>
@include('front.intake-digital.footer')
