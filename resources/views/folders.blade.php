{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', $folders->nama) {{-- Menentukan title untuk halaman ini --}}

@section('content')
    <style>
        li {
            padding-block: 0.5em;
            padding-inline: 0.2em;
        }

        .inverted-primary-button {
            all: unset;
            display: flex;
            align-items: center;
            border-radius: 10px;
            padding: 12px 8px 12px 8px;
            box-shadow: 2px 2px 12px rgba(220, 208, 208, 0.6);
            font-weight: 600;
            background-color: transparent;
            color: #F56E02;
            border: #F56E02 1px solid;
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
    </style>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        {{-- Title --}}
        <p class="title">
            {{ $folders->nama }}
        </p>

        <!-- Button Options -->
        <a href="#" id="optionsButton">
            <div class="secondary-button">
                <img src="{{ asset('img/icons/ellipsis-h.png') }}" alt="" width="24px" style="margin-right: 8px;">
                <p style="margin: inherit; margin-right: 8px;">Options</p>
            </div>
        </a>

        <!-- Dropdown Options -->
        <div id="optionsDropdown"
            style="display: none; position: absolute; left: 1210px; top: 25px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li>
                    <x-rename-folder-modal modalId="renameFolder" triggerId="renameFolder" triggerText="Rename"
                        title="Rename Your Folder" content="Make it neat with an easy Folder rename."
                        class="rename-dropdown" icon="" actions="add-device"
                        modalIcon="{{ asset('img/icons/edit.png') }}" actionButtonClass="primary-button"
                        idFolder='{{ $folders->ID_folder }}' defaultName='{{ $folders->nama }}' />
                </li>
                <li>
                    <x-delete-folder-modal modalId="delete-folder-modal" triggerId="delete-folder-button"
                        triggerText="Delete Folder" title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="delete-dropdown"
                        icon="" actions="" actionButtonClass="primary-button"
                        modalIcon="{{ asset('img/icons/exclamation-circle.png') }}"
                        deleteRoute="{{ route('folders.destroy', $folders->ID_folder) }}" />

                </li>
            </ul>
        </div>
    </div>

    <hr>

    {{-- Subtitle --}}
    <p class="subtitle" , style="font-size: 18px">
        <strong>Tips</strong> : to see detail information, logs and tracking network double-click on the selected
        device
    </p>
    @if ($devices->isNotEmpty())
        {{-- Feature --}}
        <div class="features">
            {{-- Search bar --}}
            <div class="textfield" style="flex: 1">
                <input type="text" id="searchInput" placeholder="Search Device ..." />
                <img src="{{ asset('img/icons/search-alt.png') }}" alt="Search Icon" />
            </div>


            {{-- Sort --}}
            <a href="javascript:void(0)" id="sortButton">
                <div class="secondary-button">
                    <img src="{{ asset('img/icons/sort-amount-down.png') }}" alt="" width="24px"
                        style="margin-right: 8px;">
                    <p style="margin: inherit; margin-right: 8px;">Sort</p>
                </div>
            </a>

            {{-- Filter Button --}}
            <a href="#" id="filterButton">
                <div class="secondary-button">
                    <img src="{{ asset('img/icons/filter.png') }}" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin: inherit; margin-right: 8px;">Filter</p>
                </div>
            </a>

            {{-- Dropdown Filter --}}
            <div id="filterDropdown"
                style="display: none; position: absolute; left: 1220px; top: 190px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
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
                icon="{{ asset('img/icons/plus.png') }}" actions="{{ route('add.device.form', $folders->ID_folder) }}"
                modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
        </div>

        <p>Show {{ $devices->count() }} devices in this folder</p>


        @foreach ($logs as $log)
            @for ($i = 0; $i < count($log); $i++)
                <h1>{{ $log[$i]->device_id }}</h1>
                <h1>{{ $log[$i]->created_at }}</h1>
            @endfor
        @endforeach

        <form action="{{ route('bulkDelete') }}" method="POST" id="bulk-action-form">
            @csrf
            {{-- Item Table --}}
            @include('components.item-table', ['device' => $devices])
            {{-- Select All --}}
            <div
                style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
                <div style="display: flex; align-items:center; gap:1em">
                    <img src="{{ asset('img/icons/arrow1.png') }}" width="458px">
                    <input type="checkbox" name="" id="checkAllButton">
                    <p>Check All</p>
                </div>
                <div style="display: flex; align-items:center; gap:1em">
                    <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
                    {{-- Edit --}}
                    <x-edit-device-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="secondary-button"
                        icon="{{ asset('img/icons/edit.png') }}" actions="edit-device"
                        modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
                    {{-- Hapus --}}
                    <x-delete-device-modal modalId="delete" triggerId="delete" triggerText="Delete"
                        title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="danger-button"
                        icon="{{ asset('img/icons/trash-alt.png') }}" actions="#"
                        modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button"
                        submitFormId="bulk-action-form" />

                </div>
            </div>
        </form>





        {{-- Error handling jika belum ada data diinputkan --}}
    @else
        <div style="width: 100%; display:flex;justify-content:center; margin-block:2.32em">
            <div>
                <center>
                    <img src="{{ asset('img/icons/no-device.png') }}" width="120px">
                    <p style="font-weight:bold;font-size:21.3px;margin:0px">Your Folder is Empty</p>
                    <p style="font-size:15.3px;margin-block:14px">Try adding your first device</p>

                    {{-- Add Device --}}
                    <x-modal modalId="addFirstDevice" triggerId="addFirstDevice" triggerText="Add Device"
                        title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action."
                        class="inverted-primary-button" icon="{{ asset('img/icons/plus2.png') }}"
                        actions="{{ route('add.device.form', $folders->ID_folder) }}"
                        modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
                </center>
            </div>
        </div>

        <p style="font-size:18px;">
            <strong>Professional Tips!</strong> <br>
            1. Click “Add Device” button to start adding your first device <br>
            2. Choose your unique and easy name for your device <br>
            3. Don’t forget to add IP Address and MAC Address <br>
            4. Once you done, click “Add” to adding your new device and start your monitoring
        </p>

        <script>
            // Dropdown Options
            document.addEventListener('DOMContentLoaded', function() {
                const optionsButton = document.getElementById('optionsButton');
                const optionsDropdown = document.getElementById('optionsDropdown');

                optionsButton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const isVisible = optionsDropdown.style.display === 'block';
                    optionsDropdown.style.display = isVisible ? 'none' : 'block';
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(e) {
                    if (!optionsButton.contains(e.target) && !optionsDropdown.contains(e.target)) {
                        optionsDropdown.style.display = 'none';
                    }
                });
            });
        </script>
    @endif

    <script>
        // Bulk Edit dengan form terpisah
        function bulkEdit() {
            const form = document.getElementById('bulk-action-form');
            form.action = "{{ route('bulkEdit') }}";
            form.submit();
        }

        // Fungsi Search
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const tableRows = document.querySelectorAll('.items-row');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const deviceName = row.querySelector('.device-name').textContent.toLowerCase();
                    row.style.display = deviceName.includes(query) ? '' : 'none';
                });
            });
        });
    </script>

@endsection
