<?php

include_once './Classes/tag.php';
include_once './config/config.php';
include_once './Classes/Tickets.php';
include_once './Classes/Users.php';

if (empty($_SESSION["user_id"])) {
    session_destroy();
    header('Location: http://localhost/IlyasChaoui-Ticket-Manager/pages/Authentification.php');
}
$tags = new tag($conn);
$tagData = $tags->getAllTags($conn);

$ticketObj = new Ticket($conn);
$ticketTagData = $ticketObj->getAllArticleTags($conn);
$ticketDetails = $ticketObj->getTicketDetails($conn);
$ticketTag = $ticketObj->getAllTags($conn);


// $ticketId = $ticket->getTicketId($conn, $ticketId);

// $AssignedAgent = $ticket->getAllassignedAgent($conn, 17);
// foreach ($AssignedAgent as $agent) {

$ticketbyid = $ticketObj->getTicketById($conn, $_SESSION["user_id"]);

$user = new Users($conn);
$userData = $user->getAllUsers($conn);
// $userDataId = $user->getUserById($conn);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="icon" type="image/png" href="./src/pictures/avito.png" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>Avito Ticket Manager</title>
</head>

<body class="bg-gray-300 " style="overflow-x: hidden;">

    <!-- sidebar -->
    <div class="sidebar bg-white fixed z-10 h-14" style="margin-left: 230px; width: 85%;">
        <label class="theme-switch">
            <input type="checkbox" class="theme-switch__checkbox">
            <div class="theme-switch__container">
                <div class="theme-switch__clouds"></div>
                <div class="theme-switch__stars-container">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 55" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M135.831 3.00688C135.055 3.85027 134.111 4.29946 133 4.35447C134.111 4.40947 135.055 4.85867 135.831 5.71123C136.607 6.55462 136.996 7.56303 136.996 8.72727C136.996 7.95722 137.172 7.25134 137.525 6.59129C137.886 5.93124 138.372 5.39954 138.98 5.00535C139.598 4.60199 140.268 4.39114 141 4.35447C139.88 4.2903 138.936 3.85027 138.16 3.00688C137.384 2.16348 136.996 1.16425 136.996 0C136.996 1.16425 136.607 2.16348 135.831 3.00688ZM31 23.3545C32.1114 23.2995 33.0551 22.8503 33.8313 22.0069C34.6075 21.1635 34.9956 20.1642 34.9956 19C34.9956 20.1642 35.3837 21.1635 36.1599 22.0069C36.9361 22.8503 37.8798 23.2903 39 23.3545C38.2679 23.3911 37.5976 23.602 36.9802 24.0053C36.3716 24.3995 35.8864 24.9312 35.5248 25.5913C35.172 26.2513 34.9956 26.9572 34.9956 27.7273C34.9956 26.563 34.6075 25.5546 33.8313 24.7112C33.0551 23.8587 32.1114 23.4095 31 23.3545ZM0 36.3545C1.11136 36.2995 2.05513 35.8503 2.83131 35.0069C3.6075 34.1635 3.99559 33.1642 3.99559 32C3.99559 33.1642 4.38368 34.1635 5.15987 35.0069C5.93605 35.8503 6.87982 36.2903 8 36.3545C7.26792 36.3911 6.59757 36.602 5.98015 37.0053C5.37155 37.3995 4.88644 37.9312 4.52481 38.5913C4.172 39.2513 3.99559 39.9572 3.99559 40.7273C3.99559 39.563 3.6075 38.5546 2.83131 37.7112C2.05513 36.8587 1.11136 36.4095 0 36.3545ZM56.8313 24.0069C56.0551 24.8503 55.1114 25.2995 54 25.3545C55.1114 25.4095 56.0551 25.8587 56.8313 26.7112C57.6075 27.5546 57.9956 28.563 57.9956 29.7273C57.9956 28.9572 58.172 28.2513 58.5248 27.5913C58.8864 26.9312 59.3716 26.3995 59.9802 26.0053C60.5976 25.602 61.2679 25.3911 62 25.3545C60.8798 25.2903 59.9361 24.8503 59.1599 24.0069C58.3837 23.1635 57.9956 22.1642 57.9956 21C57.9956 22.1642 57.6075 23.1635 56.8313 24.0069ZM81 25.3545C82.1114 25.2995 83.0551 24.8503 83.8313 24.0069C84.6075 23.1635 84.9956 22.1642 84.9956 21C84.9956 22.1642 85.3837 23.1635 86.1599 24.0069C86.9361 24.8503 87.8798 25.2903 89 25.3545C88.2679 25.3911 87.5976 25.602 86.9802 26.0053C86.3716 26.3995 85.8864 26.9312 85.5248 27.5913C85.172 28.2513 84.9956 28.9572 84.9956 29.7273C84.9956 28.563 84.6075 27.5546 83.8313 26.7112C83.0551 25.8587 82.1114 25.4095 81 25.3545ZM136 36.3545C137.111 36.2995 138.055 35.8503 138.831 35.0069C139.607 34.1635 139.996 33.1642 139.996 32C139.996 33.1642 140.384 34.1635 141.16 35.0069C141.936 35.8503 142.88 36.2903 144 36.3545C143.268 36.3911 142.598 36.602 141.98 37.0053C141.372 37.3995 140.886 37.9312 140.525 38.5913C140.172 39.2513 139.996 39.9572 139.996 40.7273C139.996 39.563 139.607 38.5546 138.831 37.7112C138.055 36.8587 137.111 36.4095 136 36.3545ZM101.831 49.0069C101.055 49.8503 100.111 50.2995 99 50.3545C100.111 50.4095 101.055 50.8587 101.831 51.7112C102.607 52.5546 102.996 53.563 102.996 54.7273C102.996 53.9572 103.172 53.2513 103.525 52.5913C103.886 51.9312 104.372 51.3995 104.98 51.0053C105.598 50.602 106.268 50.3911 107 50.3545C105.88 50.2903 104.936 49.8503 104.16 49.0069C103.384 48.1635 102.996 47.1642 102.996 46C102.996 47.1642 102.607 48.1635 101.831 49.0069Z" fill="currentColor"></path>
                    </svg>
                </div>
                <div class="theme-switch__circle-container">
                    <div class="theme-switch__sun-moon-container">
                        <div class="theme-switch__moon">
                            <div class="theme-switch__spot"></div>
                            <div class="theme-switch__spot"></div>
                            <div class="theme-switch__spot"></div>
                        </div>
                    </div>
                </div>
            </div>
        </label>
    </div>

    <aside class="flex overflow-hidden fixed flex-col w-60 h-full px-4  overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l dark:bg-gray-900 dark:border-gray-700">
        <a href="#" class="mx-auto ">
            <img class="w-auto top-0 h-14 mb-5 z-20" src="./src/pictures/avito_logo-removebg-preview.png" alt="">
        </a>
        <div class="flex flex-col items-center mt-6 -mx-2">
            <img class="object-cover w-24 h-24 mx-2 rounded-full" src="<?= substr($_SESSION["userpicture"], 1); ?>" alt="avatar">
            <h4 class="mx-2 mt-2 font-medium text-gray-800 dark:text-gray-200"><?php echo $_SESSION["username"] ?></h4>
            <p class="mx-2 mt-1 text-sm font-medium text-gray-600 dark:text-gray-400"><?php echo $_SESSION["email"] ?></p>

        </div>
        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav>
                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M19 11H5M19 11C20.1046 11 21 11.8954 21 13V19C21 20.1046 20.1046 21 19 21H5C3.89543 21 3 20.1046 3 19V13C3 11.8954 3.89543 11 5 11M19 11V9C19 7.89543 18.1046 7 17 7M5 11V9C5 7.89543 5.89543 7 7 7M7 7V5C7 3.89543 7.89543 3 9 3H15C16.1046 3 17 3.89543 17 5V7M7 7H17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="dashboard mx-4 font-medium">Dashboard</span>
                </a>

                <!-- <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M16 7C16 9.20914 14.2091 11 12 11C9.79086 11 8 9.20914 8 7C8 4.79086 9.79086 3 12 3C14.2091 3 16 4.79086 16 7Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M12 14C8.13401 14 5 17.134 5 21H19C19 17.134 15.866 14 12 14Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="ProfileBtn mx-4 font-medium">Accounts</span>
                </a> -->

                <a class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="#">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 5V7M15 11V13M15 17V19M5 5C3.89543 5 3 5.89543 3 7V10C4.10457 10 5 10.8954 5 12C5 13.1046 4.10457 14 3 14V17C3 18.1046 3.89543 19 5 19H19C20.1046 19 21 18.1046 21 17V14C19.8954 14 19 13.1046 19 12C19 10.8954 19.8954 10 21 10V7C21 5.89543 20.1046 5 19 5H5Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>

                    <span class="TicketBtn mx-4 font-medium">My Tickets</span>
                </a>


                <a class="flex items-center px-4 py-2 mt-32 text-gray-600 transition-colors duration-300 transform rounded-lg dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 dark:hover:text-gray-200 hover:text-gray-700" href="./includes/logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                        <polyline points="16 17 21 12 16 7"></polyline>
                        <line x1="21" y1="12" x2="9" y2="12"></line>
                    </svg>

                    <span class="mx-4 font-medium">Logout</span>
                </a>
            </nav>
        </div>
    </aside>





    <!-- container -->
    <main>
        <div class="tickets">
            <section class=" px-5 py-2.5 relative left-72 mt-16 rounded font-medium text-white inline-block ">
                <a class="button js-add">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper mr-4">
                            <svg height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#090fbe">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g id="plus_x5F_alt">
                                            <path style="fill:#ffffff;" d="M16,0C7.164,0,0,7.164,0,16s7.164,16,16,16s16-7.164,16-16S24.836,0,16,0z M24,18h-6v6h-4v-6H8v-4 h6V8h4v6h6V18z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <span>New Ticket</span>
                </a>
            </section>

            <section class="relative flex justify-center ml-28 align-middle container p-6 font-mono">
                <div class="mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Subject</th>
                                    <th class="px-4 py-3">Agent</th>
                                    <th class="px-4 py-3">Tags</th>
                                    <th class="px-4 py-3 ">Priority</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Date</th>

                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php
                                foreach ($ticketDetails as $ticket) : // echo $ticket['subject']
                                    $AssignedAgent = $ticketObj->getAllassignedAgent($conn, $ticket["ticket_id"]);
                                ?>

                                    <tr class="cursor-pointer hover:bg-gray-200 text-gray-700">
                                        <td class="px-4 py-3 w-64 border">
                                            <div class="flex items-center text-sm">
                                                <?php
                                                $userId = $ticket["user_id"];
                                                $user = array_filter($userData, function ($user) use ($userId) {
                                                    return $user["user_id"] == $userId;
                                                });

                                                // Assuming user_id is unique and will have only one match
                                                $user = reset($user);

                                                if ($user) {
                                                ?>
                                                    <div class="relative w-12 h-12 mr-3 rounded-full">
                                                        <img src="<?php echo substr($user["userpicture"], 1); ?>" alt="">
                                                        <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                                                    </div>
                                                    <div>
                                                        <p class="font-semibold"><?= $user["username"]; ?></p>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </td>


                                        <td class="px-4 py-3 w-72 border text-md font-semibold"><?= $ticket["subject"] ?>
                                        </td>
                                        <td class="px-4 py-3 flex flex-row border text-xs">
                                            <?php
                                            // Assuming $ticket is the current ticket in the loop
                                                    
                                            foreach ($AssignedAgent as $agent) {
                                            ?>
                                                <div class="flex flex-row items-center w-20 -space-x-2">
                                                    <img alt="Assigned Agent" src="<?= substr($agent["userpicture"], 1); ?>" class="relative inline-block h-12 w-12 rounded-full border-2 border-white object-cover object-center hover:z-10 focus:z-10" />
                                                </div>
                                            <?php } ?>
                                        </td>

                                        <td class="px-4 py-3 border text-xs">
                                            <?php foreach ($ticketTag as $tag) {
                                                if ($tag["ticket_id"] == $ticket["ticket_id"]) {
                                            ?>
                                                    <div class="flex flex-col">
                                                        <span class="px-2 py-1 mt-2 font-semibold leading-tight text-purple-700 bg-green-100 rounded-sm">
                                                            <?= $tag["tag"] ?>
                                                        </span>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </td>

                                        <td class="px-4 py-3  border text-xs">

                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 rounded-sm">
                                                <?= $ticket["priority"] ?> </span>
                                        </td>
                                        <td class="px-4 py-3 border text-xs">

                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                                <?= $ticket["status"] ?> </span>
                                        </td>

                                        <td class="px-4 py-3 border text-sm"><?= $ticket["date"] ?></td>


                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        <form id="addTicketForm" class="add-ticket-form" action="./includes/AddArticle.php" method="post">
            <div class="hidden add-ticket min-h-screen flex flex-col sm:py-20 ml-52">
                <div class="relative py-3 sm:max-w-xl sm:mx-auto">
                    <div class="relative px-4 py-10 bg-white mx-8 md:mx-0 shadow rounded-3xl sm:p-10">
                        <div class="max-w-md mx-auto">
                            <div class="flex items-center space-x-5">
                                <div class="h-14 w-14 bg-purple-700 rounded-full flex flex-shrink-0 justify-center items-center text-white text-2xl font-mono">
                                    <img src="./1002-1696615923.jpg" class="rounded-full" alt="">
                                </div>
                                <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                                    <h2 class="leading-relaxed">Create a Ticket</h2>
                                    <p class="text-sm text-gray-500 font-normal leading-relaxed">Lorem ipsum, dolor sit amet
                                        consectetur
                                        adipisicing elit.</p>
                                </div>
                            </div>
                            <div class="divide-y  divide-gray-200">
                                <div class="inputGroup">
                                    <input autocomplete="off" required="" name="subject" type="text">
                                    <label for="name">Subject</label>
                                </div>
                            </div>
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Assignment
                            </label>
                            <select x-data="select" name="username[]" class="relative w-full" @click.outside="open = false" multiple>
                                <button @click="toggle" :class="(open) && 'ring-blue-600'" class="flex w-full items-center rounded-xl justify-between rounded bg-white p-2 ring-1 ring-gray-300">
                                    <span x-text="(language == '') ? 'Unassigned' : language"></span>
                                    <i class="fas fa-chevron-down text-xl"></i>
                                </button>

                                <ul class="z-2 absolute mt-1 w-full z-10 rounded-2xl bg-white ring-1 ring-gray-300" x-show="open">
                                    <?php foreach ($userData as $user) { ?>
                                        <option value="<?= $user["user_id"] ?>" class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Python')">
                                            <?= $user["username"] ?></option>
                                    <?php } ?>
                                </ul>
                            </select>
                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Tag
                            </label>
                            <select x-data="select" name="tag[]" class="relative w-full" @click.outside="open = false" multiple>
                                <button @click="toggle" :class="(open) && 'ring-blue-600'" class="flex w-full items-center rounded-xl justify-between rounded bg-white p-2 ring-1 ring-gray-300">
                                    <span x-text="(language == '') ? 'Unassigned' : language"></span>
                                    <i class="fas fa-chevron-down text-xl"></i>
                                </button>

                                <ul class="z-2 absolute mt-1 w-full z-10 rounded-2xl bg-white ring-1 ring-gray-300" x-show="open">
                                    <?php foreach ($tagData as $tag) { ?>
                                        <option value="<?= $tag["tag_id"] ?>" class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Python')">
                                            <?= $tag["tag"] ?></option>
                                    <?php } ?>
                                </ul>
                            </select>

                            <!-- component -->
                            <!-- This is an example component -->
                            <!-- <div>
                                <script type="module" src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
                                <script nomodule src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine-ie11.min.js" defer></script>

                                <style>
                                    [x-cloak] {
                                        display: none;
                                    }
                                </style>
                                <select x-cloak id="select" name="tag[]" class="relative w-full" @click.outside="open = false" multiple>
                                    <button @click="toggle" :class="(open) && 'ring-blue-600'" class="flex w-full items-center rounded-xl justify-between rounded bg-white p-2 ring-1 ring-gray-300">
                                        <span x-text="(language == '') ? 'Unassigned' : language"></span>
                                        <i class="fas fa-chevron-down text-xl"></i>
                                    </button>

                                    <ul class="z-2 absolute mt-1 w-full z-10 rounded-2xl bg-white ring-1 ring-gray-300" x-show="open">
                                        <?php foreach ($tagData as $tag) { ?>
                                            <option value="<?= $tag["tag_id"] ?>" class="cursor-pointer select-none p-2 hover:bg-gray-200" @click="setLanguage('Python')">
                                                <?= $tag["tag"] ?></option>
                                        <?php } ?>
                                    </ul>
                                </select>

                                <div x-data="dropdown()" x-init="loadOptions()" class="w-full md:w-1/2 flex flex-col items-center h-64 mx-auto">
                                    <form>
                                        <input name="values" type="hidden" x-bind:value="selectedValues()">
                                        <div class="inline-block relative w-64">
                                            <div class="flex flex-col items-center relative">
                                                <div x-on:click="open" class="w-full  svelte-1l8159u">
                                                    <div class="my-2 p-1 flex border border-gray-200 bg-white rounded svelte-1l8159u">
                                                        <div class="flex flex-auto flex-wrap">
                                                            <template x-for="(option,index) in selected" :key="options[option].value">
                                                                <div class="flex justify-center items-center m-1 font-medium py-1 px-2 bg-white rounded-full text-teal-700 bg-teal-100 border border-teal-300 ">
                                                                    <div class="text-xs font-normal leading-none max-w-full flex-initial x-model=" options[option]" x-text="options[option].text"></div>
                                                                    <div class="flex flex-auto flex-row-reverse">
                                                                        <div x-on:click="remove(index,option)">
                                                                            <svg class="fill-current h-6 w-6 " role="button" viewBox="0 0 20 20">
                                                                                <path d="M14.348,14.849c-0.469,0.469-1.229,0.469-1.697,0L10,11.819l-2.651,3.029c-0.469,0.469-1.229,0.469-1.697,0
                                                                       c-0.469-0.469-0.469-1.229,0-1.697l2.758-3.15L5.651,6.849c-0.469-0.469-0.469-1.228,0-1.697s1.228-0.469,1.697,0L10,8.183
                                                                       l2.651-3.031c0.469-0.469,1.228-0.469,1.697,0s0.469,1.229,0,1.697l-2.758,3.152l2.758,3.15
                                                                       C14.817,13.62,14.817,14.38,14.348,14.849z" />
                                                                            </svg>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                            <div x-show="selected.length    == 0" class="flex-1">
                                                                <input placeholder="Select a option" class="bg-transparent p-1 px-2 appearance-none outline-none h-full w-full text-gray-800" x-bind:value="selectedValues()">
                                                            </div>
                                                        </div>
                                                        <div class="text-gray-300 w-8 py-1 pl-2 pr-1 border-l flex items-center border-gray-200 svelte-1l8159u">

                                                            <button type="button" x-show="isOpen() === true" x-on:click="open" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                <svg version="1.1" class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                    <path d="M17.418,6.109c0.272-0.268,0.709-0.268,0.979,0s0.271,0.701,0,0.969l-7.908,7.83
                            	c-0.27,0.268-0.707,0.268-0.979,0l-7.908-7.83c-0.27-0.268-0.27-0.701,0-0.969c0.271-0.268,0.709-0.268,0.979,0L10,13.25
                            	L17.418,6.109z" />
                                                                </svg>

                                                            </button>
                                                            <button type="button" x-show="isOpen() === false" @click="close" class="cursor-pointer w-6 h-6 text-gray-600 outline-none focus:outline-none">
                                                                <svg class="fill-current h-4 w-4" viewBox="0 0 20 20">
                                                                    <path d="M2.582,13.891c-0.272,0.268-0.709,0.268-0.979,0s-0.271-0.701,0-0.969l7.908-7.83
                            	c0.27-0.268,0.707-0.268,0.979,0l7.908,7.83c0.27,0.268,0.27,0.701,0,0.969c-0.271,0.268-0.709,0.268-0.978,0L10,6.75L2.582,13.891z
                            	" />
                                                                </svg>

                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="w-full px-4">
                                                    <div x-show.transition.origin.top="isOpen()" class="absolute shadow top-100 bg-white z-40 w-full lef-0 rounded max-h-select overflow-y-auto svelte-5uyqqj" x-on:click.away="close">
                                                        <div class="flex flex-col w-full">
                                                            <template x-for="(option,index) in options" :key="option">
                                                                <div>
                                                                    <div class="cursor-pointer w-full border-gray-100 rounded-t border-b hover:bg-teal-100" @click="select(index,$event)">
                                                                        <div x-bind:class="option.selected ? 'border-teal-600' : ''" class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative">
                                                                            <div class="w-full items-center flex">
                                                                                <div class="mx-2 leading-6" x-model="option" x-text="option.text">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </template>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                             on tailwind components page will no work  
                                            <button disabled class="flex-shrink-0 bg-teal-500 hover:bg-teal-700 border-teal-500 hover:border-teal-700 text-sm border-4 text-white py-1 px-2 rounded" type="submit">Test</button>
                                    </form>
                                </div>


                                <script>
                                    function dropdown() {
                                        return {
                                            options: [],
                                            selected: [],
                                            show: false,
                                            open() {
                                                this.show = true
                                            },
                                            close() {
                                                this.show = false
                                            },
                                            isOpen() {
                                                return this.show === true
                                            },
                                            select(index, event) {

                                                if (!this.options[index].selected) {

                                                    this.options[index].selected = true;
                                                    this.options[index].element = event.target;
                                                    this.selected.push(index);

                                                } else {
                                                    this.selected.splice(this.selected.lastIndexOf(index), 1);
                                                    this.options[index].selected = false
                                                }
                                            },
                                            remove(index, option) {
                                                this.options[option].selected = false;
                                                this.selected.splice(index, 1);


                                            },
                                            loadOptions() {
                                                const options = document.getElementById('select').options;
                                                for (let i = 0; i < options.length; i++) {
                                                    this.options.push({
                                                        value: options[i].value,
                                                        text: options[i].innerText,
                                                        selected: options[i].getAttribute('selected') != null ? options[i].getAttribute('selected') : false
                                                    });
                                                }


                                            },
                                            selectedValues() {
                                                return this.selected.map((option) => {
                                                    return this.options[option].value;
                                                })
                                            }
                                        }
                                    }
                                </script>
                            </div> -->

                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Priority
                            </label>
                            <div class="flex-col justify-center container mx-auto mt-3">
                                <div class="grid grid-cols-4 gap-3">
                                    <div>
                                        <input type="radio" id="done" name="priority" value="Low" class="form-radio text-yellow-500">
                                        <label for="done" class="ml-2 text-gray-700">Low</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="doing" name="priority" value="Medium" class="form-radio text-green-500">
                                        <label for="doing" class="ml-2 text-gray-700">Medium</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="todo" name="priority" value="High" class="form-radio text-blue-500">
                                        <label for="todo" class="ml-2 text-gray-700">High</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="todo" name="priority" value="Urgent" class="form-radio text-blue-500">
                                        <label for="todo" class="ml-2 text-gray-700">Urgent</label>
                                    </div>



                                </div>
                            </div>

                            <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2">
                                Status
                            </label>
                            <div class="flex-col justify-center container mx-auto mt-3">
                                <div class="grid grid-cols-4 gap-3">
                                    <div>
                                        <input type="radio" id="done" name="status" value="To do" class="form-radio text-yellow-500">
                                        <label for="done" class="ml-2 text-gray-700">To do</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="doing" name="status" value="Doing" class="form-radio text-green-500">
                                        <label for="doing" class="ml-2 text-gray-700">Doing</label>
                                    </div>
                                    <div>
                                        <input type="radio" id="todo" name="status" value="Done" class="form-radio text-blue-500">
                                        <label for="todo" class="ml-2 text-gray-700">Done</label>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="inputGroup2 mt-5">
                            <input autocomplete="off" name="description" required="" type="text">
                            <label for="name">Description</label>
                        </div>

                        <div class="btn-conteiner mt-10">
                            <button type="submit" name="submit" class="btn-content">
                                <span class="btn-title">Save</span>
                                <span class="icon-arrow">
                                    <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <g id="arrow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <path id="arrow-icon-one" d="M40.1543933,3.89485454 L43.9763149,0.139296592 C44.1708311,-0.0518420739 44.4826329,-0.0518571125 44.6771675,0.139262789 L65.6916134,20.7848311 C66.0855801,21.1718824 66.0911863,21.8050225 65.704135,22.1989893 C65.7000188,22.2031791 65.6958657,22.2073326 65.6916762,22.2114492 L44.677098,42.8607841 C44.4825957,43.0519059 44.1708242,43.0519358 43.9762853,42.8608513 L40.1545186,39.1069479 C39.9575152,38.9134427 39.9546793,38.5968729 40.1481845,38.3998695 C40.1502893,38.3977268 40.1524132,38.395603 40.1545562,38.3934985 L56.9937789,21.8567812 C57.1908028,21.6632968 57.193672,21.3467273 57.0001876,21.1497035 C56.9980647,21.1475418 56.9959223,21.1453995 56.9937605,21.1432767 L40.1545208,4.60825197 C39.9574869,4.41477773 39.9546013,4.09820839 40.1480756,3.90117456 C40.1501626,3.89904911 40.1522686,3.89694235 40.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                            <path id="arrow-icon-two" d="M20.1543933,3.89485454 L23.9763149,0.139296592 C24.1708311,-0.0518420739 24.4826329,-0.0518571125 24.6771675,0.139262789 L45.6916134,20.7848311 C46.0855801,21.1718824 46.0911863,21.8050225 45.704135,22.1989893 C45.7000188,22.2031791 45.6958657,22.2073326 45.6916762,22.2114492 L24.677098,42.8607841 C24.4825957,43.0519059 24.1708242,43.0519358 23.9762853,42.8608513 L20.1545186,39.1069479 C19.9575152,38.9134427 19.9546793,38.5968729 20.1481845,38.3998695 C20.1502893,38.3977268 20.1524132,38.395603 20.1545562,38.3934985 L36.9937789,21.8567812 C37.1908028,21.6632968 37.193672,21.3467273 37.0001876,21.1497035 C36.9980647,21.1475418 36.9959223,21.1453995 36.9937605,21.1432767 L20.1545208,4.60825197 C19.9574869,4.41477773 19.9546013,4.09820839 20.1480756,3.90117456 C20.1501626,3.89904911 20.1522686,3.89694235 20.1543933,3.89485454 Z" fill="#FFFFFF"></path>
                                            <path id="arrow-icon-three" d="M0.154393339,3.89485454 L3.97631488,0.139296592 C4.17083111,-0.0518420739 4.48263286,-0.0518571125 4.67716753,0.139262789 L25.6916134,20.7848311 C26.0855801,21.1718824 26.0911863,21.8050225 25.704135,22.1989893 C25.7000188,22.2031791 25.6958657,22.2073326 25.6916762,22.2114492 L4.67709797,42.8607841 C4.48259567,43.0519059 4.17082418,43.0519358 3.97628526,42.8608513 L0.154518591,39.1069479 C-0.0424848215,38.9134427 -0.0453206733,38.5968729 0.148184538,38.3998695 C0.150289256,38.3977268 0.152413239,38.395603 0.154556228,38.3934985 L16.9937789,21.8567812 C17.1908028,21.6632968 17.193672,21.3467273 17.0001876,21.1497035 C16.9980647,21.1475418 16.9959223,21.1453995 16.9937605,21.1432767 L0.15452076,4.60825197 C-0.0425130651,4.41477773 -0.0453986756,4.09820839 0.148075568,3.90117456 C0.150162624,3.89904911 0.152268631,3.89694235 0.154393339,3.89485454 Z" fill="#FFFFFF"></path>
                                        </g>
                                    </svg>
                                </span>
                            </button>
                        </div>


                        <!-- component -->
                        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
                        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
                    </div>
                </div>
            </div>
        </form>
        <!-- profile -->
        <!-- <section class="Profile card hidden pt-16 ml-52 bg-transparent">

        </section> -->

        <!-- Card-->
        <section class="Profile hidden">
            <article class=" mb-4 top-28 relative break-inside rounded-xl bg-white dark:bg-slate-800 flex flex-col bg-clip-border" style="width: 900px; margin-left: 400px;">
                <div class="flex p-6 items-center justify-between">
                    <div class="flex">
                        <a class="inline-block mr-4" href="#">
                            <img class="rounded-full max-w-none w-14 h-14" src="https://randomuser.me/api/portraits/women/47.jpg" />
                        </a>
                        <div class="flex flex-col">
                            <div class="flex items-center">
                                <a class="inline-block text-lg font-bold mr-2" href="#">Annette Black</a>
                                <span class="text-slate-500 dark:text-slate-300">3 minutes ago</span>
                            </div>
                            <div class="text-slate-500 dark:text-slate-300">
                                Medical Assistant
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-6 bg-violet-500">
                    <h2 class="text-3xl font-extrabold text-white">
                        Web Design templates Selection
                    </h2>
                </div>
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <a class="inline-flex items-center" href="#">
                            <span class="-m-1 rounded-full border-2 border-white dark:border-slate-800">
                                <img class="w-6" src="https://cdn.iconscout.com/icon/free/png-256/like-2387659-1991059.png" />
                            </span>
                            <span class="-m-1 rounded-full border-2 border-white dark:border-slate-800">
                                <img class="w-6" src="https://cdn.iconscout.com/icon/free/png-256/love-2387666-1991064.png" />
                            </span>
                            <span class="-m-1 rounded-full border-2 border-white dark:border-slate-800">
                                <img class="w-6" src="https://cdn.iconscout.com/icon/free/png-256/haha-2387660-1991060.png" />
                            </span>
                            <span class="text-lg font-bold ml-3">237</span>
                        </a>
                        <a class="ml-auto" href="#">23 comentarios</a>
                    </div>
                    <div class="mt-6 mb-6 h-px bg-slate-200"></div>
                    <div class="flex items-center justify-between mb-6">
                        <button class="py-2 px-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                            Me gusta
                        </button>
                        <button class="py-2 px-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                            Comentar
                        </button>
                        <button class="py-2 px-4 font-medium hover:bg-slate-50 dark:hover:bg-slate-700 rounded-lg">
                            Compartir
                        </button>
                    </div>
                    <div class="relative">
                        <input class="pt-2 pb-2 pl-3 w-full h-11 bg-slate-100 dark:bg-slate-600 rounded-lg placeholder:text-slate-600 dark:placeholder:text-slate-300 font-medium pr-20" type="text" placeholder="Write a comment" />
                        <span class="flex absolute right-3 top-2/4 -mt-3 items-center">
                            <svg class="mr-2" style="width: 26px; height: 26px;" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12M22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2A10,10 0 0,1 22,12M10,9.5C10,10.3 9.3,11 8.5,11C7.7,11 7,10.3 7,9.5C7,8.7 7.7,8 8.5,8C9.3,8 10,8.7 10,9.5M17,9.5C17,10.3 16.3,11 15.5,11C14.7,11 14,10.3 14,9.5C14,8.7 14.7,8 15.5,8C16.3,8 17,8.7 17,9.5M12,17.23C10.25,17.23 8.71,16.5 7.81,15.42L9.23,14C9.68,14.72 10.75,15.23 12,15.23C13.25,15.23 14.32,14.72 14.77,14L16.19,15.42C15.29,16.5 13.75,17.23 12,17.23Z">
                                </path>
                            </svg>
                            <svg class="fill-blue-500 dark:fill-slate-50" style="width: 24px; height: 24px;" viewBox="0 0 24 24">
                                <path d="M2,21L23,12L2,3V10L17,12L2,14V21Z"></path>
                            </svg>
                        </span>
                    </div>
                </div>
            </article>
            <!-- End Card -->
            <!-- component -->
            <!-- Tailwindcss V3 Script because here v3 is not supported -->
            <script src="https://cdn.tailwindcss.com/"></script>
            <!-- <div class="flex justify-center items-center w-full min-h-screen bg-transparent">
                <div>
                    <div class="flex justify-between">
                        <div class="mb-4">
                            <span class="bg-[#F3F4F6] rounded-md font-semibold cursor-pointer p-2">Write</span>
                            <span class="bg-transparent font-semibold text-[#7E8490] cursor-pointer p-2">Preview</span>
                        </div>
                        <div class="flex gap-3 text-[#9CA3AF]">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                    </div>
                    <textarea placeholder="Add your comment..." class="p-2 focus:outline-1 focus:outline-blue-500 font-bold border-[0.1px] resize-none h-[120px] border-[#9EA5B1] rounded-md w-[60vw]"></textarea>
                    <div class="flex justify-end">
                        <button class="text-sm font-semibold absolute bg-[#4F46E5] w-fit text-white py-2 rounded px-3">Post</button>
                    </div>
                </div>
            </div> -->
        </section>

        <!-- mytickets -->
        <div class="Mytickets hidden tickets">
            <section class=" px-5 py-2.5 relative left-72 mt-16 rounded font-medium text-white inline-block ">
                <a class="button js-add">
                    <div class="svg-wrapper-1">
                        <div class="svg-wrapper mr-4">
                            <svg height="25px" width="25px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#090fbe">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g id="plus_x5F_alt">
                                            <path style="fill:#ffffff;" d="M16,0C7.164,0,0,7.164,0,16s7.164,16,16,16s16-7.164,16-16S24.836,0,16,0z M24,18h-6v6h-4v-6H8v-4 h6V8h4v6h6V18z">
                                            </path>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <span>New Ticket</span>
                </a>
            </section>

            <section class="relative flex justify-center ml-28 align-middle container p-6 font-mono">
                <div class="mb-8 overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                                    <th class="px-4 py-3">Subject</th>
                                    <th class="px-4 py-3">Agent</th>
                                    <th class="px-4 py-3">Tags</th>
                                    <th class="px-4 py-3 ">Priority</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3">Date</th>
                                    <th class="px-4 py-3">Operator</th>


                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                <?php foreach ($ticketbyid as $ticketIdData) {
                                    $AssignedAgent = $ticketObj->getAllassignedAgent($conn, $ticketIdData["ticket_id"]);
                                ?>

                                    <tr data-href="./decription.html" class="cursor-pointer hover:bg-gray-200 text-gray-700">
                                        <td class="px-4 py-3 w-72 border text-md font-semibold"><?= $ticketIdData["subject"] ?>
                                        </td>
                                        <td class="px-4 py-3 flex flex-row border text-xs">
                                            <?php
                                            // Assuming $ticket is the current ticket in the loop

                                            foreach ($AssignedAgent as $agent) {

                                            ?>
                                                <div class="flex flex-row items-center w-20 -space-x-4">
                                                    <img alt="Assigned Agent" src="<?= substr($agent["userpicture"], 1); ?>" class="relative inline-block h-12 w-12 rounded-full border-2 border-white object-cover object-center hover:z-10 focus:z-10" />
                                                </div>
                                            <?php } ?>

                                        </td>
                                        <td class="px-4 py-3 border text-xs">
                                            <?php foreach ($ticketTag as $tag) {
                                                if ($tag["ticket_id"] == $ticketIdData["ticket_id"]) {
                                            ?>
                                                    <div class="flex flex-col">
                                                        <span class="px-2 py-1 mt-2 font-semibold leading-tight text-purple-700 bg-green-100 rounded-sm">
                                                            <?= $tag["tag"] ?>
                                                        </span>
                                                    </div>
                                            <?php }
                                            } ?>
                                        </td>
                                        <td class="px-4 py-3 border text-xs">

                                            <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full">
                                                <?= $ticketIdData["priority"] ?> </span>
                                        </td>
                                        <td class="px-4 py-3 border text-xs">

                                            <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full">
                                                <?= $ticketIdData["status"] ?> </span>
                                        </td>

                                        <td class="px-4 py-3 border text-sm"><?= $ticketIdData["date"] ?></td>
                                        <td class="px-4 py-3 border text-sm">
                                            <!-- <button class="Btn">Edit
                                                <svg class="svg" viewBox="0 0 512 512">
                                                    <path d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z">
                                                    </path>
                                                </svg>
                                            </button> -->

                                            <form action="./includes/deleteTraitement.php?ticket_id=<?= $ticketDetails[0]['ticket_id'] ?>" method="post">
                                                <button type="submit" name="submit" class="Btn1 ml-5" style="background-color: red;">Delete
                                                    <svg class="svg1" viewBox="0 0 512 512">
                                                        <path d="M135.2 17.7L128 32H32C14.3 32 0 46.3 0 64S14.3 96 32 96H416c17.7 0 32-14.3 32-32s-14.3-32-32-32H320l-7.2-14.3C307.4 6.8 296.3 0 284.2 0H163.8c-12.1 0-23.2 6.8-28.6 17.7zM416 128H32L53.2 467c1.6 25.3 22.6 45 47.9 45H346.9c25.3 0 46.3-19.7 47.9-45L416 128z">
                                                        </path>
                                                    </svg>
                                                </button>
                                            </form>
                    </div>

                    </td>

                    </tr>
                <?php } ?>
                </tbody>
                </table>
                </div>
        </div>
        </section>

        </div>
    </main>
    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("select", () => ({
                open: false,
                language: "",

                toggle() {
                    this.open = !this.open;
                },

                setLanguage(val) {
                    this.language = val;
                    this.open = false;
                },
            }));
        });
    </script>
    
    <script src="./src/js/main.js"></script>
</body>

</html>