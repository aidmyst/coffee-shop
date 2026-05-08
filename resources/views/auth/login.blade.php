<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        <div
            class="max-w-md w-full space-y-8 bg-white p-10 rounded-[3rem] shadow-2xl shadow-orange-100 border border-orange-50/50">

            {{-- HEADER & LOGO --}}
            <div class="text-center">
                {{-- LOGO CAFE --}}
                <div
                    class="inline-flex items-center justify-center rounded-full shadow-lg mb-6">
                    <img src="{{ asset('storage/images/Solstice.png') }}" alt="Solstice Cafe Logo"
                        class="h-20 w-20 rounded-full object-cover border-2 border-white ring-2 ring-orange-100 shadow-sm transition-transform hover:scale-105">
                </div>

                <h2 class="text-3xl font-black text-gray-900 tracking-tighter uppercase italic">
                    Solstice <span class="text-orange-600 italic">Cafe</span>
                </h2>
                <p class="mt-2 text-sm font-bold text-gray-400 uppercase tracking-[0.2em]">
                    Staff Access Only
                </p>
            </div>

            <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="mt-8 space-y-6">
                @csrf

                {{-- EMAIL --}}
                <div class="relative group">
                    <label for="email"
                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 mb-1 block">Email
                        Address</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-orange-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input id="email" type="email" name="email" :value="old('email')" required autofocus
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none border-none shadow-sm"
                            placeholder="username@cafe.com">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-4" />
                </div>

                {{-- PASSWORD --}}
                <div class="relative group">
                    <label for="password"
                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest ml-4 mb-1 block">Security
                        Password</label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400 group-focus-within:text-orange-600 transition-colors">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            class="block w-full pl-11 pr-4 py-3.5 bg-gray-50 border-transparent rounded-2xl text-sm font-bold text-gray-700 focus:bg-white focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all outline-none border-none shadow-sm"
                            placeholder="••••••••">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-4" />
                </div>

                {{-- LOGIN BUTTON --}}
                <div class="pt-2">
                    <button type="submit"
                        class="w-full bg-orange-600 text-white py-4 rounded-2xl font-black text-sm uppercase tracking-[0.2em] shadow-xl shadow-orange-600/20 hover:bg-orange-700 hover:-translate-y-1 transition-all active:scale-95 flex items-center justify-center gap-3">
                        Unlock Dashboard
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>

            {{-- FOOTER --}}
            <div class="pt-8 text-center border-t border-gray-50">
                <p class="text-[9px] font-black text-gray-300 uppercase tracking-[0.3em]">
                    &copy; 2026 Solstice Management System
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
