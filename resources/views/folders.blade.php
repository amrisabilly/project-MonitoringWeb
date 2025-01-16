{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', $folders->nama) {{-- Menentukan title untuk halaman ini --}}

@section('content')
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
            style="display: none; position: absolute; left: 1250px; top: 25px; background-color: white; border: 1px solid #ddd; border-radius: 5px; padding: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1); z-index: 10;">
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 10%;">
                    <x-modal modalId="renameFolder" triggerId="renameFolder" triggerText="Rename" title="Rename Your Folder"
                        content="Make it neat with an easy Folder rename." class="rename-dropdown" icon=""
                        actions="add-device" modalIcon="{{ asset('img/icons/edit.png') }}"
                        actionButtonClass="primary-button" />
                </li>
                <li>
                    <x-delete-folder-modal modalId="delete-folder-modal" triggerId="delete-folder-button"
                        triggerText="Delete Folder" title="Are you sure?" content="Do you want to delete this folder?"
                        class="delete-dropdown" icon="" actions="" actionButtonClass="danger-button"
                        modalIcon="{{ asset('img/icons/trash-alt-red.png') }}"
                        deleteRoute="{{ route('folders.destroy', $folders->ID_folder) }}" />

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

    <p>Show 6 devices in this folder</p>

    {{-- Item Table --}}
    @include('components.item-table', ['device' => $devices])

    {{-- Select All --}}
    <div style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
        <div style="display: flex; align-items:center; gap:1em">
            <img src="{{ asset('img/icons/arrow1.png') }}" width="458px">
            <input type="checkbox" name="" id="checkAllButton">
            <p>Check All</p>
        </div>

        <div style="display: flex; align-items:center; gap:1em">
            <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
            {{-- Edit --}}
            <x-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="secondary-button"
                icon="{{ asset('img/icons/edit.png') }}" actions="edit-device"
                modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
            {{-- Hapus --}}
            <x-modal modalId="delete" triggerId="delete" triggerText="Delete" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="danger-button"
                icon="{{ asset('img/icons/trash-alt.png') }}" actions="#"
                modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
        </div>
    </div>

@endsection
