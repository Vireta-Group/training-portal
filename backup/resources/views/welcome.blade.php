@php $s = App\Models\CompanySetting::getSettings(); @endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ $s->meta_description }}">
<meta name="keywords" content="{{ $s->meta_keywords }}">
<title>{{ $s->meta_title ?: config('app.name') }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('public/css/tailwind-build.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/fontawesome.min.css') }}">
<script src="{{ asset('public/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/js/alpine.min.js') }}" defer></script>
<link rel="icon" href="{{ $s->favicon ? Storage::url($s->favicon) : 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>' }}">
<style>
*{scrollbar-width:thin;scrollbar-color:rgba(99,102,241,0.3) transparent;font-family:'Inter',system-ui,sans-serif}
[x-cloak]{display:none!important}
.reveal{opacity:0;transform:translateY(40px);transition:all 0.8s cubic-bezier(0.16,1,0.3,1)}
.reveal.visible{opacity:1;transform:translateY(0)}
.card-hover{transition:all 0.4s cubic-bezier(0.16,1,0.3,1)}
.card-hover:hover{transform:translateY(-6px);box-shadow:0 20px 40px -12px rgba(99,102,241,0.15)}
.gradient-text{background:linear-gradient(135deg,#6366f1,#a78bfa,#f472b6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;background-size:200% 200%;animation:gradientShift 4s ease infinite}
.gradient-text-2{background:linear-gradient(135deg,#6366f1,#4f46e5);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
@keyframes gradientShift{0%,100%{background-position:0% 50%}50%{background-position:100% 50%}}
.shimmer{position:relative;overflow:hidden;background:linear-gradient(90deg,transparent,rgba(99,102,241,0.06),transparent);background-size:200% 100%;animation:shimmer 3s infinite}
@keyframes shimmer{0%{background-position:-200% 0}100%{background-position:200% 0}}
.btn-primary{display:inline-flex;align-items:center;gap:8px;padding:14px 32px;background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:999px;font-weight:600;font-size:1rem;transition:all 0.3s;box-shadow:0 8px 24px rgba(99,102,241,0.25);position:relative;overflow:hidden}
.btn-primary::after{content:'';position:absolute;inset:0;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.15),transparent);background-size:200% 100%;animation:shimmer 3s infinite}
.btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 40px rgba(99,102,241,0.35)}
.btn-outline{display:inline-flex;align-items:center;gap:8px;padding:14px 32px;border:2px solid rgba(99,102,241,0.25);color:#6366f1;border-radius:999px;font-weight:600;font-size:1rem;transition:all 0.3s}
.btn-outline:hover{background:rgba(99,102,241,0.06);border-color:rgba(99,102,241,0.5);transform:translateY(-2px)}
.btn-secondary{display:inline-flex;align-items:center;gap:8px;padding:12px 24px;background:#fff;color:#6366f1;border-radius:999px;font-weight:600;font-size:0.9rem;transition:all 0.3s;box-shadow:0 4px 12px rgba(99,102,241,0.1);border:1px solid rgba(99,102,241,0.15)}
.btn-secondary:hover{transform:translateY(-2px);box-shadow:0 8px 24px rgba(99,102,241,0.2)}
.hero-grid{background-image:radial-gradient(rgba(99,102,241,0.08) 1px,transparent 1px);background-size:40px 40px}
.glow-indigo{box-shadow:0 0 60px rgba(99,102,241,0.08),0 0 120px rgba(99,102,241,0.03)}
.floating{animation:float 7s ease-in-out infinite}
.floating-2{animation:float 7s ease-in-out 2s infinite}
.floating-3{animation:float 7s ease-in-out 4s infinite}
@keyframes float{0%,100%{transform:translateY(0) rotate(0deg)}33%{transform:translateY(-15px) rotate(1deg)}66%{transform:translateY(8px) rotate(-1deg)}}
.counter-num{font-variant-numeric:tabular-nums}
.badge-pulse{animation:badgePulse 2s ease-in-out infinite}
@keyframes badgePulse{0%,100%{box-shadow:0 0 0 0 rgba(99,102,241,0.3)}50%{box-shadow:0 0 0 8px rgba(99,102,241,0)}}
.border-glow{animation:borderGlow 3s ease-in-out infinite}
@keyframes borderGlow{0%,100%{border-color:rgba(99,102,241,0.2)}50%{border-color:rgba(99,102,241,0.5)}}
.shimmer-text{display:inline-block;background:linear-gradient(90deg,#6366f1,#a78bfa,#f472b6,#a78bfa,#6366f1);background-size:300% 100%;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmerText 4s linear infinite}
@keyframes shimmerText{0%{background-position:0% 50%}100%{background-position:300% 50%}}
.sticky-cta{transition:transform 0.5s cubic-bezier(0.16,1,0.3,1)}
.sticky-cta.hidden-bar{transform:translateY(100%)}
.gradient-mesh{background-image:radial-gradient(circle at 20% 50%,rgba(99,102,241,0.04) 0,transparent 50%),radial-gradient(circle at 80% 50%,rgba(168,85,247,0.04) 0,transparent 50%)}
</style>
</head>
<body class="bg-white text-gray-900 antialiased overflow-x-hidden" x-data="{ mobileNav: false, stickyBar: false, activeTestimonial: 0, annual: false, testimonialInterval: null }" x-init="
    window.addEventListener('scroll',()=>{ stickyBar = window.scrollY > 700 });
    document.addEventListener('DOMContentLoaded',()=>{
        const observer=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible')}})},{threshold:0.1});
        document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));

        const counterObserver=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){animateCounters()}})},{threshold:0.3});
        const counterSection=document.getElementById('counters');
        if(counterSection) counterObserver.observe(counterSection);

        testimonialInterval = setInterval(()=>{ activeTestimonial = (activeTestimonial + 1) % 5 }, 4000);
    });
    function animateCounters(){
        const counters=document.querySelectorAll('.counter-num');
        counters.forEach(c=>{
            const target=parseInt(c.dataset.target);
            if(c.dataset.animated) return;
            c.dataset.animated=true;
            let current=0,step=Math.ceil(target/60),interval=setInterval(()=>{
                current+=step;if(current>=target){current=target;clearInterval(interval)}
                c.textContent=current+(c.dataset.suffix||'');
            },25);
        });
    }
