<div class="flex gap-2 w-full p-2">
    <div class="w-6/12">
        <div class="px-4 py-3 flex items-center gap-2 bg-gray-50">
            <i class="fas text-xl fa-road" style="color: blue;"></i> 
            <p class="mb-0 text-xs text-black font-bold">Total Slots: {{ $totalSlots }}</p>
        </div>
    </div>

    <div class="w-6/12">
        <div class="px-4 py-3 flex items-center gap-2 bg-gray-50">
            <i class="fas text-xl fa-clock" style="color: lime;"></i> 
            <p class="mb-0 text-xs text-black font-bold">Available Slots: {{ $availableSlots }}</p>
        </div>
    </div>
</div>