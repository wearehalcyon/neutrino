@extends('dashboard.layouts.app')

@section('title', applyFilter('custom_admin_page_title', ''))

@section('header-scripts')
    {{ doAction('custom_admin_page_header_scripts') }}
@endsection

@section('content')
    {{  doAction('custom_admin_page_content') }}
@endsection

@section('footer-scripts')
    {{ doAction('custom_admin_page_footer_scripts') }}
@endsection