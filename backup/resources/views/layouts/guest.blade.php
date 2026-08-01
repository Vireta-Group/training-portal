<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="authApp()" x-init="init()" :class="{ 'dark': dark }">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{ config('app.name') }} — {{ $title ?? 'Authentication' }}</title>
<link rel="stylesheet" href="{{ asset('public/css/fontawesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/css/tailwind-build.css') }}">
<script src="{{ asset('public/js/alpine.min.js') }}" defer></script>
<link rel="icon" href="{{ App\Models\CompanySetting::getSettings()->favicon ? Storage::url(App\Models\CompanySetting::getSettings()->favicon) : 'data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🎓</text></svg>' }}">
<style>
*{scrollbar-width:thin;scrollbar-color:rgba(99,102,241,0.3) transparent}
[x-cloak]{display:none!important}
.auth-gradient{background:linear-gradient(135deg,#0f0c29,#302b63,#24243e)}
.particles span{position:absolute;width:6px;height:6px;background:rgba(255,255,255,0.12);border-radius:50%;animation:particle 20s infinite linear}
.particles span:nth-child(1){top:5%;left:5%;animation-delay:0s;width:4px;height:4px}
.particles span:nth-child(2){top:15%;right:20%;animation-delay:4s;width:6px;height:6px}
.particles span:nth-child(3){bottom:30%;left:15%;animation-delay:8s;width:5px;height:5px}
.particles span:nth-child(4){bottom:10%;right:10%;animation-delay:12s;width:8px;height:8px}
.particles span:nth-child(5){top:45%;left:45%;animation-delay:16s;width:3px;height:3px}
@keyframes particle{0%{transform:translateY(0) scale(1);opacity:0}10%{opacity:1}90%{opacity:1}100%{transform:translateY(-500px) scale(0);opacity:0}}

.auth-card{opacity:0;transform:translate(40px,-40px) scale(0.95);transition:all 0.7s cubic-bezier(0.16,1,0.3,1)}
.auth-card.visible{opacity:1;transform:translate(0,0) scale(1)}
</style>
</head>
<body class="auth-gradient min-h-screen flex items-start sm:items-center justify-center relative overflow-y-auto px-4 py-8 sm:py-6" x-cloak>
<div class="particles absolute inset-0 pointer-events-none"><span></span><span></span><span></span><span></span><span></span></div>

<div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMyI+PGNpcmNsZSBjeD0iMzAiIGN5PSIzMCIgcj0iMSIvPjwvZz48L2c+PC9zdmc+')] opacity-40"></div>

<div class="absolute top-1/4 -left-32 w-80 h-80 bg-indigo-500/10 rounded-full blur-[120px]"></div>
<div class="absolute bottom-1/4 -right-32 w-80 h-80 bg-purple-500/10 rounded-full blur-[120px]"></div>

<div class="relative z-10 w-full flex flex-col items-center">
<div class="flex items-center gap-3 mb-6 sm:mb-8">
<a href="/" class="flex items-center gap-2.5">
<div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold sm:text-lg shadow-lg shadow-indigo-500/30">TP</div>
<span class="text-lg sm:text-xl font-bold text-white/90">TrainingPro</span>
</a>
<button @click="dark = !dark; toggleDark()" class="p-2 rounded-xl bg-white/5 border border-white/10 text-white/60 hover:text-white hover:bg-white/10 transition-all" title="Toggle theme">
<svg x-show="!dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
<svg x-show="dark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
</button>
</div>

<div id="authCard" class="auth-card w-full max-w-md bg-white/10 backdrop-blur-xl rounded-2xl shadow-2xl shadow-indigo-500/10 border border-white/10 p-6 sm:p-8">
{{ $slot }}
</div>
</div>

<script>
function authApp() {
    return {
        dark: localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches),
        init() {
            if (this.dark) document.documentElement.classList.add('dark');
            setTimeout(() => {
                const card = document.getElementById('authCard');
                if (card) card.classList.add('visible');
            }, 80);
        },
        toggleDark() {
            this.dark = !this.dark;
            if (this.dark) { document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); }
            else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); }
        }
    }
}
</script>
</body>
</html>
