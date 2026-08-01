<x-guest-layout title="Verify Email">
<div class="text-center mb-6 sm:mb-8">
<div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl bg-gradient-to-br from-emerald-500 to-teal-600 flex items-center justify-center text-2xl sm:text-3xl mx-auto mb-3 sm:mb-4 shadow-lg shadow-emerald-500/20 animate-bounce">📧</div>
<h2 class="text-xl sm:text-2xl font-bold text-white">Verify Your Email</h2>
<p class="text-white/60 text-xs sm:text-sm mt-1">Thanks for signing up! Check your inbox for the verification link</p>
</div>

@if (session('status') == 'verification-link-sent')
<div class="mb-4 p-3 sm:p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 text-xs sm:text-sm font-medium text-center">
A new verification link has been sent to your email.
</div>
@endif

<div class="bg-white/5 rounded-xl p-4 sm:p-6 border border-white/5 mb-5 sm:mb-6">
<p class="text-white/60 text-xs sm:text-sm leading-relaxed">
Before getting started, could you verify your email address by clicking on the link we just emailed to you?
If you didn't receive the email, we will gladly send you another.
</p>
</div>

<div class="flex flex-col gap-3">
<form method="POST" action="{{ route('verification.send') }}">
@csrf
<button type="submit" class="w-full py-3 sm:py-3.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-xl hover:shadow-lg hover:shadow-indigo-500/25 transition-all hover:-translate-y-0.5 active:translate-y-0 text-sm sm:text-base">
Resend Verification Email
</button>
</form>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button type="submit" class="w-full py-2.5 sm:py-3 bg-white/5 border border-white/10 text-white/70 font-medium rounded-xl hover:bg-white/10 transition text-sm">
Log Out
</button>
</form>
</div>
</x-guest-layout>
