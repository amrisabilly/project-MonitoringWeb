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

        .empty-add-folder-button {
            all: unset;
            cursor: pointer;
            margin-top: 2em;
            gap: 0.5em;
            width: 280px;
            height: 49px;
            background-color: transparent;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f56e02;
            border: 1px solid #f56e02;

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
                <input type="text" id="searchInput" placeholder="Search Device ..." />
                <img src="{{ asset('img/icons/search-alt.png') }}" alt="Search Icon" />
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
        <div style="width: 100%; display:flex;justify-content:center; margin-bottom:2.32em; margin-top:108px">
            <div>
                <center>
                    <img src="{{ asset('img/icons/Folder_del.png') }}" width="120px">
                    <p style="font-weight:bold;font-size:21.3px;margin:0px">No devices found</p>
                    <p style="font-size:15.3px;margin-block:14px">Start by adding your first folder, then add your device
                    </p>


                </center>
            </div>
        </div>

        <div style="font-size:16px; opacity:0.4;position:relative;z-index:-1">
            <p style="font-size: 18px "><strong>Professional Tips!</strong></p>
            <p style="margin-block: 0px; text-indent:1em"> 1. Try adding “New Folder” and add your first device.
            </p>
            <p style="margin-block: 0px; text-indent:1em"> 2. If you already created one, then “Add Device” inside of them
            </p>
            <p style="margin-block: 0px; text-indent:1em"> 3. All of your devices will be shown on this page. </p>

        </div>
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
