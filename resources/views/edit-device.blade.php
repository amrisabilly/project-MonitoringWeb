{{-- resources/views/edit-device.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Device') {{-- Menentukan title untuk halaman ini --}}

@section('content')
    {{-- Folder --}}
    <p style="margin-bottom: 0px; margin-left:53px">
        Monitoring and chill
    </p>

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
    <p style="font-size:15.8px">Device Name</p>
    <div class="textfield" style="flex: 1; margin-bottom:2em;">
        <input type="text" value="Input device name here (Max 50 Character)" />
    </div>

    <div style="display: flex; gap: 2em; margin-bottom:2em">
        <div style="flex: 1;">
            <p style="font-size:15.8px">IP Address</p>
            <div class="textfield">
                <input type="text" value="Input IP address here" />
            </div>
        </div>
        <div style="flex: 1;">
            <p style="font-size:15.8px">MAC Address</p>
            <div class="textfield">
                <input type="text" value="Input MAC address here" />
            </div>
        </div>
    </div>

    <hr style="margin-top: 3em; margin-bottom: 3em;">
    {{-- Edit Form --}}
    <p style="font-size:15.8px">Device Name</p>
    <div class="textfield" style="flex: 1; margin-bottom:2em;">
        <input type="text" value="Input device name here (Max 50 Character)" />
    </div>

    <div style="display: flex; gap: 2em; margin-bottom:2em">
        <div style="flex: 1;">
            <p style="font-size:15.8px">IP Address</p>
            <div class="textfield">
                <input type="text" value="Input IP address here" />
            </div>
        </div>
        <div style="flex: 1;">
            <p style="font-size:15.8px">MAC Address</p>
            <div class="textfield">
                <input type="text" value="Input MAC address here" />
            </div>
        </div>
    </div>
    <hr style="margin-top: 3em; margin-bottom: 3em;">

    <p style="margin-bottom: 3em;">Please, make sure you input the right detail information about the devices before
        clicking “Save”.</p>

    <div style="display: flex; gap:1em; justify-content:end;">
        <button class="secondary-button" style="width:211px;height:29px; justify-content:center"
            onclick="resetForm()">Cancel</button>
        <a href="#"><button class="primary-button" style="width:211px;height:29px; justify-content:center">
                Save</button></a>
    </div>
@endsection
