<form id="loginForm" class="space-y-4 m-0">
    <div class="flex">
        <span class="inline-flex items-center px-3 bg-blue-500 border border-r-0 border-gray-300 rounded-l-md">
            <i class="text-white fa-solid fa-user"></i>
        </span>
        <input name="email" type="text" class="rounded-r-lg border block flex-1 min-w-0 w-full text-sm border-gray-300 p-3 focus:outline-blue-600" placeholder="<?= EMAIL ?>">
    </div>
    <div class="flex">
        <span class="inline-flex items-center px-3 bg-blue-500 border border-r-0 border-gray-300 rounded-l-md">
            <i class="text-white fa-solid fa-lock"></i>
        </span>
        <input name="password" type="password" class="rounded-r-lg border block flex-1 min-w-0 w-full text-sm border-gray-300 p-3 focus:outline-blue-600" placeholder="<?= PASSWORD ?>">
    </div>
    <button class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"><?php echo LOGIN; ?></button>
</form>