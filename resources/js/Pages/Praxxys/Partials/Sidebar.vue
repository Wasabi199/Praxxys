<template>
    <div class="flex w-full">
        <notification-area  :messages="$page.props.flash.message" />

        <div class=" z-10  md:z-0" :class="data.isOpen ? 'md:w-1/6' : ''">
            <div v-if="data.isOpen" class="fixed inset-0 md:hidden" :class="{ 'opacity-100': data.isOpen, 'opacity-0': !data.isOpen }"
                @click="data.isOpen = false">
            </div>
            <div class="fixed h-full bg-[#343a40] w-64 shadow-lg top-0 left-0 transition-transform duration-300 ease-in-out transform"
                :class="{ '-translate-x-0': data.isOpen, '-translate-x-full': !data.isOpen }">
                <!-- Sidebar content goes here -->
                <div class="px-5 py-2">
                    <!-- Your sidebar links go here -->
                    <div class="flex gap-2">
                        <img class=" w-[17%]" src="Images/Icons/AdminLTELogo.webp" />
                        <span class="text-gray-300 text-xl my-auto font-extralight">AdminLTE 3</span>
                    </div>
                </div>
                <hr class="border-gray-600">
                <div class="px-2 ">
                    <div class="px-3 flex gap-2  py-4">

                        <img class=" w-[17%] rounded-full" src="Images/Profiles/34.jpg" />
                        <span class="text-gray-300 text-md my-auto font-extralight">Alexander Pierce</span>
                    </div>
                    <hr class="border-gray-600 w-full">
                </div>
                <div class="px-2 py-3 bg-[#343a40] rounded-md flex ">
                    <input placeholder="Search" class=" bg-[#3f474e] h-9 w-full rounded-s-md" type="text" />
                    <button class="border px-2 rounded-e-md bg-[#3f474e]">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="w-5 h-5 text-white">
                            <path fill-rule="evenodd"
                                d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
                <div class="px-2 text-white">
                    <ul>
                        <Link :href="route('dashboard')">
                        <li class="flex gap-2 px-4 py-3 rounded-md"
                            :class="route().current('dashboard') ? 'bg-[#007bff]' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                                <path fill-rule="evenodd"
                                    d="M9.315 7.584C12.195 3.883 16.695 1.5 21.75 1.5a.75.75 0 01.75.75c0 5.056-2.383 9.555-6.084 12.436A6.75 6.75 0 019.75 22.5a.75.75 0 01-.75-.75v-4.131A15.838 15.838 0 016.382 15H2.25a.75.75 0 01-.75-.75 6.75 6.75 0 017.815-6.666zM15 6.75a2.25 2.25 0 100 4.5 2.25 2.25 0 000-4.5z"
                                    clip-rule="evenodd" />
                                <path
                                    d="M5.26 17.242a.75.75 0 10-.897-1.203 5.243 5.243 0 00-2.05 5.022.75.75 0 00.625.627 5.243 5.243 0 005.022-2.051.75.75 0 10-1.202-.897 3.744 3.744 0 01-3.008 1.51c0-1.23.592-2.323 1.51-3.008z" />
                            </svg>
                            <span class="my-auto text-sm ">Dashboard</span>
                        </li>
                        </Link>

                        <Link :href="route('products')">
                        <li class="flex gap-2 px-4 py-3 rounded-md"
                            :class="route().current('products') ? 'bg-[#007bff]' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                            </svg>

                            <span class="my-auto text-sm ">Products</span>
                        </li>
                        </Link>

                        <Link :href="route('create.products')">
                        <li class="flex gap-2 px-4 py-3 rounded-md"
                            :class="route().current('create.products') ? 'bg-[#007bff]' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                            </svg>


                            <span class="my-auto text-sm ">Create Product</span>
                        </li>
                        </Link>

                        <Link :href="route('videoplayer')">
                        <li class="flex gap-2 px-4 py-3 rounded-md"
                            :class="route().current('videoplayer') ? 'bg-[#007bff]' : ''">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 01-1.125-1.125M3.375 19.5h1.5C5.496 19.5 6 18.996 6 18.375m-3.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-1.5A1.125 1.125 0 0118 18.375M20.625 4.5H3.375m17.25 0c.621 0 1.125.504 1.125 1.125M20.625 4.5h-1.5C18.504 4.5 18 5.004 18 5.625m3.75 0v1.5c0 .621-.504 1.125-1.125 1.125M3.375 4.5c-.621 0-1.125.504-1.125 1.125M3.375 4.5h1.5C5.496 4.5 6 5.004 6 5.625m-3.75 0v1.5c0 .621.504 1.125 1.125 1.125m0 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m1.5-3.75C5.496 8.25 6 7.746 6 7.125v-1.5M4.875 8.25C5.496 8.25 6 8.754 6 9.375v1.5m0-5.25v5.25m0-5.25C6 5.004 6.504 4.5 7.125 4.5h9.75c.621 0 1.125.504 1.125 1.125m1.125 2.625h1.5m-1.5 0A1.125 1.125 0 0118 7.125v-1.5m1.125 2.625c-.621 0-1.125.504-1.125 1.125v1.5m2.625-2.625c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125M18 5.625v5.25M7.125 12h9.75m-9.75 0A1.125 1.125 0 016 10.875M7.125 12C6.504 12 6 12.504 6 13.125m0-2.25C6 11.496 5.496 12 4.875 12M18 10.875c0 .621-.504 1.125-1.125 1.125M18 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m-12 5.25v-5.25m0 5.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125m-12 0v-1.5c0-.621-.504-1.125-1.125-1.125M18 18.375v-5.25m0 5.25v-1.5c0-.621.504-1.125 1.125-1.125M18 13.125v1.5c0 .621.504 1.125 1.125 1.125M18 13.125c0-.621.504-1.125 1.125-1.125M6 13.125v1.5c0 .621-.504 1.125-1.125 1.125M6 13.125C6 12.504 5.496 12 4.875 12m-1.5 0h1.5m-1.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M19.125 12h1.5m0 0c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h1.5m14.25 0h1.5" />
                            </svg>



                            <span class="my-auto text-sm ">Video Player</span>
                        </li>
                        </Link>

                        <li @click="logout()" class="flex gap-2 px-4 py-3 rounded-md text-red-500 cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                            </svg>
                            <span class="my-auto text-sm font-semibold">Logout</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div :class="data.isOpen == true ? ' md:w-5/6' : 'w-full'">
            <div v-if="data.search" class="bg-white shadow-sm max-h-14 h-14 border">
                <div class=" py-4 px-4 flex justify-between">
                    <svg @click="sidenav" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                    <div class="flex w-1/2  justify-evenly md:w-1/6">
                        <div>
                            <svg @click="data.search = !data.search" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                            </svg>
                        </div>

                        <!-- Messages -->
                        <Popover class="relative">
                            <PopoverButton>
                                <span class="inline-block cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 01-.825-.242m9.345-8.334a2.126 2.126 0 00-.476-.095 48.64 48.64 0 00-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0011.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                                    </svg>

                                    <span
                                        class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-[10px] font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-md">
                                        {{ 3 }}
                                    </span>
                                </span>
                            </PopoverButton>

                            <PopoverPanel
                                class="absolute z-10 w-[280px] top-[2rem] -right-[1rem] border rounded-md  border-gray-200">
                                <div class="flex flex-col bg-white  shadow-md   ">
                                    <div class="flex py-2">
                                        <div class="w-1/4">
                                            <img class="rounded-full w-8/12 m-auto" src="images/profiles/37.jpg" />
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex justify-between pr-2">
                                                <div>Brad Diesel</div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-[18px] h-[18px] my-auto text-red-600">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class=" text-sm">Call me whenever you can...</p>
                                            <div class="flex gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 my-auto">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-xs text-gray-400">4 Hours Ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="flex py-2">
                                        <div class="w-1/4">
                                            <img class="rounded-full w-8/12 m-auto" src="images/profiles/34.jpg" />
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex justify-between pr-2">
                                                <div>John Pierce</div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-[18px] h-[18px] text-gray-600">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class=" text-sm">I got you message bro</p>
                                            <div class="flex gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 my-auto">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-xs text-gray-400">4 Hours Ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="flex py-2">
                                        <div class="w-1/4">
                                            <img class="rounded-full w-8/12 m-auto" src="images/profiles/29.jpg" />
                                        </div>
                                        <div class="w-3/4">
                                            <div class="flex justify-between pr-2">
                                                <div>Nora Silvester</div>
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="w-[18px] h-[18px] text-yellow-600">
                                                    <path fill-rule="evenodd"
                                                        d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                            <p class=" text-sm">The subject goes here</p>
                                            <div class="flex gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 my-auto">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span class="text-xs text-gray-400">4 Hours Ago</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center text-sm py-2">See All Messages</div>
                                </div>
                            </PopoverPanel>
                        </Popover>


                        <!-- Notification -->
                        <Popover class="relative">
                            <PopoverButton>
                                <span class="inline-block cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                                    </svg>


                                    <span
                                        class="absolute top-0 right-0 inline-flex items-center justify-center px-1 py-1 text-[10px] font-bold leading-none text-black transform translate-x-1/2 -translate-y-1/2 bg-yellow-500 rounded-md">
                                        {{ 15 }}
                                    </span>
                                </span>
                            </PopoverButton>

                            <PopoverPanel
                                class="absolute z-10 w-[280px] top-[2rem] -right-[1rem] border rounded-md  border-gray-200">
                                <div class="flex flex-col bg-white  shadow-md   ">
                                    <div class="text-center py-2 text-sm">15 Notifications</div>
                                    <hr>
                                    <div class="flex py-2 px-4 justify-between">
                                        <div class="flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5">
                                                <path
                                                    d="M1.5 8.67v8.58a3 3 0 003 3h15a3 3 0 003-3V8.67l-8.928 5.493a3 3 0 01-3.144 0L1.5 8.67z" />
                                                <path
                                                    d="M22.5 6.908V6.75a3 3 0 00-3-3h-15a3 3 0 00-3 3v.158l9.714 5.978a1.5 1.5 0 001.572 0L22.5 6.908z" />
                                            </svg>
                                            <span class="text-sm">4 new message</span>
                                        </div>
                                        <div class="text-gray-400 text-sm">3 mns</div>
                                    </div>
                                    <hr>
                                    <div class="flex py-2 px-4 justify-between">
                                        <div class="flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.25 6.75a3.75 3.75 0 117.5 0 3.75 3.75 0 01-7.5 0zM15.75 9.75a3 3 0 116 0 3 3 0 01-6 0zM2.25 9.75a3 3 0 116 0 3 3 0 01-6 0zM6.31 15.117A6.745 6.745 0 0112 12a6.745 6.745 0 016.709 7.498.75.75 0 01-.372.568A12.696 12.696 0 0112 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 01-.372-.568 6.787 6.787 0 011.019-4.38z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M5.082 14.254a8.287 8.287 0 00-1.308 5.135 9.687 9.687 0 01-1.764-.44l-.115-.04a.563.563 0 01-.373-.487l-.01-.121a3.75 3.75 0 013.57-4.047zM20.226 19.389a8.287 8.287 0 00-1.308-5.135 3.75 3.75 0 013.57 4.047l-.01.121a.563.563 0 01-.373.486l-.115.04c-.567.2-1.156.349-1.764.441z" />
                                            </svg>

                                            <span class="text-sm">8 friend request</span>
                                        </div>
                                        <div class="text-gray-400 text-sm">12 hours</div>
                                    </div>
                                    <hr>
                                    <div class="flex py-2 px-4 justify-between">
                                        <div class="flex gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                                class="w-5 h-5">
                                                <path
                                                    d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0016.5 9h-1.875a1.875 1.875 0 01-1.875-1.875V5.25A3.75 3.75 0 009 1.5H5.625z" />
                                                <path
                                                    d="M12.971 1.816A5.23 5.23 0 0114.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 013.434 1.279 9.768 9.768 0 00-6.963-6.963z" />
                                            </svg>


                                            <span class="text-sm">3 new reports</span>
                                        </div>
                                        <div class="text-gray-400 text-sm">2 days</div>
                                    </div>
                                    <hr>
                                    <div class="text-center py-2 text-sm">See All Notifications</div>
                                </div>
                            </PopoverPanel>
                        </Popover>
                    </div>
                </div>
            </div>

            <div v-else class="bg-white shadow-sm max-h-14 h-14 border py-2 px-4">
                <div class="flex bg-gray-400 h-fit rounded-md w-full gap-2">
                    <input class="w-full h-8 rounded-md" type="text" placeholder="Search">
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M10.5 3.75a6.75 6.75 0 100 13.5 6.75 6.75 0 000-13.5zM2.25 10.5a8.25 8.25 0 1114.59 5.28l4.69 4.69a.75.75 0 11-1.06 1.06l-4.69-4.69A8.25 8.25 0 012.25 10.5z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>
                    <button @click="data.search = !data.search">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5">
                            <path fill-rule="evenodd"
                                d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z"
                                clip-rule="evenodd" />
                        </svg>

                    </button>
                </div>
            </div>
            <slot>
                <main />
            </slot>
        </div>
    </div>
</template>
<script setup lang="ts">
import { Popover, PopoverButton, PopoverPanel } from "@headlessui/vue";
import { Link, router } from '@inertiajs/vue3';
import { reactive } from 'vue';
import NotificationArea from '@/Components/NotificationArea.vue';



const data = reactive({
    isOpen: true,
    search: true
})

function sidenav() {
    console.log('clicked');
    data.isOpen = !data.isOpen
}

function logout() {
    router.post('/logout')
}

</script>