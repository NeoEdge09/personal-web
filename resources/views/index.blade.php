@extends('layouts.main')


@section('content')
    <!-- HERO AREA -->
    @include('sections.hero.index')
    <!-- .hero-area -->

    <!-- ABOUT SECTION -->
    @include('sections.about.index')
    <!-- .about-section -->

    <!-- SKILL SECTION -->
    @include('sections.skills.index')
    <!-- .skill-section -->

    <!-- PORTFOLIO SECTION -->
    @include('sections.portfolio.index')
    <!-- .portfolio-section -->

    <!-- SERVICE SECTION -->
    {{-- @include('sections.services.index') --}}
    <!-- .service-section -->

    <!-- RESUME SECTION -->
    @include('sections.resumes.index')
    <!-- .resume-section -->

    <!-- BLOG SECTION -->
    @include('sections.blog.index')
    <!-- .blog-section -->

    <!-- CONTACT SECTION -->
    @include('sections.contact.index')
    <!-- .contact-section -->
@endsection
