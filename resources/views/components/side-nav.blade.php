@props(['folders'])

<div>
    <style>
        nav {
            width: 322px;
            background-color: #25160F;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: center;
        }

        .main-container {
            margin: 25px 10px;
        }

        .logo-container {
            width: 280px;
            height: 49px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .device-container {
            width: 281px;
            padding-top: 2em;
            color: white;
        }

        .logo-style {
            width: 150px;
            height: 34px;
        }

        .container {
            max-height: calc(100vh - 350px);
            color: white;
            overflow-y: auto;
        }

        .container::-webkit-scrollbar {
            width: 10px;
        }

        .container::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.134);
            border-radius: 5px;
        }

        .container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        .container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        a {
            color: inherit;
            text-decoration: none;
        }

        p {
            font-size: 13.5px;
        }

        .group-button {
            display: flex;
            align-items: center;
            border-radius: 10px;
            height: 3em;
            padding: 0 1em;
            transition: background-color 0.35s ease, transform 0.3s ease;
        }

        .group-button:hover {
            background-color: #B66B13;
        }

        .group-button img {
            width: 24px;
            margin-right: 1em;
        }

        .group-button-root {
            margin-left: 0;
        }

        .group-button-items {
            margin-left: 2em;
        }

        .folder-title {
            font-size: 18.4px;
            margin-bottom: 0.5em;
        }

        .divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            margin: 0.5em 0;
        }

        .add-folder-button {
            all: unset;
            cursor: pointer;
            margin-top: 2em;
            gap: 0.5em;
            width: 280px;
            height: 49px;
            background-color: #f56e02;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>

    <nav>
        <div class="main-container">
            <!-- Logo Container -->
            <div class="logo-container">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" class="logo-style">
            </div>

            <!-- Device Segment -->
            <div class="device-container">
                <p class="folder-title">Folders</p>
                <hr class="divider">
                <div class="container">
                    <!-- Root Folder -->
                    <a href="{{ url('/') }}">
                        <div class="group-button group-button-root">
                            <img src="{{ asset('img/icons/Folder_alt.png') }}" alt="Folder Icon">
                            <p>Root</p>
                        </div>
                    </a>
                    <!-- Other Folders -->
                    @if ($folders->isEmpty())
                        <p>No Folders available.</p>
                    @else
                        @foreach ($folders as $folder)
                            <a href="{{ url('/folders/' . $folder->ID_folder) }}">
                                <div class="group-button group-button-items">
                                    <img src="{{ asset('img/icons/Folder_alt.png') }}" alt="Folder Icon">
                                    <p>{{ $folder->nama }}</p>
                                </div>
                            </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Add Folder Button -->
            <x-modal modalId="addFolder" triggerId="addFolder" triggerText="Add Folder" title="Please Confirm Your Role"
                content="Please input the password to verify your role to do this action." class="add-folder-button"
                icon="{{ asset('img/icons/plus.png') }}" actions='/add-folder'
                modalIcon="{{ asset('img/icons/exclamation-circle.png') }}" actionButtonClass="primary-button" />
        </div>
    </nav>
</div>
