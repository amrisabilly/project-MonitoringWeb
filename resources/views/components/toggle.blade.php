<div>
    <style>
        .toggle {
            z-index: -1;
            width: 43px;
            height: 23px;
            background-color: #80808035;
            border: 1px solid #808080;
            border-radius: 50px;
            padding: 3px;
            position: relative;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle-circle {
            position: absolute;
            left: 3px;
            width: 23px;
            height: 23px;
            border-radius: 50%;
            background-color: #8080807b;
            transition: left 0.3s ease, background-color 0.3s ease;
        }

        .toggle.active {
            background-color: #0960bd38;
            border: 1px solid #095fbd;
        }

        .toggle.active .toggle-circle {
            left: 22px;
            background-color: #095fbd;
        }
    </style>


    <a onclick="toggleSwitch('{{ $id }}')">
        <div class="toggle {{ $isActive ? 'active' : '' }}" id="{{ $id }}">
            <div class="toggle-circle"></div>
        </div>
    </a>
</div>

<script>
    function toggleSwitch(id) {
        var toggle = document.getElementById(id);
        toggle.classList.toggle('active');
    }
</script>
