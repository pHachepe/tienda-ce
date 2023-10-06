<form class="px-4 pb-4 bg-white mt-2 text-gray-700 shadow-md rounded-md flex flex-col space-y-2">
    <div class="flex">
        <span class="inline-flex items-center px-3 bg-blue-500 border border-r-0 border-gray-300 rounded-l-md">
            <i class="text-white fa-solid fa-user"></i>
        </span>
        <input type="text" class="rounded-r-lg border block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="<?php echo USER; ?>">
    </div>
    <div class="flex">
        <span class="inline-flex items-center px-3 bg-blue-500 border border-r-0 border-gray-300 rounded-l-md">
            <i class="text-white fa-solid fa-lock"></i>
        </span>
        <input type="password" class="rounded-r-lg border block flex-1 min-w-0 w-full text-sm border-gray-300 p-2.5" placeholder="<?php echo PASSWORD; ?>">
    </div>
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"><?php echo LOGIN; ?></button>
</form>