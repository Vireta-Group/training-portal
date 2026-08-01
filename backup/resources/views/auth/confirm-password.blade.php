<x-guest-layout title="Confirm Password">
<div class="text-center mb-6 sm:mb-8">
<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-rose-500 to-pink-600 flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-3 sm:mb-4 shadow-lg shadow-rose-500/20 animate-bounce">🛡️</div>
<h2 class="text-xl sm:text-2xl font-bold text-white">Confirm Access</h2>
<p class="text-white/60 text-xs sm:text-sm mt-1">Please confirm your password to continue</p>
</div>

<form method="POST" action="{{ route('password.confirm') }}" class="space-y-4 sm:space-y-5">
@csrf

<div>
<label for="password" class="block text-sm font-medium text-white/80 mb-1">Your Password</label>
<input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••"
class="block w-full px-3 sm:px-4 py-2.5 sm:py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition text-sm">
<x-input-error :messages="$errors->get('password')" class="mt-2" />
</div>

<button type="submit" class="w-full py-3 sm:py-3.5 bg-gradient-to-r from-rose-600 to-pink-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-rose-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
Confirm
</button>
</form>
</x-guest-layout>
