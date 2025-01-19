{{-- resources/views/edit-device.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Device') {{-- Menentukan title untuk halaman ini --}}

@section('content')
    <style>
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

    <div style="display: flex; align-items:center; flex:1; gap: 1em ">
        {{-- back button --}}
        <a href="/">
            <img src="img/icons/arrow-left.png" alt="" width="36px">
        </a>
        {{-- Title --}}
        <p class="title">
            Edit Device
        </p>
    </div>
    <hr style="margin-bottom: 3em">

    {{-- Edit Form --}}
    <form action="{{ route('bulkEditSubmit') }}" method="POST">
        @csrf
        @foreach ($devices as $device)
            <input type="hidden" name="ID_device[]" value="{{ $device->ID_device }}">
            <p style="font-size:15.8px">Device Name</p>
            <div class="textfield" style="flex: 1; margin-bottom:2em;">
                <input name="nama[]" value="{{ $device->nama }}" type="text" />
            </div>

            <div style="display: flex; gap: 2em; margin-bottom:2em">
                <div style="flex: 1;">
                    <p style="font-size:15.8px">IP Address</p>
                    <div class="textfield">
                        <input type="text" name="IP_address[]" value="{{ $device->IP_address }}"
                            placeholder="Input device name here (Max 50 Character)" />
                    </div>
                </div>
                <div style="flex: 1;">
                    <p style="font-size:15.8px">MAC Address</p>
                    <div class="textfield">
                        <input type="text" name="MAC_address[]" value="{{ $device->MAC_address }}"
                            placeholder="Input MAC address here" />
                    </div>
                </div>
            </div>

            <hr style="margin-top: 3em; margin-bottom: 3em;">
        @endforeach

        <div style="margin-bottom: 3em;display: flex;gap:1em; align-items:center">
            <img src="img/icons/exclamation-circle.png" style="width:24px;height:24px;">
            <p>Please, make sure you input the right detail information about the devices before
                clicking “Save”.</p>
        </div>

        <div style="display: flex; gap:1em; justify-content:end;">
            <button class="secondary-button" style="width:211px;height:29px; justify-content:center"
                onclick="resetForm()">Cancel</button>
            <button type="submit" class="primary-button" style="width:211px;height:29px; justify-content:center">
                Save</button>
        </div>
    </form>
@endsection