">

<script>
document.addEventListener('DOMContentLoaded',()=>{
const observer=new IntersectionObserver((entries)=>{entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible')}})},{threshold:0.1});
document.querySelectorAll('.reveal').forEach(el=>observer.observe(el));
});
</script>

{{-- ===== NAVBAR ===== --}}
<nav x-data="{ scrolled: false }" x-init="window.addEventListener('scroll',()=>scrolled=window.scrollY>20)" class="fixed top-0 inset-x-0 z-50 transition-all duration-500" :class="scrolled?'bg-white/90 backdrop-blur-xl shadow-sm border-b border-gray-100':'bg-transparent'">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="flex items-center justify-between h-18 lg:h-20">
<a href="/" class="flex items-center gap-2.5 group">
<div class="w-9 h-9 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm shadow-lg shadow-indigo-500/20 group-hover:scale-105 transition-transform">TP</div>
<span class="text-lg font-extrabold tracking-tight" :class="scrolled?'text-gray-900':'text-white'">{{ $s->company_name ?: 'TrainingPro' }}</span>
</a>
<div class="hidden lg:flex items-center gap-1">
<a href="#features" class="px-4 py-2 text-sm font-medium rounded-lg transition" :class="scrolled?'text-gray-600 hover:text-gray-900 hover:bg-gray-100':'text-white/80 hover:text-white hover:bg-white/10'">Features</a>
<a href="#solutions" class="px-4 py-2 text-sm font-medium rounded-lg transition" :class="scrolled?'text-gray-600 hover:text-gray-900 hover:bg-gray-100':'text-white/80 hover:text-white hover:bg-white/10'">Solutions</a>
<a href="#pricing" class="px-4 py-2 text-sm font-medium rounded-lg transition" :class="scrolled?'text-gray-600 hover:text-gray-900 hover:bg-gray-100':'text-white/80 hover:text-white hover:bg-white/10'">Pricing</a>
<a href="#testimonials" class="px-4 py-2 text-sm font-medium rounded-lg transition" :class="scrolled?'text-gray-600 hover:text-gray-900 hover:bg-gray-100':'text-white/80 hover:text-white hover:bg-white/10'">Testimonials</a>
</div>
<div class="hidden lg:flex items-center gap-3">
@auth
<a href="{{ route('admin.dashboard') }}" class="btn-primary text-sm !py-2.5 !px-5">Dashboard</a>
<form method="POST" action="{{ route('logout') }}" class="inline">
@csrf
<button type="submit" class="px-4 py-2 text-sm font-medium rounded-lg transition" :class="scrolled?'text-gray-500 hover:text-gray-700 hover:bg-gray-100':'text-white/70 hover:text-white hover:bg-white/10'">Logout</button>
</form>
@else
<a href="{{ route('login') }}" class="text-sm font-medium transition" :class="scrolled?'text-gray-600 hover:text-gray-900':'text-white/80 hover:text-white'">Sign in</a>
<a href="{{ route('register') }}" class="btn-primary text-sm !py-2.5 !px-5">
Get Started Free
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
@endauth
</div>
<button @click="mobileNav=!mobileNav" class="lg:hidden p-2 rounded-lg transition" :class="scrolled?'text-gray-600 hover:bg-gray-100':'text-white hover:bg-white/10'">
<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
</button>
</div>
</div>
<div x-show="mobileNav" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="lg:hidden bg-white border-t border-gray-100 shadow-xl">
<div class="px-4 py-4 space-y-2">
<a href="#features" @click="mobileNav=false" class="block px-4 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">Features</a>
<a href="#solutions" @click="mobileNav=false" class="block px-4 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">Solutions</a>
<a href="#pricing" @click="mobileNav=false" class="block px-4 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">Pricing</a>
<a href="#testimonials" @click="mobileNav=false" class="block px-4 py-2.5 rounded-lg text-gray-600 hover:bg-gray-50 font-medium">Testimonials</a>
<hr class="my-3 border-gray-100">
@auth
<a href="{{ route('admin.dashboard') }}" class="block text-center py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold">Dashboard</a>
<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" class="block text-center py-3 mt-2 text-gray-500 hover:text-gray-700 rounded-xl font-semibold w-full">Logout</button>
</form>
@else
<a href="{{ route('login') }}" class="block text-center py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold">Sign in</a>
<a href="{{ route('register') }}" class="block text-center py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-xl font-semibold mt-2">Get Started Free</a>
@endauth
</div>
</div>
</nav>

{{-- ===== HERO ===== --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-indigo-50 via-white to-purple-50">
<div class="absolute inset-0 gradient-mesh"></div>
<div class="absolute inset-0 hero-grid opacity-40"></div>
<div class="absolute top-1/4 -left-32 w-96 h-96 bg-indigo-200/30 rounded-full blur-[120px]"></div>
<div class="absolute bottom-1/4 -right-32 w-96 h-96 bg-purple-200/30 rounded-full blur-[120px] floating-2"></div>
<div class="absolute top-1/3 right-1/4 w-64 h-64 bg-pink-200/20 rounded-full blur-[100px] floating-3"></div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-32 lg:py-40 relative z-10 w-full">
<div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-center">
<div class="text-center lg:text-left">
<div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-indigo-50 border border-indigo-100 text-indigo-700 text-sm font-medium mb-6 badge-pulse">
<span class="w-1.5 h-1.5 rounded-full bg-indigo-500 animate-pulse"></span>
Now enrolling for <span class="text-indigo-800 font-semibold">Summer 2026</span> — Limited seats
</div>
<h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold leading-[1.05] tracking-tight mb-6">
<span class="text-gray-900">The All-in-One Platform</span><br>
<span class="shimmer-text">for Training Centers</span><br>
<span class="text-gray-500 text-2xl sm:text-3xl lg:text-4xl font-semibold">in Bangladesh</span>
</h1>
<p class="text-lg sm:text-xl text-gray-600 max-w-xl mb-10 leading-relaxed">
From admission to certification — manage your entire training center operations with one powerful SaaS platform. Trusted by <span class="text-gray-900 font-semibold">10+ centers</span> and <span class="text-gray-900 font-semibold">5,000+ learners</span> nationwide.
</p>
<div class="flex flex-wrap gap-4 justify-center lg:justify-start">
<a href="{{ route('register') }}" class="btn-primary text-lg !px-10 !py-4">
Start Free Trial
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
<a href="#features" class="btn-outline text-lg !px-10 !py-4">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
Watch Overview
</a>
</div>

{{-- Trust badges --}}
<div class="flex flex-wrap items-center gap-6 mt-10 justify-center lg:justify-start">
<div class="flex items-center gap-3">
<div class="flex -space-x-2">
<div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold">S</div>
<div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold">A</div>
<div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 border-2 border-white flex items-center justify-center text-white text-xs font-bold">R</div>
<div class="w-10 h-10 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 border-2 border-white flex items-center justify-center text-white text-xs font-semibold">5k+</div>
</div>
<div class="text-gray-500 text-sm leading-tight">
<span class="text-gray-900 font-bold text-lg">5,000+</span><br>
<span class="text-gray-400">Learners enrolled</span>
</div>
</div>
<div class="hidden sm:block w-px h-10 bg-gray-200"></div>
<div class="flex items-center gap-2">
<div class="flex text-yellow-500 text-sm">★★★★★</div>
<span class="text-gray-900 font-bold">4.9</span>
<span class="text-gray-400 text-xs">(2.5k reviews)</span>
</div>
</div>

{{-- Trust badges row 2 --}}
<div class="flex flex-wrap gap-3 mt-6 justify-center lg:justify-start">
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 border border-emerald-200 text-emerald-700 text-xs font-medium"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> No credit card</span>
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-indigo-50 border border-indigo-200 text-indigo-700 text-xs font-medium"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg> 30-day free trial</span>
<span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 border border-amber-200 text-amber-700 text-xs font-medium"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg> Free forever plan</span>
</div>
</div>

{{-- Right: Dashboard mockup with floating badges --}}
<div class="hidden lg:flex justify-center relative">
<div class="relative w-full max-w-lg">
<div class="relative rounded-2xl overflow-hidden shadow-2xl shadow-indigo-500/5 border border-gray-200 glow-indigo">
<div class="bg-white p-4 flex items-center gap-2 border-b border-gray-100">
<div class="flex gap-1.5"><span class="w-3 h-3 rounded-full bg-red-400"></span><span class="w-3 h-3 rounded-full bg-yellow-400"></span><span class="w-3 h-3 rounded-full bg-green-400"></span></div>
<div class="flex-1 text-center text-xs text-gray-400 font-medium">trainingpro.io / dashboard</div>
<div class="w-4"></div>
</div>
<div class="bg-gray-50 p-6 space-y-4">
<div class="grid grid-cols-3 gap-3">
<div class="col-span-2 bg-white rounded-xl p-4 border border-gray-100 shadow-sm"><div class="flex items-center justify-between mb-3"><span class="text-xs text-gray-500">Students</span><span class="text-xs text-emerald-600">+12%</span></div><div class="text-2xl font-bold text-gray-900">1,248</div><div class="mt-2 w-full bg-gray-100 rounded-full h-1.5"><div class="bg-indigo-500 h-1.5 rounded-full" style="width:68%"></div></div></div>
<div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm"><div class="flex items-center justify-between mb-3"><span class="text-xs text-gray-500">Revenue</span></div><div class="text-2xl font-bold text-gray-900">BDT 4.2L</div><div class="mt-1 text-xs text-gray-400">This month</div></div>
<div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm"><div class="flex items-center justify-between mb-3"><span class="text-xs text-gray-500">Courses</span></div><div class="text-2xl font-bold text-gray-900">24</div><div class="mt-1 text-xs text-gray-400">Active</div></div>
</div>
<div class="flex items-center gap-3 bg-indigo-50 rounded-xl p-3 border border-indigo-100">
<div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
<span class="text-sm text-gray-600">System running smoothly — 99.9% uptime</span>
</div>
</div>
</div>

{{-- Floating badges --}}
<div class="absolute -top-3 -right-3 w-20 h-20 bg-gradient-to-br from-amber-400 to-orange-500 rounded-2xl flex items-center justify-center text-2xl shadow-2xl shadow-amber-500/30 floating">⚡</div>
<div class="absolute -bottom-4 -left-4 bg-white backdrop-blur-xl rounded-xl px-5 py-3 border border-gray-200 inline-flex items-center gap-3 shadow-lg">
<div class="flex text-yellow-500 text-sm">★★★★★</div>
<span class="text-gray-900 text-sm font-semibold">4.9</span>
<span class="text-gray-400 text-xs">from 2.5k reviews</span>
</div>
<div class="absolute top-12 -right-8 bg-white backdrop-blur-xl rounded-lg px-3 py-2 border border-gray-200 text-xs shadow-lg floating-2">
<span class="text-emerald-700 font-semibold">Free forever</span>
<span class="text-gray-400"> plan available</span>
</div>
<div class="absolute -left-6 bottom-20 bg-white backdrop-blur-xl rounded-lg px-3 py-2 border border-gray-200 text-xs shadow-lg floating-3">
<span class="text-indigo-700 font-semibold">No CC</span>
<span class="text-gray-400"> required</span>
</div>
</div>
</div>
</div>
</div>
</section>

{{-- ===== TRUST BAR ===== --}}
<section class="py-14 border-y border-gray-100 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<p class="text-center text-xs font-semibold uppercase tracking-[0.15em] text-gray-400 mb-8">Trusted by training centers across Bangladesh</p>
<div class="flex flex-wrap justify-center items-center gap-10 md:gap-16 grayscale hover:grayscale-0 transition-all duration-500">
<span class="text-xl font-black text-gray-300 hover:text-indigo-600 transition cursor-default">BRAC</span>
<span class="text-xl font-black text-gray-300 hover:text-emerald-600 transition cursor-default">a2i</span>
<span class="text-xl font-black text-gray-300 hover:text-amber-600 transition cursor-default">ICT Division</span>
<span class="text-xl font-black text-gray-300 hover:text-rose-600 transition cursor-default">BUET</span>
<span class="text-xl font-black text-gray-300 hover:text-cyan-600 transition cursor-default">SELISE</span>
<span class="text-xl font-black text-gray-300 hover:text-purple-600 transition cursor-default">The Daily Star</span>
</div>
</div>
</section>

{{-- ===== LIVE COUNTERS ===== --}}
<section id="counters" class="py-20 bg-gradient-to-br from-indigo-50 via-white to-purple-50 relative overflow-hidden">
<div class="absolute inset-0 hero-grid opacity-20"></div>
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
<div class="grid grid-cols-2 md:grid-cols-4 gap-6">
<div class="reveal bg-white rounded-2xl p-8 text-center border border-gray-100 card-hover shadow-sm">
<div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-lg shadow-lg shadow-indigo-500/20">🏢</div>
<div class="counter-num text-5xl font-black text-gray-900" data-target="10" data-suffix="+">0+</div>
<div class="text-gray-500 font-medium mt-2">Training Centers</div>
</div>
<div class="reveal bg-white rounded-2xl p-8 text-center border border-gray-100 card-hover shadow-sm" style="transition-delay:0.1s">
<div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-white text-lg shadow-lg shadow-emerald-500/20">👨‍🎓</div>
<div class="counter-num text-5xl font-black text-gray-900" data-target="5000" data-suffix="+">0+</div>
<div class="text-gray-500 font-medium mt-2">Students Enrolled</div>
</div>
<div class="reveal bg-white rounded-2xl p-8 text-center border border-gray-100 card-hover shadow-sm" style="transition-delay:0.2s">
<div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-white text-lg shadow-lg shadow-amber-500/20">📚</div>
<div class="counter-num text-5xl font-black text-gray-900" data-target="50" data-suffix="+">0+</div>
<div class="text-gray-500 font-medium mt-2">Courses Offered</div>
</div>
<div class="reveal bg-white rounded-2xl p-8 text-center border border-gray-100 card-hover shadow-sm" style="transition-delay:0.3s">
<div class="w-12 h-12 mx-auto mb-4 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-white text-lg shadow-lg shadow-rose-500/20">⚡</div>
<div class="counter-num text-5xl font-black text-gray-900" data-target="99" data-suffix=".9%">0%</div>
<div class="text-gray-500 font-medium mt-2">Platform Uptime</div>
</div>
</div>
</div>
</section>

{{-- ===== COMPARISON SECTION ===== --}}
<section class="py-24 lg:py-32 bg-gray-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">⚡ See the Difference</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Before vs After <span class="gradient-text">TrainingPro</span></h2>
<p class="text-lg text-gray-600">Stop juggling spreadsheets. Start managing with one platform.</p>
</div>
<div class="grid md:grid-cols-2 gap-6 max-w-4xl mx-auto">
<div class="reveal bg-white rounded-2xl p-8 border border-gray-200 card-hover shadow-sm">
<div class="flex items-center gap-3 mb-6">
<span class="w-10 h-10 rounded-xl bg-red-50 border border-red-100 flex items-center justify-center text-red-500 text-lg">😫</span>
<h3 class="text-xl font-bold text-gray-900">Before TrainingPro</h3>
</div>
<ul class="space-y-4">
<li class="flex items-start gap-3 text-gray-600"><svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> 3+ days to process admissions manually</li>
<li class="flex items-start gap-3 text-gray-600"><svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> 5 separate spreadsheets for tracking</li>
<li class="flex items-start gap-3 text-gray-600"><svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> Manual certificate generation (hours)</li>
<li class="flex items-start gap-3 text-gray-600"><svg class="w-5 h-5 text-red-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/></svg> Payment tracking errors & delays</li>
</ul>
</div>
<div class="reveal bg-indigo-50/50 rounded-2xl p-8 border border-indigo-100 card-hover" style="transition-delay:0.15s">
<div class="flex items-center gap-3 mb-6">
<span class="w-10 h-10 rounded-xl bg-emerald-50 border border-emerald-100 flex items-center justify-center text-emerald-500 text-lg">😎</span>
<h3 class="text-xl font-bold text-gray-900">After TrainingPro</h3>
</div>
<ul class="space-y-4">
<li class="flex items-start gap-3 text-gray-700"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> 5-minute online admission process</li>
<li class="flex items-start gap-3 text-gray-700"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> One unified dashboard for everything</li>
<li class="flex items-start gap-3 text-gray-700"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Auto-generated QR certificates (1-click)</li>
<li class="flex items-start gap-3 text-gray-700"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Real-time payment tracking & reports</li>
</ul>
</div>
</div>
<div class="text-center mt-10">
<a href="{{ route('register') }}" class="btn-primary text-lg !px-10 !py-4">
Make the Switch Today
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
</div>
</div>
</section>

{{-- ===== FEATURES ===== --}}
<section id="features" class="py-24 lg:py-32 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">🚀 Powerful Features</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Everything You Need to <span class="gradient-text">Run Your Center</span></h2>
<p class="text-lg text-gray-600">One platform handles admission, attendance, payments, HR, exams, certificates, and analytics.</p>
</div>
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm">
<div class="absolute inset-0 bg-gradient-to-br from-indigo-50 to-purple-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform duration-300">📋</div><h3 class="text-xl font-bold text-gray-900 mb-3">Smart Admissions</h3><p class="text-gray-600 leading-relaxed">Digital application forms, auto batch assignment, instant approval workflow, and SMS confirmation — handle 1000+ applicants with ease.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-indigo-600 hover:text-indigo-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm" style="transition-delay:0.1s">
<div class="absolute inset-0 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">💳</div><h3 class="text-xl font-bold text-gray-900 mb-3">Automated Payments</h3><p class="text-gray-600 leading-relaxed">bKash, Nagad, bank, and cash. Auto invoice generation, fee tracking, due reminders, and expense management with financial reports.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-emerald-600 hover:text-emerald-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm" style="transition-delay:0.2s">
<div class="absolute inset-0 bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform duration-300">👥</div><h3 class="text-xl font-bold text-gray-900 mb-3">Attendance Tracking</h3><p class="text-gray-600 leading-relaxed">QR code and manual attendance. Real-time reports, auto notifications to parents, and comprehensive analytics for each batch.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-amber-600 hover:text-amber-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm" style="transition-delay:0.3s">
<div class="absolute inset-0 bg-gradient-to-br from-rose-50 to-pink-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-rose-500/20 group-hover:scale-110 transition-transform duration-300">📝</div><h3 class="text-xl font-bold text-gray-900 mb-3">Exams & Results</h3><p class="text-gray-600 leading-relaxed">Create quizzes, midterms, finals. Auto grade calculation, GPA, merit lists, and publish results instantly with student portal access.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-rose-600 hover:text-rose-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm" style="transition-delay:0.4s">
<div class="absolute inset-0 bg-gradient-to-br from-violet-50 to-fuchsia-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-violet-500 to-fuchsia-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-violet-500/20 group-hover:scale-110 transition-transform duration-300">🎓</div><h3 class="text-xl font-bold text-gray-900 mb-3">Digital Certificates</h3><p class="text-gray-600 leading-relaxed">Auto-generated QR-verified certificates. Share digitally, print with templates, and employers can verify instantly online.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-violet-600 hover:text-violet-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
<div class="reveal group relative bg-white rounded-2xl p-8 card-hover border border-gray-100 shadow-sm" style="transition-delay:0.5s">
<div class="absolute inset-0 bg-gradient-to-br from-cyan-50 to-blue-50 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
<div class="relative"><div class="w-14 h-14 rounded-xl bg-gradient-to-br from-cyan-500 to-blue-600 flex items-center justify-center text-2xl mb-5 shadow-lg shadow-cyan-500/20 group-hover:scale-110 transition-transform duration-300">📊</div><h3 class="text-xl font-bold text-gray-900 mb-3">Analytics & Reports</h3><p class="text-gray-600 leading-relaxed">Real-time dashboards, financial reports, student performance analytics, batch-wise insights, and exportable data for stakeholders.</p><a href="{{ route('register') }}" class="inline-flex items-center gap-1 mt-4 text-sm text-cyan-600 hover:text-cyan-700 font-medium transition group/link">Learn more <svg class="w-3.5 h-3.5 transition-transform group-hover/link:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg></a></div>
</div>
</div>
</div>
</section>

{{-- ===== HOW IT WORKS ===== --}}
<section id="solutions" class="py-24 lg:py-32 bg-gray-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">⚡ How It Works</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Get Started in <span class="gradient-text">3 Simple Steps</span></h2>
<p class="text-lg text-gray-600">Set up your training center in minutes, not days.</p>
</div>
<div class="grid md:grid-cols-3 gap-8 lg:gap-12 relative">
<div class="hidden md:block absolute top-12 left-[16%] right-[16%] h-0.5 bg-gradient-to-r from-indigo-300 via-indigo-400 to-indigo-300"></div>
<div class="reveal text-center relative">
<div class="relative w-24 h-24 mx-auto mb-6">
<div class="absolute inset-0 bg-indigo-100 rounded-2xl rotate-45 border border-indigo-200"></div>
<div class="relative w-full h-full flex items-center justify-center"><span class="text-4xl">📦</span></div>
<div class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-indigo-500 text-white text-xs font-bold flex items-center justify-center">1</div>
</div>
<h3 class="text-xl font-bold text-gray-900 mb-3">Create Your Center</h3>
<p class="text-gray-600 max-w-sm mx-auto">Sign up, add your institute details, set up courses, batches, and fee structures in under 10 minutes.</p>
</div>
<div class="reveal text-center relative" style="transition-delay:0.15s">
<div class="relative w-24 h-24 mx-auto mb-6">
<div class="absolute inset-0 bg-emerald-100 rounded-2xl rotate-45 border border-emerald-200"></div>
<div class="relative w-full h-full flex items-center justify-center"><span class="text-4xl">👨‍🎓</span></div>
<div class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-emerald-500 text-white text-xs font-bold flex items-center justify-center">2</div>
</div>
<h3 class="text-xl font-bold text-gray-900 mb-3">Enroll Students</h3>
<p class="text-gray-600 max-w-sm mx-auto">Students apply online, you approve with one click, assign batches, and track payments — all in one place.</p>
</div>
<div class="reveal text-center relative" style="transition-delay:0.3s">
<div class="relative w-24 h-24 mx-auto mb-6">
<div class="absolute inset-0 bg-amber-100 rounded-2xl rotate-45 border border-amber-200"></div>
<div class="relative w-full h-full flex items-center justify-center"><span class="text-4xl">🚀</span></div>
<div class="absolute -top-2 -right-2 w-7 h-7 rounded-full bg-amber-500 text-white text-xs font-bold flex items-center justify-center">3</div>
</div>
<h3 class="text-xl font-bold text-gray-900 mb-3">Manage & Grow</h3>
<p class="text-gray-600 max-w-sm mx-auto">Take attendance, conduct exams, collect fees, issue certificates, and track everything with powerful analytics.</p>
</div>
</div>
<div class="text-center mt-12">
<a href="{{ route('register') }}" class="btn-primary text-lg !px-10 !py-4">
Ready to Start? Get Started Free
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
</div>
</div>
</section>

{{-- ===== PRICING ===== --}}
<section id="pricing" class="py-24 lg:py-32 bg-white">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">💰 Simple Pricing</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Built for Centers of <span class="gradient-text">All Sizes</span></h2>
<p class="text-lg text-gray-600">Start free, scale as you grow. No hidden fees.</p>

<div class="flex items-center justify-center gap-4 mt-8">
<span class="text-sm text-gray-500" :class="!annual ? 'text-gray-900 font-semibold' : ''">Monthly</span>
<button @click="annual = !annual" class="relative w-14 h-7 rounded-full transition-colors duration-300" :class="annual ? 'bg-indigo-600' : 'bg-gray-300'">
<span class="absolute top-0.5 left-0.5 w-6 h-6 rounded-full bg-white shadow transition-transform duration-300" :class="annual ? 'translate-x-7' : ''"></span>
</button>
<span class="text-sm text-gray-500" :class="annual ? 'text-gray-900 font-semibold' : ''">Annual <span class="text-emerald-600 text-xs font-semibold">Save 20%</span></span>
</div>
</div>
<div class="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
<div class="reveal bg-white rounded-2xl p-8 border border-gray-200 card-hover shadow-sm">
<div class="text-sm font-semibold text-indigo-600 mb-4 uppercase tracking-wider">Starter</div>
<div class="mb-6">
<span class="text-5xl font-black text-gray-900">Free</span>
</div>
<p class="text-gray-600 mb-8">Perfect for small centers getting started</p>
<ul class="space-y-4 mb-8">
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Up to 50 students</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>3 courses</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Basic attendance</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Email support</li>
</ul>
<a href="{{ route('register') }}" class="block text-center py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:border-indigo-500 hover:text-indigo-600 transition">Get Started</a>
</div>
<div class="reveal bg-white rounded-2xl p-8 border-2 border-indigo-500 card-hover shadow-lg relative" style="transition-delay:0.1s">
<div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-xs font-bold px-4 py-1.5 rounded-full">Most Popular</div>
<div class="text-sm font-semibold text-indigo-600 mb-4 uppercase tracking-wider">Professional</div>
<div class="mb-6">
<template x-if="!annual">
<span><span class="text-5xl font-black text-gray-900">BDT 2,499</span><span class="text-gray-400 text-lg">/mo</span></span>
</template>
<template x-if="annual">
<span><span class="text-5xl font-black text-gray-900">BDT 2,000</span><span class="text-gray-400 text-lg">/mo</span></span>
</template>
</div>
<p class="text-gray-600 mb-8">For growing centers with multiple batches</p>
<ul class="space-y-4 mb-8">
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Up to 500 students</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Unlimited courses & batches</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>HR & payroll module</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Exams & certificates</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>SMS & email notifications</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Priority support</li>
</ul>
<a href="{{ route('register') }}" class="block text-center py-3 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold hover:shadow-lg hover:shadow-indigo-500/25 transition">Start Free Trial</a>
</div>
<div class="reveal bg-white rounded-2xl p-8 border border-gray-200 card-hover shadow-sm" style="transition-delay:0.2s">
<div class="text-sm font-semibold text-indigo-600 mb-4 uppercase tracking-wider">Enterprise</div>
<div class="mb-6"><span class="text-5xl font-black text-gray-900">Custom</span></div>
<p class="text-gray-600 mb-8">For large institutions with custom needs</p>
<ul class="space-y-4 mb-8">
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Unlimited everything</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Dedicated account manager</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>API access</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>Custom integrations</li>
<li class="flex items-start gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>24/7 dedicated support</li>
</ul>
<a href="#cta" class="block text-center py-3 rounded-xl border-2 border-gray-200 text-gray-700 font-semibold hover:border-indigo-500 hover:text-indigo-600 transition">Contact Us</a>
</div>
</div>
<div class="flex flex-wrap justify-center gap-6 mt-8 text-gray-500 text-sm">
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> No credit card</span>
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Free forever plan</span>
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Cancel anytime</span>
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> 30-day money-back</span>
</div>
</div>
</section>

{{-- ===== TESTIMONIALS CAROUSEL ===== --}}
<section id="testimonials" class="py-24 lg:py-32 bg-gray-50">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center max-w-3xl mx-auto mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">💬 What Users Say</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Loved by <span class="gradient-text">Training Centers</span></h2>
<p class="text-lg text-gray-600">Real feedback from center owners and administrators across Bangladesh</p>
</div>
<div class="max-w-4xl mx-auto relative">
<div class="overflow-hidden">
<div x-show="activeTestimonial === 0" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-8 md:p-10 border border-gray-100 shadow-sm">
<div class="flex gap-1 text-yellow-500 text-lg mb-5">★★★★★</div>
<p class="text-gray-700 text-lg leading-relaxed mb-8">"TrainingPro completely transformed how we manage our center. What used to take hours in spreadsheets now happens in minutes. The admission and payment modules are absolute game-changers for us."</p>
<div class="flex items-center gap-4"><div class="w-14 h-14 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-lg">MH</div><div><p class="font-semibold text-gray-900 text-lg">Md. Hasan</p><p class="text-sm text-gray-500">Director, BITAC Training Center</p></div></div>
</div>
<div x-show="activeTestimonial === 1" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-8 md:p-10 border border-gray-100 shadow-sm">
<div class="flex gap-1 text-yellow-500 text-lg mb-5">★★★★★</div>
<p class="text-gray-700 text-lg leading-relaxed mb-8">"The automated certificate generation saved us countless hours. Parents love the QR verification feature — they can instantly verify any certificate online. I recommend TrainingPro to every training center I know."</p>
<div class="flex items-center gap-4"><div class="w-14 h-14 rounded-full bg-gradient-to-br from-emerald-400 to-teal-500 flex items-center justify-center text-white font-bold text-lg">SN</div><div><p class="font-semibold text-gray-900 text-lg">Sultana Nasrin</p><p class="text-sm text-gray-500">Principal, Women's IT Institute</p></div></div>
</div>
<div x-show="activeTestimonial === 2" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-8 md:p-10 border border-gray-100 shadow-sm">
<div class="flex gap-1 text-yellow-500 text-lg mb-5">★★★★★</div>
<p class="text-gray-700 text-lg leading-relaxed mb-8">"We manage 8 branches with TrainingPro. The multi-project feature is brilliant — each branch has its own data but I get a consolidated view of everything. Exactly what a growing institution needs."</p>
<div class="flex items-center gap-4"><div class="w-14 h-14 rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center text-white font-bold text-lg">KR</div><div><p class="font-semibold text-gray-900 text-lg">Kazi Rahman</p><p class="text-sm text-gray-500">CEO, TechSkills BD</p></div></div>
</div>
<div x-show="activeTestimonial === 3" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-8 md:p-10 border border-gray-100 shadow-sm">
<div class="flex gap-1 text-yellow-500 text-lg mb-5">★★★★★</div>
<p class="text-gray-700 text-lg leading-relaxed mb-8">"Switching from manual spreadsheets to TrainingPro was the best decision we made. Our staff productivity increased by 3x and we finally have accurate financial reports at our fingertips."</p>
<div class="flex items-center gap-4"><div class="w-14 h-14 rounded-full bg-gradient-to-br from-cyan-400 to-blue-500 flex items-center justify-center text-white font-bold text-lg">FK</div><div><p class="font-semibold text-gray-900 text-lg">Fahim Karim</p><p class="text-sm text-gray-500">Operations Head, Skills Development Center</p></div></div>
</div>
<div x-show="activeTestimonial === 4" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-8" x-transition:enter-end="opacity-100 translate-x-0" class="bg-white rounded-2xl p-8 md:p-10 border border-gray-100 shadow-sm">
<div class="flex gap-1 text-yellow-500 text-lg mb-5">★★★★★</div>
<p class="text-gray-700 text-lg leading-relaxed mb-8">"The exam and result management module alone is worth the price. Creating exams, auto-grading, and publishing results used to take 2 days. Now it's done in 30 minutes. Absolute must-have."</p>
<div class="flex items-center gap-4"><div class="w-14 h-14 rounded-full bg-gradient-to-br from-rose-400 to-pink-500 flex items-center justify-center text-white font-bold text-lg">NJ</div><div><p class="font-semibold text-gray-900 text-lg">Nusrat Jahan</p><p class="text-sm text-gray-500">Academic Coordinator, ProActive Learning</p></div></div>
</div>
</div>
<div class="flex items-center justify-center gap-3 mt-8">
<template x-for="i in 5" :key="i">
<button @click="activeTestimonial = i-1; clearInterval(testimonialInterval); testimonialInterval=setInterval(()=>{ activeTestimonial = (activeTestimonial + 1) % 5 }, 4000)" class="w-2.5 h-2.5 rounded-full transition-all duration-300" :class="activeTestimonial === i-1 ? 'bg-indigo-500 w-8' : 'bg-gray-300 hover:bg-gray-400'"></button>
</template>
</div>
</div>
</div>
</section>

{{-- ===== CTA ===== --}}
<section id="cta" class="py-24 bg-white relative overflow-hidden">
<div class="absolute inset-0 gradient-mesh"></div>
<div class="absolute inset-0 hero-grid opacity-20"></div>
<div class="absolute -top-40 -right-40 w-96 h-96 bg-indigo-100/50 rounded-full blur-[100px]"></div>
<div class="absolute -bottom-40 -left-40 w-96 h-96 bg-purple-100/50 rounded-full blur-[100px]"></div>
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
<div class="bg-white shadow-xl rounded-3xl p-12 lg:p-16 border border-gray-100 border-glow">
<h2 class="text-3xl sm:text-5xl font-extrabold text-gray-900 mb-4">Ready to Transform Your Training Center?</h2>
<p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">Join <span class="text-gray-900 font-semibold">10+ centers</span> across Bangladesh. Start free, no credit card required. Upgrade when you grow.</p>
<div class="flex flex-wrap justify-center gap-4">
<a href="{{ route('register') }}" class="btn-primary text-lg !px-10 !py-5">
Start Free Trial
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
<a href="tel:{{ $s->mobile }}" class="btn-outline text-lg !px-10 !py-5">
<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
Talk to Sales
</a>
</div>
<div class="flex flex-wrap justify-center gap-6 mt-8 text-gray-500 text-sm">
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> No credit card</span>
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Free forever plan</span>
<span class="flex items-center gap-1.5"><svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg> Cancel anytime</span>
</div>
</div>
</div>
</section>

{{-- ===== FAQ ===== --}}
<section class="py-24 bg-gray-50">
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="text-center mb-16">
<div class="inline-flex items-center gap-2 px-4 py-1.5 bg-indigo-50 border border-indigo-100 text-indigo-700 rounded-full text-sm font-medium mb-4">❓ FAQ</div>
<h2 class="text-4xl sm:text-5xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
<p class="text-lg text-gray-600">Everything you need to know about TrainingPro</p>
</div>
<div x-data="{ open: null }" class="space-y-4">
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
<button @click="open = open === 1 ? null : 1" class="w-full flex items-center justify-between px-6 py-5 text-left font-semibold text-gray-900 hover:bg-gray-50 transition">What is TrainingPro?<svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 1 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
<div x-show="open === 1" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" class="px-6 pb-5 text-gray-600 leading-relaxed">TrainingPro is a comprehensive SaaS platform designed for training centers in Bangladesh. It handles admissions, attendance, payments, HR, exams, certificates, and analytics — all in one place.</div>
</div>
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
<button @click="open = open === 2 ? null : 2" class="w-full flex items-center justify-between px-6 py-5 text-left font-semibold text-gray-900 hover:bg-gray-50 transition">How much does it cost?<svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 2 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
<div x-show="open === 2" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" class="px-6 pb-5 text-gray-600 leading-relaxed">We offer a free starter plan for small centers. Our Professional plan is BDT 2,499/month (BDT 2,000/month billed annually) for growing centers. Enterprise plans are custom-priced. All plans include a 14-day free trial.</div>
</div>
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
<button @click="open = open === 3 ? null : 3" class="w-full flex items-center justify-between px-6 py-5 text-left font-semibold text-gray-900 hover:bg-gray-50 transition">Can I try it before committing?<svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 3 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
<div x-show="open === 3" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" class="px-6 pb-5 text-gray-600 leading-relaxed">Absolutely! Sign up for free and get full access to all features for 14 days. No credit card required. You can invite your team and start managing your center immediately.</div>
</div>
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
<button @click="open = open === 4 ? null : 4" class="w-full flex items-center justify-between px-6 py-5 text-left font-semibold text-gray-900 hover:bg-gray-50 transition">Is my data safe?<svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 4 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
<div x-show="open === 4" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" class="px-6 pb-5 text-gray-600 leading-relaxed">Yes. We use enterprise-grade encryption, regular backups, and secure data centers. Your data is backed up daily and we maintain 99.9% uptime. We also comply with Bangladesh data protection regulations.</div>
</div>
<div class="bg-white rounded-xl border border-gray-100 overflow-hidden shadow-sm">
<button @click="open = open === 5 ? null : 5" class="w-full flex items-center justify-between px-6 py-5 text-left font-semibold text-gray-900 hover:bg-gray-50 transition">Do you offer training & support?<svg class="w-5 h-5 text-gray-400 transition-transform" :class="open === 5 ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg></button>
<div x-show="open === 5" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" class="px-6 pb-5 text-gray-600 leading-relaxed">Yes! We provide free onboarding support, video tutorials, and documentation. Professional and Enterprise plans include priority support via phone, email, and WhatsApp.</div>
</div>
</div>
</div>
</section>

{{-- ===== FOOTER ===== --}}
<footer class="bg-gray-50 text-gray-900 pt-20 pb-8 border-t border-gray-100">
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
<div class="grid md:grid-cols-2 lg:grid-cols-6 gap-10 mb-16">
<div class="lg:col-span-2">
<div class="flex items-center gap-2.5 mb-6"><div class="w-10 h-10 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-base shadow-lg shadow-indigo-500/20">TP</div><span class="text-xl font-bold">{{ $s->company_name ?: 'TrainingPro' }}</span></div>
<p class="text-gray-600 leading-relaxed mb-6 max-w-sm">{{ $s->footer_text ?: 'Bangladesh\'s leading SaaS platform for training center management. From admission to certification — we power your training operations.' }}</p>
<div class="flex gap-3">
@if($s->facebook_url)<a href="{{ $s->facebook_url }}" target="_blank" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-indigo-100 flex items-center justify-center text-gray-400 hover:text-indigo-600 transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M9.101 23.691v-7.98H6.627v-3.667h2.474v-1.58c0-4.085 1.848-5.978 5.858-5.978.401 0 .955.042 1.468.103a8.68 8.68 0 011.141.195v3.325a8.623 8.623 0 00-.653-.036 26.805 26.805 0 00-.733-.009c-.707 0-1.259.096-1.675.309a1.686 1.686 0 00-.679.622c-.258.42-.374.995-.374 1.752v1.297h3.919l-.386 2.103-.287 1.564h-3.246v8.245C19.396 23.097 24 18.179 24 12.044c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.628 3.874 10.35 9.101 11.647z"/></svg></a>@endif
@if($s->youtube_url)<a href="{{ $s->youtube_url }}" target="_blank" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-red-100 flex items-center justify-center text-gray-400 hover:text-red-600 transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></a>@endif
@if($s->whatsapp_number)<a href="https://wa.me/{{ $s->whatsapp_number }}" target="_blank" class="w-10 h-10 rounded-lg bg-gray-100 hover:bg-green-100 flex items-center justify-center text-gray-400 hover:text-green-600 transition-all"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg></a>@endif
</div>

{{-- Newsletter --}}
<div class="mt-8">
<p class="text-sm text-gray-600 mb-3 font-medium">Subscribe to our newsletter</p>
<form action="#" method="POST" class="flex gap-2 max-w-sm">
<input type="email" placeholder="Enter your email" class="flex-1 px-4 py-2.5 rounded-xl bg-white border border-gray-200 text-gray-900 text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/50 focus:border-indigo-500 transition" required>
<button type="submit" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-purple-600 text-white text-sm font-semibold hover:shadow-lg hover:shadow-indigo-500/25 transition whitespace-nowrap">Subscribe</button>
</form>
</div>

{{-- Payment methods --}}
<div class="mt-6">
<p class="text-xs text-gray-400 mb-2">Accepted payment methods</p>
<div class="flex gap-2 text-2xl text-gray-300">
<span title="Visa" class="hover:text-gray-600 transition cursor-default">💳</span>
<span title="Mastercard" class="hover:text-gray-600 transition cursor-default">💳</span>
<span title="bKash" class="hover:text-gray-600 transition cursor-default">💚</span>
<span title="Nagad" class="hover:text-gray-600 transition cursor-default">🧡</span>
<span title="Bank Transfer" class="hover:text-gray-600 transition cursor-default">🏦</span>
</div>
</div>
</div>
<div><h4 class="font-semibold text-gray-900 mb-6 text-sm uppercase tracking-wider">Product</h4><ul class="space-y-3 text-gray-500"><li><a href="#features" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Features</a></li><li><a href="#pricing" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Pricing</a></li><li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Get Started</a></li><li><a href="#solutions" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>How It Works</a></li></ul></div>
<div><h4 class="font-semibold text-gray-900 mb-6 text-sm uppercase tracking-wider">Company</h4><ul class="space-y-3 text-gray-500"><li><a href="#" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>About</a></li><li><a href="#" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Blog</a></li><li><a href="#" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Careers</a></li><li><a href="#cta" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Contact</a></li></ul></div>
<div><h4 class="font-semibold text-gray-900 mb-6 text-sm uppercase tracking-wider">Support</h4><ul class="space-y-3 text-gray-500"><li><a href="#" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Help Center</a></li><li><a href="{{ route('register') }}" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Documentation</a></li><li><a href="#" class="hover:text-indigo-600 transition flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>API Reference</a></li><li><a href="#" class="hover:text-indigo-600 transition"><span class="flex items-center gap-2"><svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>Status</span></a></li></ul></div>
</div>
<div class="border-t border-gray-200 pt-8 text-center">
<div class="flex flex-wrap justify-center gap-6 text-sm text-gray-500 mb-4">
<a href="#" class="hover:text-gray-700 transition">Privacy Policy</a>
<a href="#" class="hover:text-gray-700 transition">Terms of Service</a>
<a href="#" class="hover:text-gray-700 transition">Refund Policy</a>
</div>
<p class="text-gray-400 text-sm">{{ $s->copyright_text ?: '© ' . date('Y') . ' TrainingPro. All rights reserved.' }}</p>
</div>
</div>
</footer>

{{-- ===== STICKY BOTTOM CTA BAR ===== --}}
<div x-show="stickyBar" x-transition:enter="transition ease-out duration-500" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" class="fixed bottom-0 inset-x-0 z-40 bg-white/95 backdrop-blur-xl border-t border-gray-200 py-4 px-4 shadow-lg">
<div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
<div class="hidden sm:flex items-center gap-3">
<div class="w-8 h-8 rounded-lg bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-xs">TP</div>
<div>
<p class="text-sm font-semibold text-gray-900">Start your free trial today</p>
<p class="text-xs text-gray-500">No credit card needed • 14 days free</p>
</div>
</div>
<div class="flex items-center gap-3">
@auth
<a href="{{ route('admin.dashboard') }}" class="btn-primary text-sm !py-2.5 !px-6">Dashboard</a>
<form method="POST" action="{{ route('logout') }}" class="inline">
@csrf
<button type="submit" class="text-sm text-gray-500 hover:text-gray-700 transition">Logout</button>
</form>
@else
<a href="{{ route('login') }}" class="text-sm text-gray-500 hover:text-gray-700 transition">Sign in</a>
<a href="{{ route('register') }}" class="btn-primary text-sm !py-2.5 !px-6">
Get Started Free
<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
</a>
@endauth
</div>
</div>
</div>

</body>
</html>
