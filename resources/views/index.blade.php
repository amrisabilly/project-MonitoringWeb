<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Root</title>
    <link rel="stylesheet" href="css/root.css">
    <link rel="stylesheet" href="css/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
</head>

<body>
    {{-- side nav --}}
    <x-side-nav></x-side-nav>
    {{-- Main Content --}}
    <div class="main-content">
        <div style="display: flex;justify-content:space-between; align-items:center">
            {{-- Title --}}
            <p class="title">
                Root
            </p>
            <!-- Button Options -->
            <a href="#" id="optionsButton">
                <div class="secondary-button">
                    <img src="img/icons/ellipsis-h.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Options</p>
                </div>
            </a>

            <!-- Dropdown Options -->
            <div id="optionsDropdown"
                style="display: none; position: absolute; left:1250px; top:25px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 10%;">
                        <x-modal modalId="renameFolder" triggerId="renameFolder" triggerText="Rename"
                            title="Rename Your Folder" content="Make it neat with an easy Folder rename."
                            class="rename-dropdown" icon="" actions="add-device" modalIcon='img/icons/edit.png'
                            actionButtonClass="primary-button" />
                    </li>
                    <li>
                        <x-modal modalId="deleteFolder" triggerId="deleteFolder" triggerText="Delete"
                            title="Are you sure?" content="Please write “Delete this folder” to confirm your action."
                            class="delete-dropdown" icon="" actions="add-device"
                            modalIcon='img/icons/trash-alt-red.png' actionButtonClass="danger-button" />
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        {{-- Subtitle --}}
        <p class="subtitle">
            <strong>Tips</strong> : to see detail information, logs and tracking network double-click on the selected
            device
        </p>
        {{-- Feature --}}
        <div class="features">
            {{-- Search bar --}}
            <div class="textfield" style="flex: 1">
                <input type="text" placeholder="Search Device ..." />
                <img src="img/icons/search-alt.png" alt="Search Icon" />
            </div>

            {{-- Sort --}}
            <a href="javascript:void(0)" id="sortButton">
                <div class="secondary-button">
                    <img src="img/icons/sort-amount-down.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Sort</p>
                </div>
            </a>


            {{--  Filter Button  --}}
            <a href="#" id="filterButton">
                <div class="secondary-button">
                    <img src="img/icons/filter.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Filter</p>
                </div>
            </a>

            {{-- Dropdown Filter  --}}
            <div id="filterDropdown"
                style="display: none; position: absolute;left:1220px; top: 190px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
                <label for="statusFilter">Select Status:</label>
                <select id="statusFilter" class="textfield" style="width: 100%; padding: 8px;">
                    <option value="">All</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>


            {{-- Add Device --}}
            <x-modal modalId="addDevice" triggerId="addDevice" triggerText="Add Device" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="primary-button"
                icon="img/icons/plus.png" actions="add-device" modalIcon='img/icons/exclamation-circle.png'
                actionButtonClass="primary-button" />
        </div>

        <p>Show 6 devices in this folder</p>

        {{-- Item Table --}}
        <x-item-table />

        {{-- Select All --}}
        <div
            style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
            <div style="display: flex; align-items:center;gap:1em">
                <img src="img/icons/arrow1.png" width="458px">
                <input type="checkbox" name="" id="checkAllButton">
                <p>Check All</p>
            </div>

            <div style="display: flex; align-items:center; gap:1em">
                <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
                {{-- Edit --}}
                <x-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Please Confirm Your Role"
                    content="Please input the password to verify your role to do this action."
                    class="secondary-button" icon="img/icons/edit.png" actions="edit-device"
                    modalIcon='img/icons/exclamation-circle.png' actionButtonClass="primary-button" />
                {{-- Hapus --}}
                <x-modal modalId="delete" triggerId="delete" triggerText="Delete" title="Please Confirm Your Role"
                    content="Please input the password to verify your role to do this action." class="danger-button"
                    icon="img/icons/trash-alt.png" actions="#" modalIcon='img/icons/exclamation-circle.png'
                    actionButtonClass="primary-button" />
            </div>
        </div>

    </div>




    <script src="js/index.js"></script>
</body>

</html>
