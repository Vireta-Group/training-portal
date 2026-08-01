<x-guest-layout title="Register">
<form method="POST" action="{{ route('register') }}">
@csrf

<div class="text-center mb-6 sm:mb-8">
<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-3 sm:mb-4 shadow-lg shadow-emerald-500/20 animate-bounce">🚀</div>
<h2 class="text-xl sm:text-2xl font-bold text-white">Get Started</h2>
<p class="text-white/60 text-xs sm:text-sm mt-1">Set up your training center in minutes</p>
</div>

<div class="space-y-4 sm:space-y-5">
<div>
<div class="flex items-center gap-2 mb-3">
<div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-indigo-500/20 flex items-center justify-center text-indigo-400"><svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg></div>
<span class="text-xs sm:text-sm font-semibold text-white/80">Institute Details</span>
</div>
<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<div>
<input type="text" name="institute_name" :value="old('institute_name')" required autofocus placeholder="Institute Name *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('institute_name')" class="mt-2" />
</div>
<div>
<input type="text" name="institute_code" :value="old('institute_code')" required placeholder="Institute Code *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('institute_code')" class="mt-2" />
</div>
<div class="sm:col-span-2">
<input type="text" name="mobile" :value="old('mobile')" required placeholder="Mobile Number *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('mobile')" class="mt-2" />
</div>
</div>
</div>

<div>
<div class="flex items-center gap-2 mb-3">
<div class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg bg-emerald-500/20 flex items-center justify-center text-emerald-400"><svg class="w-3.5 h-3.5 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg></div>
<span class="text-xs sm:text-sm font-semibold text-white/80">Admin Account</span>
</div>
<div class="space-y-3">
<input type="text" name="admin_name" :value="old('admin_name')" required placeholder="Admin Name *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('admin_name')" class="mt-2" />

<input type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="Email *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('email')" class="mt-2" />

<div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
<div>
<input type="password" name="password" required autocomplete="new-password" placeholder="Password *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>
<div>
<input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password *"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
</div>
</div>
</div>
</div>
</div>

<div class="mt-6 sm:mt-8 space-y-4">
<button type="submit" class="w-full py-3 sm:py-3.5 bg-gradient-to-r from-emerald-600 to-teal-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-emerald-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
Create Account
</button>

<p class="text-center text-white/50 text-xs sm:text-sm">
Already have an account?
<a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold transition">Sign in</a>
</p>
</div>
</form>
</x-guest-layout>
