@extends('layouts.app')

@section('title', 'Add Folder')

@section('content')
    <div style="display: flex; align-items:center; flex:1; gap: 1em ">
        {{-- back button --}}
        <a href="/">
            <img src="img/icons/arrow-left.png" alt="" width="36px">
        </a>
        {{-- Title --}}
        <p class="title">
            Add Folder
        </p>
    </div>
    <hr>
    <p style="margin-bottom: 3em; margin-left:4em">Choose an unique and easy name for your folder</p>

    {{-- Form --}}
    <form action="{{ route('folders.store') }}" method="POST" style="margin-left:1em;">
        @csrf
        <div style="display: flex;gap:1em; align-items:center;">
            <img src="img/icons/Folder_alt (1).png" style="width:24px; height:24px;">
            <p style="font-size:15.8px">Folder Name</p>
        </div>
        <div class="textfield" style="flex: 1; margin-bottom:2em;">
            <input type="text" name="nama" placeholder="Your Folder's Name" required />
        </div>

        <div style="display: flex; gap:1em; justify-content:end">
            <button type="submit" class="primary-button"
                style="width:211px;height:29px; justify-content:center; display:flex;gap:1em">
                <img src="img/icons/plus.png" width="24px">
                <p>Add Folder</p>
            </button>
        </div>
    </form>
@endsection
