<template>
    <button
        type="button"
        class="w-72 flex items-center text-left space-x-3 px-4 h-12 bg-white ring-1 ring-slate-900/10 hover:ring-slate-300 focus:outline-none focus:ring-2 focus:ring-amber-500 shadow-sm rounded-lg text-slate-400 dark:bg-slate-800 dark:ring-0 dark:text-slate-300 dark:highlight-white/5 dark:hover:bg-slate-700"
    >
        <svg width="24" height="24"
             fill="none"
             stroke="currentColor"
             stroke-linecap="round"
             stroke-linejoin="round"
             stroke-width="2"
             class="flex-none text-slate-300 dark:text-slate-400"
             aria-hidden="true"
        >
            <path d="m19 19-3.5-3.5"></path>
            <circle cx="11" cy="11" r="6"></circle>
        </svg>
        <span class="flex-auto">Quick search...</span>
        <kbd class="font-sans font-semibold dark:text-slate-500 space-x-1">
            <abbr title="Command" class="no-underline text-slate-300 dark:text-slate-500">⌘</abbr>
            <span>K</span>
        </kbd>
    </button>
</template>
