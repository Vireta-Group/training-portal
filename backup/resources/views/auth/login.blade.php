<x-guest-layout title="Login">
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="text-center mb-6 sm:mb-8">
<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-3 sm:mb-4 shadow-lg shadow-indigo-500/20 animate-bounce">🔐</div>
<h2 class="text-xl sm:text-2xl font-bold text-white">Welcome Back</h2>
<p class="text-white/60 text-xs sm:text-sm mt-1">Sign in to manage your training center</p>
</div>

<form method="POST" action="{{ route('login') }}" class="space-y-4 sm:space-y-5">
@csrf

<div>
<label for="email" class="block text-sm font-medium text-white/80 mb-1">Email Address</label>
<input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<div>
<label for="password" class="block text-sm font-medium text-white/80 mb-1">Password</label>
<input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-0">
<label for="remember_me" class="flex items-center gap-2 cursor-pointer">
<input id="remember_me" type="checkbox" name="remember" class="w-4 h-4 rounded bg-white/5 border-white/20 text-indigo-600 focus:ring-indigo-500">
<span class="text-sm text-white/60">Remember me</span>
</label>
@if (Route::has('password.request'))
<a href="{{ route('password.request') }}" class="text-sm text-indigo-400 hover:text-indigo-300 transition font-medium">Forgot password?</a>
@endif
</div>

<button type="submit" class="w-full py-3 sm:py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
Sign In
</button>
</form>

<div class="mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-white/5 text-center">
<p class="text-white/50 text-xs sm:text-sm">
Don't have an account?
<a href="{{ route('register') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Create one</a>
</p>
</div>
</x-guest-layout>
