<x-guest-layout title="Forgot Password">
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="text-center mb-6 sm:mb-8">
<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-amber-500 to-orange-600 flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-3 sm:mb-4 shadow-lg shadow-amber-500/20 animate-bounce">🔑</div>
<h2 class="text-xl sm:text-2xl font-bold text-white">Reset Password</h2>
<p class="text-white/60 text-xs sm:text-sm mt-1">Enter your email and we'll send you a reset link</p>
</div>

<form method="POST" action="{{ route('password.email') }}" class="space-y-4 sm:space-y-5">
@csrf

<div>
<label for="email" class="block text-sm font-medium text-white/80 mb-1">Email Address</label>
<input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('email')" class="mt-2" />
</div>

<button type="submit" class="w-full py-3 sm:py-3.5 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-amber-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
Send Reset Link
</button>
</form>

<div class="mt-6 sm:mt-8 pt-5 sm:pt-6 border-t border-white/5 text-center">
<a href="{{ route('login') }}" class="text-indigo-400 hover:text-indigo-300 font-semibold text-xs sm:text-sm transition">← Back to Sign In</a>
</div>
</x-guest-layout>
