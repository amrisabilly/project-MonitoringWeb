{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Root') {{-- Menentukan title untuk halaman ini --}}

@section('content')
    <style>
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
    </style>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        {{-- Title --}}
        <p class="title">
            Root
        </p>
    </div>

    <hr>

    {{-- Subtitle --}}
    <p class="subtitle" style="font-size: 18px">
        <strong>Tips</strong> : to see detail information, logs and tracking network double-click on the selected
        device
    </p>

    @if ($device->isNotEmpty())
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
                    <p style="margin: inherit; margin-right: 8px;">Sort</p>
                </div>
            </a>

            {{-- Filter Button --}}
            <a href="#" id="filterButton">
                <div class="secondary-button">
                    <img src="img/icons/filter.png" alt="" width="24px" style="margin-right: 8px;">
                    <p style="margin: inherit; margin-right: 8px;">Filter</p>
                </div>
            </a>

            {{-- Dropdown Filter --}}
            <div id="filterDropdown"
                style="display: none; position: absolute; left: 1380px; top: 190px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
                <label for="statusFilter">Select Status:</label>
                <select id="statusFilter" class="textfield" style="width: 100%; padding: 8px;">
                    <option value="">All</option>
                    <option value="online">Online</option>
                    <option value="offline">Offline</option>
                </select>
            </div>


        </div>

        <p>Show {{ $device->count() }} devices in this folder</p>


        <form action="{{ route('bulkDelete') }}" method="POST" id="bulk-action-form">
            @csrf
            {{-- Item Table --}}
            @include('components.item-table', ['device' => $device])


            {{-- Select All --}}
            <div
                style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
                <div style="display: flex; align-items:center; gap:1em">
                    <img src="img/icons/arrow1.png" width="458px">
                    <input type="checkbox" name="" id="checkAllButton">
                    <p>Check All</p>
                </div>

                <div style="display: flex; align-items:center; gap:1em">
                    <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
                    {{-- Edit --}}
                    <x-edit-device-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="secondary-button"
                        icon="img/icons/edit.png" actions="edit-device" modalIcon='img/icons/exclamation-circle.png'
                        actionButtonClass="primary-button" />
                    {{-- Hapus --}}
                    <x-delete-device-modal modalId="delete" triggerId="delete" triggerText="Delete"
                        title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="danger-button"
                        icon="img/icons/trash-alt.png" actions="#" modalIcon='img/icons/exclamation-circle.png'
                        actionButtonClass="primary-button" />

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
                    <x-modal modalId="addFolder" triggerId="addFolder" triggerText="Add Folder"
                        title="Please Confirm Your Role"
                        content="Please input the password to verify your role to do this action." class="add-folder-button"
                        icon="{{ asset('img/icons/plus.png') }}" actions='add-folder'
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
    @endif

    <script>
        // Bulk Edit dengan form terpisah
        function bulkEdit() {
            const form = document.getElementById('bulk-action-form');
            form.action = "{{ route('bulkEdit') }}";
            form.submit();
        }
    </script>

@endsection
