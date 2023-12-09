@include('partials.__header', ['$title']) {{-- $title is for title about the browser tab --}}

@include('partials.__admin_sidebar')

{{-- right side of sidebar --}}
<div class="md:ml-60 pb-4">

    {{-- reusable page header --}}
    @include('partials.__admin_pageheader')

    {{-- main white containter --}}
    <div class="md:p-4 p-2 md:mx-4 mx-2 shadow-lg bg-white border-gray-200 rounded-lg " style="min-height: 85vh">

        {{-- navigation container --}}
        <div class=" justify-between flex items-center mb-4 rounded  ">
            {{-- breadcrumb nav container --}}
            <nav class="" aria-label="Breadcrumb">
                <ol class=" items-center flex space-x-1">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin_scholarship') }}"
                            class="inline-flex items-center text-sm font-medium md:text-gray-500 text-gray-500 hover:text-blue-600 ">
                            <span class="px-1 material-symbols-rounded" style="font-size:20px">school</span>
                            Scholarship
                        </a>
                    </li>
                    <li aria-current="page" class="hidden md:inline-flex items-center ">
                        <div class="flex items-center">
                            <svg class="md:inline-flex hidden w-3 h-3 text-gray-400 mx-1" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <p class=" text-sm font-medium text-gray-700 hover:text-blue-600 ">
                                {{ $scholarship->name }}
                            </p>
                        </div>
                    </li>
                </ol>
            </nav>

            <div class="flex">
                <!-- Previous Button -->
                <a href=" {{ route('admin_scholarship') }}"
                    class="flex items-center justify-center px-3 h-8  text-sm font-medium text-gray-500 bg-white  rounded-lg hover:bg-gray-100 hover:text-gray-700 ">
                    <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 14 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 5H1m0 0 4 4M1 5l4-4" />
                    </svg>
                    back
                </a>
            </div>
        </div>

        {{-- title + button container --}}
        <div class="flex flex-col items-center justify-center py-2 rounded text-slate-800 ">
            <h2 class=" text-lg font-bold leading-none tracking-tight text-slate-800 md:text-xl ">
                Scholarship Details
            </h2>
        </div>

        {{-- main content --}}
        <div class="block bg--600 flex-row mt-2 mb-4 gap-4 w-full relative">

            <div id="accordion-color" data-accordion="collapse"
                data-active-classes="bg-blue-100 dark:bg-gray-800 text-blue-600 dark:text-white">
                {{-- description --}}
                <h2 id="description-heading">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#description-body" aria-expanded="true"
                        aria-controls="description-body">
                        <span>Description</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="description-body" class="hidden" aria-labelledby="description-heading">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">
                            {{ $scholarship->description }}
                        </p>
                    </div>
                </div>
                {{-- 2 --}}
                <h2 id="accordion-color-heading-2">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-color-body-2" aria-expanded="false"
                        aria-controls="accordion-color-body-2">
                        <span>Is there a Figma file available?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-color-body-2" class="hidden" aria-labelledby="accordion-color-heading-2">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">Flowbite is first conceptualized and designed
                            using the Figma software so everything you see in the library has a design equivalent in our
                            Figma file.</p>
                        <p class="text-gray-500 dark:text-gray-400">Check out the <a href="https://flowbite.com/figma/"
                                class="text-blue-600 dark:text-blue-500 hover:underline">Figma design system</a> based
                            on the utility classes from Tailwind CSS and components from Flowbite.</p>
                    </div>
                </div>
                <h2 id="accordion-color-heading-3">
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-blue-200 dark:focus:ring-blue-800 dark:border-gray-700 dark:text-gray-400 hover:bg-blue-100 dark:hover:bg-gray-800 gap-3"
                        data-accordion-target="#accordion-color-body-3" aria-expanded="false"
                        aria-controls="accordion-color-body-3">
                        <span>What are the differences between Flowbite and Tailwind UI?</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div id="accordion-color-body-3" class="hidden" aria-labelledby="accordion-color-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">The main difference is that the core
                            components from Flowbite are open source under the MIT license, whereas Tailwind UI is a
                            paid product. Another difference is that Flowbite relies on smaller and standalone
                            components, whereas Tailwind UI offers sections of pages.</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400">However, we actually recommend using both
                            Flowbite, Flowbite Pro, and even Tailwind UI as there is no technical reason stopping you
                            from using the best of two worlds.</p>
                        <p class="mb-2 text-gray-500 dark:text-gray-400">Learn more about these technologies:</p>
                        <ul class="ps-5 text-gray-500 list-disc dark:text-gray-400">
                            <li><a href="https://flowbite.com/pro/"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">Flowbite Pro</a></li>
                            <li><a href="https://tailwindui.com/" rel="nofollow"
                                    class="text-blue-600 dark:text-blue-500 hover:underline">Tailwind UI</a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>


<script>
    console.log('hi from console');

    const accordionElement = document.getElementById('accordion-color');
    // create an array of objects with the id, trigger element (eg. button), and the content element
    const accordionItems = [{
            id: 'description-heading',
            triggerEl: document.querySelector('#description-heading'),
            targetEl: document.querySelector('#description-body'),
            active: true
        },
        {
            id: 'accordion-color-heading-2',
            triggerEl: document.querySelector('#accordion-color-heading-2'),
            targetEl: document.querySelector('#accordion-color-body-2'),
            active: false
        },
        {
            id: 'accordion-color-heading-3',
            triggerEl: document.querySelector('#accordion-color-heading-3'),
            targetEl: document.querySelector('#accordion-color-body-3'),
            active: false
        }
    ];

    // options with default values
    const options = {
        alwaysOpen: true,
        activeClasses: 'bg-gray-100 dark:bg-gray-800 text-gray-900 dark:text-white',
        inactiveClasses: 'text-gray-500 dark:text-gray-400',
        onOpen: (item) => {
            console.log('accordion item has been shown');
            console.log(item);
        },
        onClose: (item) => {
            console.log('accordion item has been hidden');
            console.log(item);
        },
        onToggle: (item) => {
            console.log('accordion item has been toggled');
            console.log(item);
        },
    };

    // instance options object
    const instanceOptions = {
        id: 'accordion-color',
        override: true
    };


    import {
        Accordion
    } from 'flowbite';

    /*
     * accordionEl: HTML element (required)
     * accordionItems: array of accordion item objects (required)
     * options (optional)
     * instanceOptions (optional)
     */

    const accordion = new Accordion(accordionElement, accordionItems, options, instanceOptions);

    // open accordion item based on id
    accordion.open('accordion-color-heading-2');

    // close accordion item based on id
    accordion.close('accordion-color-heading-2');

    // toggle visibility of item based on id
    accordion.toggle('accordion-color-heading-3');
</script>


@include('partials.__footer')
