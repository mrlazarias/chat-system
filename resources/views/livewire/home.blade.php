<div class="min-h-screen bg-black relative overflow-hidden">
    <!-- Circuit Background Pattern -->
    <div class="absolute inset-0 opacity-20">
        <!-- Circuit lines -->
        <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <defs>
                <pattern id="circuit" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <path d="M0,10 L20,10 M10,0 L10,20" stroke="#374151" stroke-width="0.5" fill="none"/>
                </pattern>
            </defs>
            <rect width="100%" height="100%" fill="url(#circuit)"/>
        </svg>

        <!-- Circuit modules in corners -->
        <div class="absolute top-4 left-4 w-8 h-6 bg-gray-800 rounded-sm border border-gray-600">
            <div class="flex space-x-1 p-1">
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>
        <div class="absolute top-4 right-4 w-8 h-6 bg-gray-800 rounded-sm border border-gray-600">
            <div class="flex space-x-1 p-1">
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>
        <div class="absolute bottom-4 left-4 w-8 h-6 bg-gray-800 rounded-sm border border-gray-600">
            <div class="flex space-x-1 p-1">
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>
        <div class="absolute bottom-4 right-4 w-8 h-6 bg-gray-800 rounded-sm border border-gray-600">
            <div class="flex space-x-1 p-1">
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
                <div class="w-1 h-1 bg-white rounded-full"></div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="relative z-10 min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Login Card -->
            <div class="bg-gray-900 py-8 px-6 shadow-2xl rounded-xl border border-gray-700">
                <!-- Header -->
                <div class="text-center mb-8">
                    <!-- Logo -->
                    <div class="mx-auto h-16 w-16 bg-gray-800 rounded-full flex items-center justify-center mb-4 border border-gray-600">
                        <div class="h-8 w-8 bg-white rounded-full flex items-center justify-center">
                            <span class="text-black font-bold text-lg">C</span>
                        </div>
                    </div>

                    <h2 class="text-2xl font-bold text-white mb-2">Welcome Back</h2>
                    <p class="text-gray-400 text-sm">
                        Don't have an account yet?
                        <a href="{{ route('register') }}" class="text-blue-400 hover:text-blue-300 transition-colors">Sign up</a>
                    </p>
                </div>

                <!-- Login Form -->
                <form wire:submit="login" class="space-y-6">
                    <!-- Email Field -->
                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                </svg>
                            </div>
                            <input wire:model="email" id="email" name="email" type="email" autocomplete="email" required
                                   placeholder="email address"
                                   class="block w-full pl-10 pr-3 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password Field -->
                    <div>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <input wire:model="password" id="password" name="password" type="password" autocomplete="current-password" required
                                   placeholder="Password"
                                   class="block w-full pl-10 pr-3 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                        Login
                    </button>

                    <!-- Divider -->
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-600"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-gray-900 text-gray-400">OR</span>
                        </div>
                    </div>

                    <!-- Social Login Buttons -->
                    <div class="grid grid-cols-3 gap-3">
                        <!-- Apple -->
                        <button type="button" class="w-full inline-flex justify-center py-3 px-4 border border-gray-600 rounded-lg shadow-sm bg-gray-800 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                            </svg>
                        </button>

                        <!-- Google -->
                        <button type="button" class="w-full inline-flex justify-center py-3 px-4 border border-gray-600 rounded-lg shadow-sm bg-gray-800 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                        </button>

                        <!-- X (Twitter) -->
                        <button type="button" class="w-full inline-flex justify-center py-3 px-4 border border-gray-600 rounded-lg shadow-sm bg-gray-800 text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition duration-150 ease-in-out">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
