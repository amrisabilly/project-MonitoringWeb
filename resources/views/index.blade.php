<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Root</title>
    <link rel="stylesheet" href="css/root.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Scrollbar styling */
        body::-webkit-scrollbar {
            width: 10px;
        }

        body::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .main-content {
            margin-left: 342px;
            padding: 20px 60px 20px 60px;
        }

        .title {
            font-size: 29.3px;
            font-weight: 600;
            margin-top: 8px;
            margin-bottom: 8px;
        }

        .features {
            display: flex;
            gap: 1em;
        }

        .secondary-button {
            all: unset;
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            cursor: pointer;
        }

        .primary-button {
            all: unset;
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            background-color: #F56E02;
            color: white;
            cursor: pointer;
        }

        .danger-button {
            all: unset;
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            background-color: #CB0B00;
            color: white;
            cursor: pointer;

        }

        /* Search Bar */
        .textfield {
            border: 1px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            background-color: #fff;
        }

        .textfield input {
            border: none;
            outline: none;
            flex: 1;
            padding: 8px;
            font-size: 16px;
        }

        .textfield img {
            width: 24px;
            height: 24px;
            margin-left: 8px;
        }
    </style>
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
            {{-- Option --}}
            <a href="">
                <div class="secondary-button">
                    <img src="img/icons/ellipsis-h.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Options</p>
                </div>
            </a>
        </div>
        <hr>
        {{-- Subtitle --}}
        <p class="subtitle">
            You can see all the devices that connecting to this network by this folder
        </p>
        {{-- Feature --}}
        <div class="features">
            {{-- Search bar --}}
            <div class="textfield" style="flex: 1">
                <input type="text" placeholder="Search Device ..." />
                <img src="img/icons/search-alt.png" alt="Search Icon" />
            </div>

            {{-- Sort --}}
            <a href="">
                <div class="secondary-button">
                    <img src="img/icons/sort-amount-down.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Sort</p>
                </div>
            </a>

            {{-- Filter --}}
            <a href="">
                <div class="secondary-button">
                    <img src="img/icons/filter.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin:inherit; margin-right:8px;">Filter</p>
                </div>
            </a>

            {{-- Add Device --}}
            <x-modal modalId="addDevice" triggerId="addDevice" triggerText="Add Device" title="Modal Title"
                content="This is the modal content." class="primary-button" icon="img/icons/plus.png" />
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
                <x-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Modal Title"
                    content="This is the modal content." class="secondary-button" icon="img/icons/edit.png" />
                {{-- Hapus --}}
                <x-modal modalId="delete" triggerId="delete" triggerText="Delete" title="Modal Title"
                    content="This is the modal content." class="danger-button" icon="img/icons/trash-alt.png" />
            </div>
        </div>

    </div>




    <script>
        const checkAllButton = document.getElementById('checkAllButton');
        const checkBoxes = document.querySelectorAll('.checkBox');

        checkAllButton.addEventListener('click', function() {
            if (checkAllButton.checked) {
                checkBoxes.forEach(function(checkbox) {
                    checkbox.checked = true;
                });
            } else {
                checkBoxes.forEach(function(checkbox) {
                    checkbox.checked = false;
                });
            }
        });
    </script>
</body>

</html>
