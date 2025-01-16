{{-- resources/views/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Root') {{-- Menentukan title untuk halaman ini --}}

@section('content')

    <div style="display: flex; justify-content: space-between; align-items: center;">
        {{-- Title --}}
        <p class="title">
            Root
        </p>
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

    <p>Show 6 devices in this folder</p>

    {{-- Item Table --}}
    @include('components.item-table', ['device' => $device])


    {{-- Select All --}}
    <div style="display: flex; align-items:center; width:97%; justify-content:space-between; padding: 0px 20px 0px 20px;">
        <div style="display: flex; align-items:center; gap:1em">
            <img src="img/icons/arrow1.png" width="458px">
            <input type="checkbox" name="" id="checkAllButton">
            <p>Check All</p>
        </div>

        <div style="display: flex; align-items:center; gap:1em">
            <p style="color: rgba(0, 0, 0, 0.396); font-style:italic">With selected action</p>
            {{-- Edit --}}
            <x-modal modalId="edit" triggerId="edit" triggerText="Edit" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="secondary-button"
                icon="img/icons/edit.png" actions="edit-device" modalIcon='img/icons/exclamation-circle.png'
                actionButtonClass="primary-button" />
            {{-- Hapus --}}
            <x-modal modalId="delete" triggerId="delete" triggerText="Delete" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="danger-button"
                icon="img/icons/trash-alt.png" actions="#" modalIcon='img/icons/exclamation-circle.png'
                actionButtonClass="primary-button" />
        </div>
    </div>

@endsection
