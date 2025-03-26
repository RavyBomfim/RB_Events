<!-- Meus Eventos - Accordion -->
<div x-data="{ openAccordion: false }">
    <button @click="openAccordion = !openAccordion" class="w-full flex justify-between items-center px-4 py-2 font-medium text-gray-700 bg-gray-100 focus:outline-none">
        {{ $title }}
    </button>

    <div x-show="openAccordion" class="mt-2 space-y-2 ps-4 border-l border-gray-300" x-collapse>
        <div x-show="open" class="mt-2 space-y-2 ps-4 border-l border-gray-300" x-collapse>
            {{ $slot }}
        </div>
    </div>
</div>
