<section class="bg-gray-100">
    <div class="px-6 lg:px-12 py-6">
        <nav class="flex justify-between">
            <div class="flex w-full items-center">
                <a href="{{ route('welcome') }}" class="font-bold">
                    Vaccine Registration
                </a>
                <ul class="hidden xl:flex px-4 ml-14 2xl:ml-40 mr-auto">
                    <li class="mr-8 2xl:mr-14">
                        <a href="{{ route('welcome') }}" class="flex items-center font-heading font-medium hover:text-darkBlueGray-400" href="{{ route('dashboard') }}">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                            </svg>                              
                            <span>Search</span>
                        </a>
                    </li>
                    <li class="mr-8 2xl:mr-14">
                        <a href="{{ route('register.candidate.create') }}" class="flex items-center font-heading font-medium hover:text-darkBlueGray-400">
                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-width="2" d="M7 17v1a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1v-1a3 3 0 0 0-3-3h-4a3 3 0 0 0-3 3Zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                              </svg>                                                            
                            <span>Register</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</section